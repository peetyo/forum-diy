<?php

try{
  $sUserName = 'root';
  $sPassword = '';
  $sConnection = "mysql:host=localhost; dbname=lifehack; charset=utf8mb4";

  $aOptions = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  );
  $db = new PDO( $sConnection, $sUserName, $sPassword, $aOptions );
  
  $sQuery = $db->prepare('SELECT * FROM users');
  $sQuery->execute();
  $users = $sQuery->fetchAll();
  if( count($users) ){
    
    echo print_r($users);
    exit;
  }
  echo '{"status":0, "message":"No listings found"}';
}catch( PDOException $error){
  echo '{"status":"err","message":"cannot connect to database"}';
  exit();
}