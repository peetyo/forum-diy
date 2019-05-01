<?php
ini_set('display_errors', 1);
class Sign_up extends Controller {
   public static function create_user(){
       
        // check if passwords mathces
        if($_POST['txtPassword'] != $_POST['txtConfirmPassword']){
            echo '{"Error":"Passoword no match"}';
            exit;
        }
        // check lenght of password
        if(strlen($_POST['txtPassword']) < 6 || strlen($_POST['txtPassword']) > 20){
            echo '{"Error":"Passoword should be between 6 and 20 character"}';
            exit;
        }
        // check if it valid email
        if(!filter_var($_POST['txtEmail'],FILTER_VALIDATE_EMAIL)){
        echo '{"Error":"Enter Valid email"}';
        exit;
        }
        // check if the fields are empty
        if(empty($_POST['txtUserName']) ||
        empty($_POST['txtEmail']) ||
        empty($_POST['txtPassword']) ||
        empty($_POST['txtConfirmPassword']) ){
            echo '{"Error":"Please fill all the fields"}';
            exit;
        } 
        // sanitize the data
        $username = Validations::trim_remove($_POST['txtUserName']);
        $email = Validations::trim_remove($_POST['txtEmail']);

        //hash and peber the password
        $user_password = password_hash($_POST['txtPassword'], PASSWORD_BCRYPT);

        
        try{
            $sign_class = new Sign;
            $sign_class->sign_up_user($username, $user_password,$email );
        }catch( PDOException $e ){
            echo '{"message":"Error", "line": '.__LINE__.'}';
        }
        // try catch stament
       

    }

    
 

    
}