<?php
// Peter: Passing empty css and js parameters so we can perform an empty check when rendering the pages.
// if we dont perform a check we get errors that files are not found (404)
// to be honest I don't understand why we pass more than just the name of the view we need
// Should be disccussed

ini_set('display_errors', 1);
Route::set('index.php', function (){
    Home::CreateView('home','');

// MORTY: i left this for testing purpose
// $test = new Users;
// $test->read_users();
});

Route::set('category', function (){
    Home::CreateView('category', '');
});

Route::set('sign-up', function (){
    User_Controller::CreateView('sign_up','');
   // Sign_up::test();
});

Route::set('create-user', function (){
    User_Controller::create_user();
});

Route::set('login', function(){
    User_Controller::login_user();
});

// In the get, we need to pass additional array with the keys
// that we are expecting
// Peter: changed topic.php to topic. Just to have nicer urls
Route::set('topic', function (){
    SingleTopic::GetTopic();
});
// TODO: 404 and other error handling
