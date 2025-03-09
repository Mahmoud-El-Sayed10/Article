<?php

class UserSkeleton{
    protected $id;
    protected $email;
    protected $password;
    protected $fullname;

    protected $table = "users";

    public function __construct($id = null, $email = null, $password = null, $fullname = null){
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->fullname = $fullname;
    }

    public static function create($email, $password, $fullname){
        $instance = new static();
        $instance->email = $email;
        $instance->password = $password;
        $instance->fullname = $fullname;

        return $instance;
    }
    
    public function getId(){
        return $this->id;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getFullname(){
        return $this->fullname;
    }

    public function getTable(){
        return $this->table;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setFullname($fullname){
        $this->fullname = $fullname;
    }
}

?>