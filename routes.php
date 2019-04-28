<?php
// Peter: Passing empty css and js parameters so we can perform an empty check when rendering the pages.
// if we dont perform a check we get errors that files are not found (404)
// to be honest I don't understand why we pass more than just the name of the view we need
// Should be disccussed

// Peter: included the Route class here because the autoload function became too complicated and I could not
// manage to include classes from 3 different folders. Can be improved later.
class Route {

    public static $validRoutes = array();

    public static function set($route, $function) {

        self::$validRoutes[] = $route;

        if ($_GET['url'] == $route) {
            $function->__invoke();
        }
    }
}

Route::set('index.php', function (){
    Home::CreateView('home', '', '');
});

// Peter: I think we dont need both index and home. Home is what we show at index.php
// Route::set('index.php', function (){
//     Index::CreateView('index', '', '');
// });

// Route::set('home', function (){
//     Home::CreateView('home', 'css', 'js');
// });

// TODO: 404 and other error handling