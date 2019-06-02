<div class="container">
    <div class="row">
        <div class="col-3">
            This is a menu
        </div>
        <div class="col-5">
            <h2>Find a user</h2>
            <div class="row">
                <!-- Error message-->
                <div id="err-msg" class="alert alert-warning"  style="display:none;">
                    <p style="margin: 0"></p>
                </div>
                <!-- Successful signup message-->
                <div id="succ-msg" class="alert alert-success"  style="display:none;">
                    <p>User updated</p>
                </div>
                <div class="input-group mb-3">
                    <input type="text" id="userToFind" class="form-control" placeholder="Type username or email address" aria-label="Recipient's username" aria-describedby="button-addon2" value="michal">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="btn-find-user">Search</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">User info</h5>
                        This is some text within a card body.
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" id="txtUsername" disabled value="samleusername">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="txtEmail" disabled value="michal@micha.pl  " >
                        </div>
                        <h5>Actions</h5>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="moderatorCheck" disabled checked>
                            <label class="form-check-label" for="exampleCheck1">Moderator</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="activeCheck" disabled>
                            <label class="form-check-label" for="exampleCheck1">Active</label>
                        </div>
                        <input type="hidden" id="userId">
                        <input type="hidden" id="token" value="<?=$csrf?>">
                        <button type="button" id="btnSaveUser" class="btn btn-primary" disabled>Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
