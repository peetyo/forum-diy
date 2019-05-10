<?php
class Validation {

    public static function checkInput($input, $expectedType, $minLength, $maxLength ){
        // supported types string int boolean email 
        if($expectedType != ''){

            if($expectedType == 'email'){
                if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                    echo '{"status": 0, "message": "Your email is not a valid email address"}';
                    exit();
                }
            }else{
                if(gettype($input) != $expectedType){
                    echo '{"status": 0, "message": "Invalid input type"}';
                    exit();
                }
            }
            
        }
        // Check the length
        if($minLength != ''){
            if(strlen($input)<$minLength){
                echo '{"status": 0, "message": "Invalid length (min)"}';
                exit();
            }
        }
        if($maxLength != ''){
            if(strlen($input)>$maxLength){
                echo '{"status": 0, "message": "Invalid length (max)"}';
                exit();
             }
        }
    }
}
// $input = 'a@a.com';
// Validation::checkInput($input,'email',5,10);