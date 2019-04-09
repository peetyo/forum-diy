<?php require_once ('pageinfo.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$appName?></title>

    <!-- All the external css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlYYjugPLSyNjTY=" crossorigin="anonymous"/>

    <!-- Main CSS -->
    <!-- TODO: Q: Should we include SRI? -->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="   css/<?=$pageCss?>">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Forum DIY</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline mx-auto">
            <input class="form-control mr-sm-2" type="text" placeholder="Login" aria-label="Login">
            <input class="form-control mr-sm-2" type="password" placeholder="Password" aria-label="Password">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
        </form>
        <span>New member? Sign up here</span>
    </div>
</nav>
