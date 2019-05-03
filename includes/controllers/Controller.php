<?php

class Controller {
    public static function CreateView($viewName) {
        $pageCss = $viewName;
        $pageJs = $viewName;
        require_once "./static/components/header.php";
        require "./includes/views/$viewName.php";
        require_once "./static/components/footer.php";
    }
}