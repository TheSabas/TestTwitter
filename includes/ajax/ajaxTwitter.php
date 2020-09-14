<?php
/*
ajaxTwitter
------------------
In this file we get the ajax request for the process of Tweeter posting, searching
and filtering by date, also it's used to show the current feed to the user.
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
    case 'NewTweet':
        $tweet = htmlspecialchars($_POST["tweetText"]);
        $user = $_SESSION["DataUser"]["user"];

        $ClassData = new Data;        

        $newTweet = $ClassData->NewTweet($user, $tweet);
        $DataTweet = $ClassData->FeedContent();

        if ($newTweet[0]) {                            
            $continue = array("action" => true, "message" => "Tweet Added", "result" => $DataTweet);
        }else{
            $message = 'Error Adding the tweet';
            $continue = array("action" => false, "message" => "", "result" => $message); 
        }

    break;
    case 'ShowTweetFeed':
        $ClassData = new Data;        

        $feedData = $ClassData->FeedContent();
                   
        $continue = array("action" => true, "message" => "", "result" => $feedData);
    break;
    case 'SearchTweet':
        $search = $_POST["search"];

        $ClassData = new Data;        

        $feedData = $ClassData->SearchTweet($search);
                   
        $continue = array("action" => true, "message" => "", "result" => $feedData);
    break;
    case 'SearchDate':
        $search = $_POST["date"];

        $ClassData = new Data;        

        $feedData = $ClassData->DateSearch($search);
                   
        $continue = array("action" => true, "message" => "", "result" => $feedData);
    break;
    default:
        $continue = array("action" => false, "message" => "Petition not found", "result" => $caseProcess);
    break;
}

//Returns the result
$rps = json_encode(array("rps" => $continue["action"], "message" => $continue["message"], "answer" => $continue["result"]));

echo $rps;