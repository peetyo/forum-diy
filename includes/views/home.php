<?php
// Always include CSS and JS in the very beginning


?>

    <section class="container">
        <div class="row">
            <div class="col-12">
                <h1>Welcome to <?= $appName ?></h1>
                <p>CSS is <?=$pageCss?> and JS is <?=$pageJs?></p>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <!-- Squared categories start
                Should be fetch
             -->
            <a href="category?cat=home">
                <div class="card card-1 p-3">
                    <div class="bottom-text">
                        <h2>Category name</h2>
                    </div>
                </div>
            </a>
            <a href="category?cat=office">
                <div class="card card-1 p-3">
                    <div class="bottom-text">
                        <h2>Category name</h2>
                    </div>
                </div>
            </a>
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
