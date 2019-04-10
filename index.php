<?php
// Always include CSS and JS in the very beginning
$pageCss = '';
$pageJs = '';
require_once('components/header.php');

?>

    <section class="container">
        <div class="row">
            <div class="col-12">
                <h1>Welcome to <?= $appName ?></h1>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <!-- Squared categories start
                Should be fetch
             -->
            <div class="card card-1 p-3">
                <div class="bottom-text">
                    <h2>Category name</h2>
                </div>
            </div>
            <div class="card card-1 p-3">
                <div class="bottom-text">
                    <h2>Category name</h2>
                </div>
            </div>
            <div class="card card-1 p-3">
                <div class="bottom-text">
                    <h2>Category name</h2>
                </div>
            </div>
            <div class="card card-1 p-3">
                <div class="bottom-text">
                    <h2>Category name</h2>
                </div>
            </div>
            <div class="card card-1 p-3">
                <div class="bottom-text">
                    <h2>Category name</h2>
                </div>
            </div>
            <div class="card card-1 p-3">
                <div class="bottom-text">
                    <h2>Category name</h2>
                </div>
            </div>


        </div>
    </section>

<?php

require_once('components/footer.php');
