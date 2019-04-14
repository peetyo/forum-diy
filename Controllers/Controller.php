<?php

class Controller {
    public static function CreateView($viewName) {
        require_once "./static/components/header.php";
        require "./views/$viewName.php";
        require_once "./static/components/footer.php";

    }
}