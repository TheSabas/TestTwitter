<?php
/*
Class Data
------------------
In this class we access all the data stored in the flat files
we also store data and process de data given in the functions.
*/ 
class Data{
    function __construct(){
        
    }

    public static function InsertRegisterUser($user, $email, $phone, $hash){
        $result = 0;

        $userInfo = array("username" => $user, 
        "email" => $email,
        "phone" => $phone,
        "password" => $hash);
        
        if (file_put_contents('../../data/users/users', serialize($userInfo).'\n', FILE_APPEND)) {
            $result = 1;
        }

        return $result;
    }

    public static function UserData($user){
        $result = 0;
        $dataArray = array();
        //Checking if the file exists
        if (file_exists('../../data/users/users')) {
            $result = 1;
            //Getting data from the file
            $data = file_get_contents("../../data/users/users");
            //Exploding jump of line
            $userArray = explode('\n', $data);
            //Pushing data from the flat file to an array
            for ($i=0; $i < (count($userArray)-1); $i++) {
                $unserialize = (unserialize($userArray[$i]));
                if ($unserialize["username"]==$user) {
                    array_push($dataArray, unserialize($userArray[$i]));                    
                }
            }
        }
        return array($result, $dataArray);
    }

    public static function UsernameExists($user){
        $result = 1;
        //Checking if the file exists
        if (file_exists('../../data/users/users')) {
            $result = 1;
            //Getting data from the file
            $data = file_get_contents("../../data/users/users");
            //Exploding jump of line
            $userArray = explode('\n', $data);
            //Pushing data from the flat file to an array
            for ($i=0; $i < (count($userArray)-1); $i++) {
                $unserialize = (unserialize($userArray[$i]));
                if ($unserialize["username"]==$user) {
                    $result = 0;                    
                }
            }
        }
        return $result;
    }

    public static function NewTweet($user, $tweet){
        $result = 0;
        $tweetData = array("tweet" => $tweet, 
        "user" => $user,
        "date" => Data::CurrentDate(),
        "dateShow" => date("Y.m.d", strtotime(Data::CurrentDate())));
        //Writing data into flat file of the new tweet
        if (file_put_contents('../../data/tweets/tweet', serialize($tweetData).'\n', FILE_APPEND)) {
            $result = 1;
        }
        return array($result, $tweetData);
    }

    private function CurrentDate(){
        date_default_timezone_set('America/Bogota');
        $date = date('Y-m-d H:i:s');
        return $date;
    }

    public static function TweetData(){
        $result = 0;
        $dataArray = array();
        //Checking if the file exists
        if (file_exists('../../data/tweets/tweet')) {
            $result = 1;
            //Getting data from the file
            $data = file_get_contents("../../data/tweets/tweet");
            //Exploding jump of line
            $tweetArray = explode('\n', $data);
            //Pushing data from the flat file to an array
            for ($i=0; $i < (count($tweetArray)-1); $i++) { 
                array_push($dataArray, unserialize($tweetArray[$i]));                
            }
        }
        return array($result, $dataArray);
    }

    public static function FeedContent(){
        $tweets = Data::TweetData();
        $html = '';
        $ordered = $tweets[1];
        //Ordering the array by date
        usort($ordered, 'Data::orderByDate');
        //Preparing the html content based on the content in the flat file
        if ($tweets[0]) {
            //Iterating backwars so it will always show the latests tweets added
            for ($k=(count($ordered)-1); $k >= 0; $k--) { 
                $html .= '<div class="tweet-box">
                <ul>
                <li><p><b>'.$ordered[$k]["dateShow"].'</p></b></li>
                <p>'.$ordered[$k]["tweet"].'</p>
                <p><b>By: '.$ordered[$k]["user"].'</b></p>
                </ul>                    
                </div>';
            }
        }else{
            $html = '<div class="tweet-box">
                <p>Nothing to see here...</p>                    
                </div>';
        }
        return $html;
    }

