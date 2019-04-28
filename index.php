<?php

require_once ('routes.php');
// Peter: Now we are looking through the models folder(not classes) and the controllers folder
function __autoload($class_name) {
    if (file_exists('./includes/models/'.$class_name.'.php')){
        require_once './includes/models/'.$class_name.'.php';
    } else if (file_exists(require_once './includes/Controllers/'.$class_name.'.php')) {
        require_once './includes/controllers/'.$class_name.'.php';
    } 

}