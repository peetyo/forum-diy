<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Create a new topic</h1>
        </div>
        <div class="col-md-8">
            <!-- Error message-->
            <div id="err-msg" class="alert alert-warning" style="display:none;">
                <p>Something went wrong, please try again.</p>
            </div>

            <!-- Successful signup message-->
            <div id="succ-msg" class="alert alert-success" style="display:none;">
                <p>Your topic was added successfully.
                    You'll be redirected to the main page in a moment...</p>
            </div>
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
                    <button class="g-recaptcha btn btn-primary" id="btnSubmit"
                            data-sitekey="6LdagqIUAAAAAPPCF-37cRYK8J5d48NidRdJmVYE"
                            data-callback='onSubmit'>Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>