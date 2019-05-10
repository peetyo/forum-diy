<section class="container">
   
   <!-- Not sure we need this row section, could be deleted -->
    <div class="row">
        <div class="col-12">
            <h1>This is category with ID : <?= $data['category'] ?></h1>
            
            <p>Here are the topics about XY category.</p>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-3">
            <button class="col-12">Create thread</button>
            <h3>Tags</h3>
            <div class="list-group">
                <a href="#">All</a>
                <a href="#">Tag1</a>
                <a href="#">Tag2</a>
                <a href="#">Tag2</a>
                <a href="#">Tag1</a>
                <a href="#">Tag2</a>
                <a href="#">Tag1</a>
                <a href="#">Tag2</a>
                <a href="#">Tag1</a>
                <a href="#">Tag2</a>
            </div>
        </div>

<!-- PETER: Not sure why this is here. -->
<!-- <div class="row">


</div> -->

    <div class="col-md-9 pl-3 mb-5">
        
        <!-- This is the original template. 
            <div class="panel panel-default">
            <div class="panel-body">
                    <div class="panel-heading">
                        <h4>Main title or question or topic</h4>
                    </div>
                        <p>Text about explaining the question or something else a bit longer but should be max 2 lines then....</p>
            </div>
            <div class="thread-info">
                <div class="thread-info-avatar">
                <img class="img-circle" src="https://www.ukielist.com/wp-content/uploads/2017/03/default-avatar.png" alt="avatar">
                </div>
                <div class="thread-info-author">
                </div>
                <div class="thread-info-tags">
                    <a href="#">Tag1</a>
                    <a href="#">Tag2</a>
                </div>
            </div>
        </div> -->
        
        <?php 
                // print_r($data); 
                foreach ($data['topics'] as $topic) {

                    echo '<a href="topic?id='.$topic['id'].'">
                    <div id='.$topic['id'].' class="panel panel-default mb-2">
                        <div class="panel-body">
                                <div class="panel-heading">
                                    <h4>'.$topic['topic_name'].'</h4>
                                </div>
                                    <p>'.substr($topic['content'], 0, 100).'...</p>
                        </div>
                        <div class="thread-info">
                            <div class="thread-info-avatar">
                            <img class="img-circle" src="https://www.ukielist.com/wp-content/uploads/2017/03/default-avatar.png" alt="avatar">
                            </div>
                            <div class="thread-info-author">
                            </div>
                            <div class="thread-info-tags">
                                
                            </div>
                        </div>
                    </div>
                    </a>';
                }
            ?>

    </div>


</section>
