<?php

class Validations {
    // this function cleans the empty spaces removes 
    //the html special charecter and sanitize the data
    public static function sanitize_and_clean($data) {
        $Newdata = trim($data);   
        $Newdata = htmlspecialchars($data);
        $Newdata = filter_var($data,FILTER_SANITIZE_ENCODED);
        return $Newdata;
      }
}