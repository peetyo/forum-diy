<?php

class Controller {
    public static function CreateView($viewName, $css, $js, $object) {
        $pageCss = $css;
        $pageJs = $js;

        $data = $object;

        require_once "./static/components/header.php";
        require "./includes/views/$viewName.php";
        require_once "./static/components/footer.php";
    }

    public static function NotExistingPage(){
        // Let's make a nice 404 page :)
        echo '404';
        die();
    }
}