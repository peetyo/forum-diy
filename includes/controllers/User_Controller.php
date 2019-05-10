<?php
ini_set('display_errors', 1);
class User_Controller extends Controller {
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
        // check lenght of user name
        if(strlen($_POST['txtUserName']) < 4 || strlen($_POST['txtUserName']) > 20){
            echo '{"Error":"Username  should be between 6 and 20 character"}';
            exit;
        }
        //Preventing the user to create admin or moderator 
        if($_POST['txtUserName'] === 'admin' || $_POST['txtUserName'] === 'moderator' ){
            echo '{"Error":"Reservated usernames "}';
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
        //TODO add more checking if the username is taken or not same for the email!!!

        //hash the password
        $user_password = password_hash($_POST['txtPassword'], PASSWORD_BCRYPT);
        // trim variables
        $username = $_POST['txtUserName'];
        $email = trim($_POST['txtEmail']);
           // try catch stament
        try{
            $user_class = new Users;
            $user_class->sign_up_user($username, $user_password,$email );
        }catch( PDOException $e ){
            echo '{"Error":"Something went wrong, please contact the support"}';
            //Saving the errors in txt file to keep track what happend in case something breaks
            $error_log = '{"Eror": '.$e.', "line": '.__LINE__.'}';
            $sign_up_log = fopen('./includes/logs/sign_up.txt', "w") or die("Unable to open file!");
            fwrite($sign_up_log, $error_log);
            fclose($sign_up_log);
        }
    }

  public static function login_user(){
    //checking length
    if(strlen($_POST['txtPassword']) < 6 || strlen($_POST['txtPassword']) > 20){
        echo '{"Error":"Wrong username or password"}';
        exit;
    }
    // check lenght of user name
    if(strlen($_POST['txtUserName']) < 4 || strlen($_POST['txtUserName']) > 20){
        echo '{"Error":"Wrong username or password"}';
        exit;
    }
    // trim variables
    $username = $_POST['txtUserName'];
    $user_model = new Users;

    try{
        $selected_user =  $user_model->select_username($username);
    }catch(PDOExcepetion $e){
        echo '{"Error":"Something went wrong, please contact the support"}';
        //Saving the errors in txt file to keep track what happend in case something breaks
        $error_log = '{"Eror": '.$e.', "line": '.__LINE__.'}';
        $sign_up_log = fopen('./includes/logs/login.txt', "w") or die("Unable to open file!");
        fwrite($sign_up_log, $error_log);
        fclose($sign_up_log);
    }

    //we are checking if the size of the array is zero or and doesn't match the user is not verifed 
    if(sizeof($selected_user)=== 0 || $selected_user[0]['username'] != $username ) {
        echo '{"Error":"Wrong username or password"}';
        exit;
    } 

    try{
        $verife_user = $user_model->select_username_and_password($username);
    }catch(PDOException $e){
        echo '{"Error":"Something went wrong, please contact the support"}';
        //Saving the errors in txt file to keep track what happend in case something breaks
        $error_log = '{"Eror": '.$e.', "line": '.__LINE__.'}';
        $sign_up_log = fopen('./includes/logs/login.txt', "w") or die("Unable to open file!");
        fwrite($sign_up_log, $error_log);
        fclose($sign_up_log);
    }

    if(!password_verify($_POST['txtPassword'],$verife_user[0]['password_hashed'] )){
        echo '{"Error":"Wrong user name or password"}';
        exit; 
    }
    // TODO later create another stament to check if the user is active or not 
    session_start();
    $_SESSION['User'] = $verife_user[0];
    echo '{"Success":"User logged in"}';
    // print_r($_SESSION['User']);
  }
}