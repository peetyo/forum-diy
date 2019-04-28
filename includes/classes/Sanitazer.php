<?php

class Sanitizer {

    public static   function trim_remove($data) {
        $Newdata = trim($data);   
        $Newdata = htmlspecialchars($data);
        $Newdata = filter_var($data,FILTER_SANITIZE_ENCODED);
        return $Newdata;
      }
}