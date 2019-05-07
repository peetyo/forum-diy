<?php require_once './static/pageinfo.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$appName?></title>

    <!-- All the external css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlYYjugPLSyNjTY=" crossorigin="anonymous"/>

    <!-- Main CSS -->
    <!-- TODO: Q: Should we include SRI? -->
    <link rel="stylesheet" href="static/css/main.css">
    <!-- <link rel="stylesheet" href="static/css/<?=$pageCss?>"> -->
    <?php 
    if(file_exists("static/css/'.$pageCss.'.css")){
        echo '<link rel="stylesheet" href="static/css/'.$pageCss.'.css">';
    }
    ?>
</head>
<body>

<!-- TODO: Style the navigation bar according to the wireframes -->
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-color">
    <a class="navbar-brand" href="#">Forum DIY</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline mx-auto login-form">
            <input class="form-control mr-sm-2" type="text" placeholder="Login" aria-label="Login">
            <input class="form-control mr-sm-2" type="password" placeholder="Password" aria-label="Password">
            <button class="btn btn-login my-2 my-sm-0" type="submit">Login</button>
        </form>
        
        <a href="sign-up" ><span  id='sign-up'>New member? Sign up here</span></a> 
    </div>
</nav>

<div class="search-bar">
    <div class="container">

        <!-- Grid row-->
        <div class="row py-4 d-flex flex-row-reverse">

            <!-- Grid column -->
            <div class="col-md-6 col-lg-5 text-center text-md-right mb-4 mb-md-0">
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row-->

    </div>
</div>