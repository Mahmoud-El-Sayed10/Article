<?php

require_once(__DIR__ . "/../../connection/connection.php");
require_once(__DIR__ . "/../../Models/Question.php");

$questions = [
    [
        "question" => "What is the difference between a model and a methodology in software development?",
        "answer" => "A model is descriptive and describes what to do, whereas a methodology is prescriptive and describes how to do it. Models provide a framework for development stages while methodologies provide specific implementation guidance."
    ],
    [
        "question" => "What are the three broad categories of software discussed in the paper?",
        "answer" => "Category 1: Software that provides back-end functionality (service to other applications). Category 2: Software that provides service to end-users or end-user applications. Category 3: Software that provides a visual interface to an end-user (typically a GUI)."
    ],
    [
        "question" => "How can SDLC models be categorized based on their approach?",
        "answer" => "SDLC models can be categorized into three broad groups: linear (sequential where one stage leads to the next), iterative (all stages are revisited for continuous improvement), and combination of linear and iterative models."
    ],
    [
        "question" => "Who first documented the waterfall model and when?",
        "answer" => "The waterfall model (also known as the cascade model) was first documented by Benington in 1956 and was later modified by Winston Royce in 1970."
    ],
    [
        "question" => "What is the main enhancement Royce made to Benington's cascade model?",
        "answer" => "Royce enhanced the cascade model by providing a feedback loop so that each preceding stage could be revisited. This allowed for stages to overlap and for iteration between stages."
    ],
    [
        "question" => "What kinds of documentation does the waterfall model require?",
        "answer" => "The waterfall model requires at least six distinct types of documents: Requirements document, Preliminary design specification, Interface design specification, Final design specification, Test plan, and Operations manual or instructions."
    ],
    [
        "question" => "What is the b-model and how does it relate to the waterfall model?",
        "answer" => "The b-model, introduced by Birrell and Ould in 1988, is an extension of the waterfall model that includes the operational life-cycle (maintenance cycle) attached to the waterfall model. It was designed to ensure constant improvement and to capture alternatives to obsolescence."
    ],
    [
        "question" => "What is the incremental model and how does it differ from the waterfall model?",
        "answer" => "The incremental model, also known as the iterative waterfall model, can be viewed as a three-dimensional representation of the waterfall model. It uses a series of waterfall models to incrementally improve functionality with each iteration, making it a bridge between waterfall and spiral models."
    ],
    [
        "question" => "What are the main strengths of the incremental model?",
        "answer" => "The main strengths of the incremental model are: 1) Incorporating feedback from earlier iterations, 2) Involving stakeholders to identify risks earlier, 3) Facilitating early, incremental releases that evolve to complete feature sets, and 4) Enabling monitoring of changes to mitigate risks."
    ],
    [
        "question" => "What is the v-model and who developed it?",
        "answer" => "The v-model (vee model) was developed by NASA and first presented at the 1991 NCOSE symposium. It's a variation of the waterfall model in a V shape, where the left leg represents evolution of requirements into components, and the right leg represents integration and verification."
    ],
    [
        "question" => "How does the v-model incorporate quality assurance?",
        "answer" => "The v-model is symmetrical across its two legs so that verification and quality assurance procedures for the right leg are defined during the corresponding stage of the left leg. This ensures requirements and design are verifiable in a SMART (Specific, Measurable, Achievable, Realistic and Time-bound) manner."
    ],
    [
        "question" => "What are the vee+ and vee++ models?",
        "answer" => "The vee+ model adds user involvement, risks, and opportunities to the z-axis of the v-model. The vee++ model further adds intersecting processes: a decomposition analysis and resolution process to the left leg, and a verification analysis and decomposition process to the right leg."
    ],
    [
        "question" => "What is the spiral model and how does it differ from the waterfall model?",
        "answer" => "The spiral model, introduced by Barry Boehm in 1986, represents a shift from specification-driven approach to a risk-driven one. It features iterative cycles that spiral out from small beginnings, with each cycle traversing four quadrants: determine objectives, evaluate alternatives and resolve risks, develop and test, and plan the next iteration."
    ],
    [
        "question" => "What difficulties of the waterfall model does the spiral model try to address?",
        "answer" => "The spiral model addresses two main difficulties of the waterfall model: 1) The unnecessary design stages in some situations, and 2) The need to temper the top-down approach with a look-ahead step to account for software reusability or early identification of risks and issues."
    ],
    [
        "question" => "What is the wheel-and-spoke model and how does it relate to the spiral model?",
        "answer" => "The wheel-and-spoke model is based on the spiral model and is designed to work with smaller teams initially, which then scale up. It's a bottom-up approach where the wheel represents the iteration of the development cycle, and each spoke represents verification against requirements."
    ],
    [
        "question" => "What is the Unified Process Model and what is it commonly known as?",
        "answer" => "The Unified Process Model is a model-based and use-case driven development process that is iterative in nature. It was developed by Rational Software in the 1990s and is commonly known as the Rational Unified Process (RUP). IBM acquired Rational Software in 2003."
    ],
    [
        "question" => "What are the four phases of RUP and what disciplines does it include?",
        "answer" => "RUP has four phases: inception, elaboration, construction, and transition. It includes six core disciplines (requirements, analysis and design, implementation, test, deployment, business modeling) supported by three additional disciplines: change and configuration management, project management, and environment."
    ],
    [
        "question" => "What is Rapid Application Development (RAD) and what is its main mechanism?",
        "answer" => "Rapid Application Development (RAD) is a methodology developed by James Martin in 1991 that uses prototyping as a mechanism for iterative development. It promotes a collaborative atmosphere where business stakeholders actively participate in prototyping, creating test cases, and performing unit tests."
    ],
    [
        "question" => "What is Extreme Programming (XP) and how does it approach development?",
        "answer" => "Extreme Programming (XP) is an approach where development takes place incrementally with a business champion acting as a conduit for user-driven requirements. There is no initial design stage, and new requirements are accounted for in short, fast spiral steps. Development takes place with programmers working in pairs."
    ],
    [
        "question" => "Which SDLC models are most suitable for Category 1 software (back-end functionality)?",
        "answer" => "The waterfall model, b-model, v-model and its variations (vee+ and vee++), and the spiral model are most suitable for Category 1 software like relational databases, compilers, or secure operating systems."
    ]
];

try{
    $savedCount = 0;
    foreach ($questions as $q){
        $question = Question::create($q["question"], $q["answer"]);

        if(Question::save($question)){
            $savedCount++;
        }
        elseif(!Question::save($question)){
            echo "Failed to save question" . $q["question"] . "\n";
        }
    }
    echo "Successfully saved " . $savedCount . " new FAQs and answers out of " .count($questions);

} catch (Exception $e){
    echo "Error seeding questions" . $e->getMessage();
}
?>