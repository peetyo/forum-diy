<?php

Route::set('index.php', function (){
    Home::CreateView('home','');

// MORTY: i left this for testing purpose
// $test = new Users;
// $test->read_users();
});

Route::set('sign-up', function (){
    Sign_up::CreateView('sign_up','');
   // Sign_up::test();
});
Route::set('topics', function (){
    Home::CreateView('topics', 'topics', '');
});

// Peter: I think we dont need both index and home. Home is what we show at index.php
// Route::set('index.php', function (){
//     Index::CreateView('index', '', '');
// });

Route::set('create-user', function (){
    Sign_up::create_user();
});

// In the get, we need to pass additional array with the keys
// that we are expecting
Route::set('topic.php', function (){
    SingleTopic::GetTopic();
});
// TODO: 404 and other error handling