    public static function SearchTweet($filter){
        if ($filter!='') {
            $data = Data::TweetData();
            $arrayAnswer = array();
            $arrayTweet = array();
            $search = preg_quote($filter, '~');
    
            //Iterating the array of tweets and pushing only the tweets to a new array
            foreach ($data[1] as $key => $val) {
                array_push($arrayTweet, $val["tweet"]);            
            }    
            //Preparing the filter to work in the new array of tweets
            $result = preg_grep('~'.$search.'~', $arrayTweet);
            for ($i=0; $i < count($result); $i++) {
                //Using the keys of the array filtered to created a new array with the results
                $key = (array_keys($result));
                // $key = (key($result));
                //Pushing the data of the first array to the array answer            
                // array_push($arrayAnswer, $data[1][$key]);
            }
            if (is_array($key)) {
                foreach ($key as $k => $value) {
                    //Pushing the data of the first array to the array answer            
                    array_push($arrayAnswer, $data[1][$value]);                
                }
            }
            //Calling the function that returns the htmls content based on the array via parameter
            $htmlSearch = Data::FeedContentFiltered($arrayAnswer);
            return $htmlSearch;            
        }else{
            //If the filter is empty we are gonna show all the tweets
            return Data::FeedContent();
        }
    }

    public static function FeedContentFiltered($array){
        $html = '';

        $count = count($array);
        //Preparing the html content based in the array given
        if ($count>0) {
            $ordered = $array;
            usort($ordered, 'Data::orderByDate');
            //Iterating backwars so it will always show the latests tweets added
            for ($k=($count -1); $k >= 0; $k--) { 
                $html .= '<div class="tweet-box">
                <ul>
                <li><p><b>'.$ordered[$k]["dateShow"].'</p></b></li>
                <p>'.$ordered[$k]["tweet"].'</p>
                <p><b>By: '.$ordered[$k]["user"].'</b></p>
                </ul>                    
                </div>';
            }
        }else{
            $html = '<div class="tweet-box">
                <p>Nothing to see here...</p>                    
                </div>';
        }
        return $html;
    }

    public static function DateSearch($filter){
        if ($filter!='') {
            $data = Data::TweetData();
            $arrayAnswer = array();
            $arrayDate = array();
            $search = preg_quote($filter, '~');
    
            //Iterating the array of dates and pushing only the dates to a new array
            foreach ($data[1] as $key => $val) {
                array_push($arrayDate, $val["dateShow"]);            
            }
            //Preparing the filter to work in the new array of dates
            $result = preg_grep('~'.$search.'~', $arrayDate);
            for ($i=0; $i < count($result); $i++) {
                //Using the keys of the array filtered to created a new array with the results
                $key = (array_keys($result));
            }
            if (is_array($key)) {
                
                foreach ($key as $k => $value) {
                    //Pushing the data of the first array to the array answer            
                    array_push($arrayAnswer, $data[1][$value]);                
                }
            }
            //Calling the function that returns the htmls content based on the array via parameter
            $htmlSearch = Data::FeedContentFiltered($arrayAnswer);
            return $htmlSearch;            
        }else{
            //If the filter is empty we are gonna show all the dates
            return Data::FeedContent();
        }
    }

    public static function ValidationPassword($value){

        $upperCase = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','x','y','Z');
        $flagLength = false;
        $flagChar = false;
        $flagUpper = false;

        //Validating if the string is at least 6 characters long
        if (mb_strlen($value)>=6) {
            $flagLength = true;            
        }
        //Validating if the string has at least one '-'
        if (strpos($value, '-')!='') {
            $flagChar = true;
        }
        //Validating if the string has at least uppercase
        for ($i=0; $i < strlen($value); $i++) { 
            if (in_array($value[$i], $upperCase)) {
                $flagUpper = true;
            }
        }
        if ($flagLength && $flagChar && $flagUpper) {
            return true;
        }else{
            return false;
        }
    }

    public static function ValidationUsername($value){

        $result = true;
        $flagNumber = false;
        $flagLetters = false;    
        $allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_';
        //Validating if the string has the elements allowed in it
        for ($i=0; $i < strlen($value); $i++) { 
            if (strpos($allowed, substr($value,$i,1))===false) {
                $result = false;
                break;
            }
        }
        //validating how many numbers are in the string
        if (preg_match_all( "/[0-9]/", $value)>=2) {
            $flagNumber = true;
        }
        //Validating if the string has at least for letters, either uppercase or normal
        if ((preg_match_all( "/[a-z]/", $value)+(preg_match_all( "/[A-Z]/", $value)))>=4) {
            $flagLetters = true;
        }
        if ($result && $flagNumber && $flagLetters) {
            return true;
        }else{
            return false;
        }
    }

    public static function orderByDate($valueA, $valueB){
        //Converting to date the fields of the array to compare and order by date
        $time1 = strtotime($valueA['date']);
        $time2 = strtotime($valueB['date']);
        return $time1 - $time2;
    } 
}