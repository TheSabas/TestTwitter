<?php
/*
ajaxRegister
------------------
In this file we get the ajax request for the process of Register.
*/ 
session_start();
require("../data_access.php");
//Takes the petition
if(!empty($_POST["case"])){

	$caseProcess = ($_POST["case"]);
}else{
	$caseProcess = 0;
}

//Verifies the petition and start with the process
switch($caseProcess){
    case 'RegisterUser':
        $user = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        $phone = htmlspecialchars($_POST["phone"]);
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $ClassData = new Data;        

        if ($ClassData->UsernameExists($user)) {

            if ($ClassData->ValidationUsername($user)) {

                if ($ClassData->ValidationPassword($password)) {
                                
                    if (password_verify($confirmPassword, $hash)) {
                        
                        if ($ClassData->InsertRegisterUser($user, $email, $phone, $hash)) {

                            $_SESSION["DataUser"]= array("user" => $user, "email" => $email, "phone" => $phone);
                            $message = 'User Registered Succesfully';
                            $continue = array("action" => true, "message" => "", "result" => $message);    
                        }else{
                            $message = 'An error occurred while registering the user';
                            $continue = array("action" => false, "message" => "", "result" => $message);  
                        }
                    }else{
                        $message = 'The passwords does not match';
                        $continue = array("action" => false, "message" => "", "result" => $message); 
                    }
                }else{
                    $message = 'The password must be at least 6 characters long and contain an "-" and an uppercase';
                    $continue = array("action" => false, "message" => "", "result" => $message); 
                }
            }else{
                $message = 'The username must have at least 4 letters and 2 numbers, and no special characters';
                $continue = array("action" => false, "message" => "", "result" => $message); 
            }
        }else{
            $message = 'The username already exists';
            $continue = array("action" => false, "message" => "", "result" => $message); 
        }       
    break;
    default:
        $continue = array("action" => false, "message" => "Petition not found", "result" => $caseProcess);
    break;
}

//Returns the result
$rps = json_encode(array("rps" => $continue["action"], "message" => $continue["message"], "answer" => $continue["result"]));

echo $rps;