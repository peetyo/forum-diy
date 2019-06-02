<?php


class Admin extends Controller
{
    public static function get_user(){
        if(!isset($_POST['txtSearch'])){
            echo '{"status":"0","message":"Field cannot be empty"}';
            die();
        }
        $sUserToFind = $_POST['txtSearch'];
        $query = new Users;
        $searchResults = $query->get_user($sUserToFind);
        $return = new stdClass();
        $return->status = 1;
        $return->message = 'All good';
        $return->data = $searchResults;
        echo json_encode($return);

    }
}