<?php
// for testing this class we need to include the Model.php
// require_once 'Model.php';
class Users extends Model {
    public function read_users() {
        $sQuery = $this->db->prepare('SELECT * FROM users');
        $sQuery->execute();
        $users = $sQuery->fetchAll();
        if( count($users) ){
            echo print_r($users);
            exit;
        }
    }
    //prepared insert stament, whcih is used in sign_up controller
    public function sign_up_user($username, $hashed_pass, $email ){

        $checkUserQuery = $this->db->prepare( 'SELECT username, email FROM users WHERE email = :email OR username = :username');
        $checkUserQuery->bindValue( ':email', $email);
        $checkUserQuery->bindValue( ':username', $username);
        $checkUserQuery->execute();
        // check if the user exists in the dabase
        if(!empty($checkUserQuery->fetch())){   
            // return false to the controllers
            // return false;
            //PETER: the response here is sent to AJAX and AJAX expects a JSON
            // These 2 have to be separated to show something meaningful to the user
            // we gotta tell them if the email is already in use of if the username is already in use
            // specifically.
            echo '{"status":"0","message":"Duplicating username or email"}';
            exit;  
        }



        $sQuery = $this->db->prepare('INSERT INTO users
         VALUES(null, :userName, :hashed_password, :email, :date_created, :user_role, :active , :token )');
        $sQuery->bindValue(':userName',$username );
        $sQuery->bindValue(':hashed_password',$hashed_pass );
        $sQuery->bindValue(':email',$email );
        $sQuery->bindValue(':date_created',date('Y/m/d H:i:s') );
        $sQuery->bindValue(':user_role', 4 );
        $sQuery->bindValue(':active', 0 );
        $sQuery->bindValue(':token' , $token);
        $sQuery->execute();
        $returnedID =  $this->db->lastInsertId();
        if(!$sQuery->rowCount() ){
            echo '{"status":"0","message":"User was not created"}';
           exit;
        }
        return $returnedID;
      //  echo '{"status":"1", "message":"User created" ,"id" = '.$returnedID.'}';
    }

    // :MORTIMUS the results of function  will be used to check if the username exist or not
    // the function takes the username from table
    public function select_username($username){
        $sQuery = $this->db->prepare('SELECT username from users WHERE username = :usersname AND active = 1');
        $sQuery->bindValue(':usersname', $username);
        $sQuery->execute();
        $aUser = $sQuery->fetchAll();
       
        return $aUser;
    }

    public function select_username_and_password($username){
        $sQuery = $this->db->prepare('SELECT id,username,password_hashed,email  from users WHERE username = :usersname ');
        $sQuery->bindValue(':usersname', $username);
        $sQuery->execute();
        $aUser = $sQuery->fetchAll();
       
        return $aUser;
    }

   public  function  activate_user($token , $user_id){
        try{
            $sQuery = $this->db->prepare('UPDATE users SET active = 1 WHERE id = :ID AND activation_token = :token ');
            $sQuery->bindValue(':ID' , $user_id);
            $sQuery->bindValue(':token' , $token);
            $sQuery->execute();
            if(!$sQuery->rowCount()){
                echo '{"status":"0","message":"User was not'.$token.' activated "';
                exit;
            }
            echo '{"status":"1", "message":"User activated" }';
        }catch(PDOException $e){
            echo '{"status":"0","message":"Something went wrong, please contact the support"}';
            //Saving the errors in txt file to keep track what happend in case something breaks
            date_default_timezone_set("Europe/Copenhagen");
            $error_log = '{ "DATE":'.date("Y-m-d").', "TIME": '.date("h:i:sa").' , "Eror": '.$e.', "line": '.__LINE__.'}';
            file_put_contents('./includes/logs/verify.txt', $error_log , FILE_APPEND);
        }


   }

    public function select_user_role_by_id($userId){
        try {
            $sQuery = $this->db->prepare('SELECT user_role_id from users WHERE id=:userId');
            $sQuery->bindValue(':userId', $userId);
            $sQuery->execute();
            $user = $sQuery->fetch();
            return $user;
        } catch (PDOException $error) {
            echo 'error';
            die();
        }
    }
}
// for testing
// $modeltest = new Users;
// $modeltest->read_users();
