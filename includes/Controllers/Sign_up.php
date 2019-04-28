<?php

class Sign_up extends Controller {
   public function create_user(){
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
$username = trim_remove($_POST['txtUserName']);
//$email = trim_remove($_POST['txtEmail']);

  function trim_remove($data) {
    $Newdata = trim($data);   
    $Newdata = htmlspecialchars($data);
    $Newdata = filter_var($data,FILTER_SANITIZE_ENCODED);
    return $Newdata;
  }
//hash and peber the password
$user_password = password_hash($_POST['txtPassword'], PASSWORD_BCRYPT);

echo $username;
// try catch stament
// use stored procedure function for input the data 

    }

    
}