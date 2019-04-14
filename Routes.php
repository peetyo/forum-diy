<?php

Route::set('index.php', function (){
    Index::CreateView('Index');
});

Route::set('home', function (){
    Home::CreateView('Home');
});

// TODO: 404 and other error handling
