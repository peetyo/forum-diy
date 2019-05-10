<?php

class Controller {
    public static function CreateView($viewName, $object) {
        $pageCss = $viewName;
        $pageJs = $viewName;
        $data = $object;
        require_once "./static/components/header.php";
        require "./includes/views/$viewName.php";
        require_once "./static/components/footer.php";
    }

}