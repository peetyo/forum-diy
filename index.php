<?php
// Always include CSS and JS in the very beginning
$pageCss = '';
$pageJs = '';
require_once ('components/header.php');

?>

<section class="container">
    <div class="row">
        <div class="col-12">
            <h1>Welcome to <?=$appName?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Squared categories start
                Should be fetch
             -->
            <div class="card card-1">
                <div class="bottom-text">
                    <span>Category name</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

require_once ('components/footer.php');
