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
    Home::DatabaseTest();
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

// In the get, we need to pass additional array with the keys
// that we are expecting
Route::set('topic.php', function (){
    Topic::CreateView('topic','topic','');
});