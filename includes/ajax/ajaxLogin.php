<?php
/*
ajaxLogin
------------------
In this file we get the ajax request for the process of login.
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
    case 'LoginUser':
        $user = htmlspecialchars($_POST["username"]);
        $password = $_POST["password"];

        $ClassData = new Data;        

        $userData = $ClassData->UserData($user);

        if ($userData[0]) {
            
            if (password_verify($password, $userData[1][0]["password"])) {
                
                $_SESSION["DataUser"]= array("user" => $user, "email" => $userData[1][0]["email"], "phone" => $userData[1][0]["phone"]);
                $message = 'Correct username and password';
                $continue = array("action" => true, "message" => "", "result" => $message); 
            }else{
                $message = 'Username or password are not correct';
                $continue = array("action" => false, "message" => "", "result" => $message); 
            }
        }else{
            $message = 'The username does not exist';
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