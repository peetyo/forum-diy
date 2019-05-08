<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Create a new topic</h1>
        </div>
        <div class="col-md-8">
            <form id="new-topic-form">
                <div class="form-group">
                    <label for="topic_name">Title</label>
                    <input type="text" class="form-control" id="topic_name" name="topic_name"
                           placeholder="Enter the topic name here" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <?php
                        foreach ($data as $key => $category) {
                            ?>
                            <option value="<?= $category['id'] ?>">
                                <?= $category['category_name'] ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">Write your thoughts down...</label>
                    <textarea id="content"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" id="btnSubmit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>