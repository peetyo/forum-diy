<?php
?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#"><?=$data->topicData[0]["category_name"]?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?=$data->topicData[0]["topic_name"]?> </li>
        </ol>
    </nav>
    <div class="row">

        <div class="col-md-8">
            <div class="col-12">
                <h1><?= $data->topicData[0]["topic_name"] ?></h1>
            </div>
            <div class="col-12">
                <div class="card topic">
                    <div class="card-header bg-dark text-white">
                        <img src="https://via.placeholder.com/25" alt="User's profile picture">
                        <span class="username"> <?= $data->topicData[0]["username"]?></span> posted on
                        <span class="comment-date"><?=$data->topicData[0]["date_created"]?></li>
                        </span>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <?= $data->topicData[0]["content"] ?>
                        </p>
                    </div>
                    <div class="text-right card-footer text-muted bg-dark">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary">Reply</button>
                            <button type="button" class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                </div>
                <?php
                /*
                 * Michal: Looping through comments.
                 * Our logic (controller) fetch all the information needed
                 * Now it's just displaying, therefore we need a loop
                 * for our array
                 */
                // To make it easier, I extract comments from the passed object
                $comments = $data->commentData;
                foreach ($comments as $key => $comment){
                ?>
                <div class="card comment">
                    <div class="card-header">
                        <img src="https://via.placeholder.com/25" alt="User's profile picture">
                        <span class="username">
                            <?=$comment["username"]?>
                        </span>
                        posted on
                        <span class="comment-date">
                            <?=$comment["date_created"]?>
                        </span>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                           <?=$comment["content"]?>
                        </p>
                    </div>
                    <div class="text-right card-footer text-muted">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary">Reply</button>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="col-12">
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active">
                          <span class="page-link">
                            2
                            <span class="sr-only">(current)</span>
                          </span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/200" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Topic info</h5>
                    <ul>
                        <li>Created on <?=$data->topicData[0]["date_created"]?></li>
                        <?php
                        /* Michal: In the <li> below, system checks if there are any comments.
                         * If yes, it echo 'x replies' else 'No replies'
                         * If you want to read more on it, google 'Ternary Operator PHP'
                         */
                        ?>
                        <li><?=$data->topicData[0]["comments"] > 0 ? $data->topicData[0]["comments"]. " replies" :  "No replies" ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
