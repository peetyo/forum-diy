<?php

class Controller {
    public static function CreateView($viewName) {
        require "./views/$viewName.php";

    }
}