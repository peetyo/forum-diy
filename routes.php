<?php
// Peter: Passing empty css and js parameters so we can perform an empty check when rendering the pages.
// if we dont perform a check we get errors that files are not found (404)
// to be honest I don't understand why we pass more than just the name of the view we need
// Should be disccussed


Route::set('index.php', function (){
    /*
     * Michal: The first function is just for the testing
     * purposes. It'll tell you whether or not DB connection works
     * TODO: Remove DatabaseTest() for the production
     */
    // Home::DatabaseTest();
    Home::CreateView('home', '', '','');
});

Route::set('category', function (){

    Category::getCategory();
});

// TODO: 404 and other error handling