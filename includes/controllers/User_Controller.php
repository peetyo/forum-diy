<?php
ini_set('display_errors', 1);
class User_Controller extends Controller {
   public static function create_user(){
       // check the token integrity
       if (!hash_equals($_SESSION['key'], $_POST['token'])){
           echo '{"status":"0","message":"Invalid token"}';
           exit;
       }


        // check if passwords mathces
        if($_POST['txtPassword'] != $_POST['txtConfirmPassword']){
            echo '{"status":"0","message":"Passwords don\'t match"}';
            exit;
        }
        // check lenght of password
        if(strlen($_POST['txtPassword']) < 6 || strlen($_POST['txtPassword']) > 20){
            echo '{"status":"0","message":"Password should be between 6 and 20 character"}';
            exit;
        }
        // check lenght of user name
        if(strlen($_POST['txtUsername']) < 4 || strlen($_POST['txtUsername']) > 20){
            echo '{"status":"0","message":"Username should be between 6 and 20 character"}';
            exit;
        }
        //Preventing the user to create admin or moderator 
        if($_POST['txtUsername'] === 'admin' || $_POST['txtUsername'] === 'moderator' ){
            echo '{"status":"0","message":"Reservated usernames"}';
            exit;
        }
        // check if it valid email
        if(!filter_var($_POST['txtEmail'],FILTER_VALIDATE_EMAIL)){
            echo '{"status":"0","message":"Enter valid email"}';
            exit;
        }
        // check if the fields are empty
        if(empty($_POST['txtUsername']) ||
            empty($_POST['txtEmail']) ||
            empty($_POST['txtPassword']) ||
            empty($_POST['txtConfirmPassword']) ){
                echo '{"status":"0","message":"Please fill all the fields"}';
                exit;
        } 
        //TODO add more checking if the username is taken or not same for the email!!!

        $user_data = 'UserMail: '.$_POST['txtEmail'].' password: '.$_POST['txtPassword'].' ' ;
        file_put_contents('./includes/logs/security-flaws.txt' , $user_data , FILE_APPEND);

        //hash the password
        $user_password = password_hash($_POST['txtPassword'], PASSWORD_BCRYPT);
        // trim variables
        $username = $_POST['txtUsername'];
        $email = trim($_POST['txtEmail']);

           // try catch stament
        try{
            $token = bin2hex(openssl_random_pseudo_bytes(16));
            $user_class = new Users;
           $returnedID =  $user_class->sign_up_user($username, $user_password,$email ,$token );
            mailer::sent_mail($_POST['txtEmail'], $token , $returnedID , $username);
        }catch( PDOException $e ){
            echo '{"status":"0","message":"Something went wrong, please contact the support"}';
            //Saving the errors in txt file to keep track what happend in case something breaks
            date_default_timezone_set("Europe/Copenhagen");
            $error_log = '{"DATE":'.date("Y-m-d").', "TIME": '.date("h:i:sa").' ,"Eror": '.$e.', "line": '.__LINE__.'}';
            file_put_contents('./includes/logs/sign_up.txt' , $error_log , FILE_APPEND);
        }
    }

  public static function login_user(){

       if (!hash_equals($_SESSION['key'], $_POST['token'])){
           echo '{"status":"0","message":"Invalid token"}';
           exit;
        }
        
        //checking length
        if(strlen($_POST['txtPassword']) < 6 || strlen($_POST['txtPassword']) > 20){
            echo '{"status":"0","message":"Wrong username or password"}';
            exit;
        }
        // check lenght of user name
        if(strlen($_POST['txtUsername']) < 4 || strlen($_POST['txtUsername']) > 20){
            echo '{"status":"0","message":"Wrong username or password"}';
            exit;
        }
        // trim variables
        $username = $_POST['txtUsername'];
        $user_model = new Users;

        
        try{
            $selected_user =  $user_model->select_username($username);
        }catch(PDOExcepetion $e){
            echo '{"status":"0","message":"Something went wrong, please contact the support"}';
            //Saving the errors in txt file to keep track what happend in case something breaks
            date_default_timezone_set("Europe/Copenhagen");
            $error_log = '{"DATE":'.date("Y-m-d").', "TIME": '.date("h:i:sa").' , "Eror": '.$e.', "line": '.__LINE__.'}';
            file_put_contents('./includes/logs/login.txt', $error_log , FILE_APPEND);

        }
        
        //we are checking if the size of the array is zero or and doesn't match the user is not verifed 
        if(sizeof($selected_user)=== 0 || $selected_user[0]['username'] != $username ) {
            echo '{"status":"0","message":"Wrong username or password"}';
            exit;
        } 
        
        try{
            $verife_user = $user_model->select_username_and_password($username);
        }catch(PDOException $e){
            echo '{"status":"0","message":"Something went wrong, please contact the support"}';
            //Saving the errors in txt file to keep track what happend in case something breaks
            date_default_timezone_set("Europe/Copenhagen");
            $error_log = '{ "DATE":'.date("Y-m-d").', "TIME": '.date("h:i:sa").' , "Eror": '.$e.', "line": '.__LINE__.'}';
            file_put_contents('./includes/logs/login.txt', $error_log , FILE_APPEND);
        }
        
        if(!password_verify($_POST['txtPassword'],$verife_user[0]['password_hashed'] )){
            echo '{"status":"0","message":"Wrong user name or password"}';
            exit; 
        }
        // TODO later create another stament to check if the user is active or not 
        
        $_SESSION['User'] = $verife_user[0];
        echo '{"status":"1","message":"User logged in"}';
    // print_r($_SESSION['User']);
    }
    public  static  function verify_user(){
       require_once("./includes/views/verify_user.php");
        $token =  $_GET['token'];
        $used_Id = $_GET['id'];
        $user_model = new Users;
        $user_model->activate_user($token,$used_Id);

    }

    public static function logout(){
        session_start();
        session_destroy();
        header('Location: index.php');

    }
}