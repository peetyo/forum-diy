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
}
// for testing
// $modeltest = new Users;
// $modeltest->read_users();
