<?php

class Model {
    private $username = 'root';
    private $password = '';
    private $host = 'localhost';
    private $dbName = 'lifehack';
    private $connection;
    protected $db;
    private $aOptions = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      );

    function __construct(){
        try{
            $this->connection = "mysql:host=".$this->host."; dbname=".$this->dbName."; charset=utf8mb4";
            $this->db = new PDO( $this->connection, $this->username, $this->password, $this->aOptions );
        }catch(PDOException $error){
            echo $error;
        }
    }
}   
// --- Displaying the PDO Object. (for testing the db connection)
// $modeltest = new Model;
// print_r( $modeltest->db);

// --- Displaying the list of users. (for testing the db connection)
// $sQuery = $modeltest->db->prepare('SELECT * FROM users');
//   $sQuery->execute();
//   $users = $sQuery->fetchAll();
//   if( count($users) ){
//     echo print_r($users);
//     exit;
//   }