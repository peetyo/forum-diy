<?php
class Validation {

    public static function checkInput($input, $expectedType, $minLength, $maxLength ){
        // supported types string int boolean email 
        if($expectedType != ''){

            if($expectedType == 'email'){
                if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                    echo("Your email is not a valid email address");
                    exit();
                }
            }else{
                if(gettype($input) != $expectedType){
                    echo "Invalid input type";
                    exit();
                }
            }
            
        }
        // Check the length
        if($minLength != ''){
            if(strlen($input)<$minLength){
               echo "Invalid length (min)";
               exit();
            }
        }
        if($maxLength != ''){
            if(strlen($input)>$maxLength){
                echo "Invalid length (max)";
                exit();
             }
        }
    }
}
// $input = 'a@a.com';
// Validation::checkInput($input,'email',5,10);