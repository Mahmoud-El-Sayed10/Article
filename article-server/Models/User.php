<?php

require_once(__DIR__ . "/../connection/connection.php");
require_once(__DIR__ . "/UserSkeleton.php");

class User extends UserSkeleton{

    public static function save($userObj){
        global $conn;

        if($userObj->email && $userObj->password){
            $hashedpassword = hash('sha256', $userObj->password);

            try{
                $checkquery = $conn->prepare("SELECT * FROM users WHERE email = ?");
                $checkquery->bind_param("s", $userObj->email);
                $checkquery->execute();
                $result = $checkquery->get_result();

                if($result->num_rows > 0){
                    return false;
                }

                $query = $conn->prepare("INSERT INTO users (email, password, fullname) VALUES (?,?,?)");
                $query->bind_param("sss", $userObj->email, $hashedpassword, $userObj->fullname);
                $query->execute();

                if($query->affected_rows > 0){
                    $userObj-> id = $conn->insert_id;
                    return true;
                }
            } catch (\Throwable $e){
                return false;
            }
        }
        return false;
    }

    public static function login($email, $password){
        global $conn;

        try{
            $query = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $query->bind_param("s", $email);
            $query->execute();

            $result = $query->get_result();

            if($result->num_rows > 0){
                $userData = $result->fetch_assoc();
                $hashedpassword = hash('sha256', $password);

                if($hashedpassword === $userData["password"]){
                    $user = new self();
                    $user->id = $userData["id"];
                    $user->email = $userData["email"];
                    $user->fullname = $userData["fullname"];
                    $user->password = $userData["password"];
                    return $user;
                }
            }
        } catch (\Throwable $e){
            return null;
        }
     return null;
    }
    public function toArray(){
        return[
            "id" => $this->id,
            "email" => $this->email,
            "fullname" => $this->fullname
        ];
    }
}

?>