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
        $sQuery = $this->db->prepare('INSERT INTO users
         VALUES(null, :userName, :hashed_password, :email, :date_created, :user_role, :active )');
        $sQuery->bindValue(':userName',$username );
        $sQuery->bindValue(':hashed_password',$hashed_pass );
        $sQuery->bindValue(':email',$email );
        $sQuery->bindValue(':date_created',date('Y/m/d H:i:s') );
        $sQuery->bindValue(':user_role', 4 );
        $sQuery->bindValue(':active', 0 );
        $sQuery->execute();
       if( $sQuery->rowCount() ){
           echo '{"message":"success", "text":"user created"}';
           exit;
       }
       echo '{ "message":"error"}';
    }
}
// for testing
// $modeltest = new Users;
// $modeltest->read_users();
