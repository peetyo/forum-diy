<?php

class Validations {
    // this function cleans the empty spaces  
    //encoding the html special charecter and sanitize the data
    public static function sanitize_and_clean($data) {
        $Newdata = trim($data);   
        $Newdata = htmlspecialchars($data);
        $Newdata = filter_var($data,FILTER_SANITIZE_ENCODED);
        return $Newdata;
      }
      //cleans the empty fields and remove html tags
    public static function sanitize_inputs($data){
      $Newdata = trim($data);
      $Newdata = filter_input($data, FILTER_SANITIZE_STRING);
      return $data;
    }
}