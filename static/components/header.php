<?php require_once './static/pageinfo.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $appName ?></title>

    <!-- All the external css -->
    <!-- Include CSS for icons. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlYYjugPLSyNjTY=" crossorigin="anonymous"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplemde@1.11.2/dist/simplemde.min.css"
          integrity="sha256-Is0XNfNX8KF/70J2nv8Qe6BWyiXrtFxKfJBHoDgNAEM=" crossorigin="anonymous">


    <!-- Main CSS -->
    <!-- TODO: Q: Should we include SRI? -->
    <link rel="stylesheet" href="static/css/main.css">
    <?php 
        if(file_exists("static/css/$pageCss.css")){
            echo '<link rel="stylesheet" href="static/css/'.$pageCss.'.css">';
        }
    ?>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-color">
    <a class="navbar-brand" href="index.php"><img src="./static/assets/logo.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Showing the login form only if you are NOT logged in. -->
        <?php 
        session_start(); 

        if(!isset($_SESSION['User'])){ 
            echo '
            <form class="form-inline mx-auto login-form" id="loginfrm">
                <input class="form-control mr-sm-2" name="txtUserName" type="text" placeholder="Username" aria-label="Login">
                <input class="form-control mr-sm-2" name="txtPassword" type="password" placeholder="Password" aria-label="Password">
                <button class="btn btn-login my-2 my-sm-0" type="submit">Log in</button>
            </form>
            <button class="btn btn-signup my-2 my-sm-0" type="submit" id="sign-up">Sign up</button>';
        }else{ 
          echo '<button class="btn btn-logout my-2 my-sm-0" type="submit" id="logout" >Logout</button>';
        }
        ?>
       
    </div>
    
    
</nav>

<div class="search-bar">
    <div class="container">

        <!-- Grid row-->
        <div class="row py-4 d-flex flex-row-reverse">

            <!-- Old version of search bar
            <div class="col-md-12 col-lg-12 text-center text-md-right mb-4 mb-md-0">
                <form class=" form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            -->

            <div class="search col-md-12 col-lg-12 text-center">
                <form class="form-inline">
                    <input class="search-bar form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>


            <!-- Grid column -->
        </div>
        <!-- Grid row-->
        <hr class="horizontal-line">
    </div>

</div>