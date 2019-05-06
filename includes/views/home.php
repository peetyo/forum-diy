<?php
// Always include CSS and JS in the very beginning


?>

    <section class="container">
        <div class="row">
            <div class="col-12">
                <p>CSS is <?=$pageCss?> and JS is <?=$pageJs?></p>
            </div>
        </div>
        <div
         class="row cards-container d-flex justify-content-center">
            <!-- Squared categories start
                Should be fetch
             -->
             <div class="card card-1 border-light mb-3">
                 <div class="img-container">
                 <img src="./static/assets/house.png" class="card-img card-img-top" alt="">
                 </div>
               
                <div class="card-body">
                    <hr class="cat1-line">
                    <a href="#"><h4 class="cat1-text">Category Name</h4></a>
                    <p class="card-text">Click this if you're interested</p>

                </div>
             </div>

             <div class="card card-1 border-light mb-3">
                 <div class="img-container">
                 <img src="./static/assets/search.png" class="card-img card-img-top" alt="">
                 </div>
               
                <div class="card-body">
                    <hr class="cat2-line">
                    <a href="#"><h4 class="cat2-text">Category Name</h4></a>
                    <p class="card-text">Click this if you're interested</p>

                </div>
             </div>

             <div class="card card-1 border-light mb-3">
                 <div class="img-container">
                 <img src="./static/assets/route.png" class="card-img card-img-top" alt="">
                 </div>
               
                <div class="card-body">
                    <hr class="cat3-line">
                    <a href="#"><h4 class="cat3-text">Category Name</h4></a>
                    <p class="card-text">Click this if you're interested</p>

                </div>
             </div>



             


            </div>


        </div>
    </section>
