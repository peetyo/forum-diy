<?php

class Sign extends Model {
    //TODO  use stored procedure function for input the data 
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