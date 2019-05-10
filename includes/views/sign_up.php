<div class="d-flex justify-content-center align-items-center container ">

<form id='frmSignup' class='col-6 m-3 centered'>

<!-- Error message-->
<div id="err-msg" class="alert alert-warning"  style="display:none;">
  <p>Incorrect sign up, please try again.</p>
</div>

<!-- Successful signup message-->
<div id="succ-msg" class="alert alert-success"  style="display:none;">
  <p>Your signup was successful. You'll be redirected to the main page in a moment...</p>
  <p>If you are not redirected click <a href="./index.php">here</a> </p>
</div>

<!-- We should display the requirement for the signup for example:
  Password (at least 6 characters)
  Because we are not specifying what's the error, so the user won't understand why it's not working -->


<div class="form-group">
    <label>Username</label>
    <p>Username should be between 6-20 characters. </p>
    <input name="txtUserName" type="text"  class="form-control" placeholder="Enter username">
  </div>
  <div class="form-group">
    <label>Email address</label>
    <input name="txtEmail" type="email"  class="form-control" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label>Password</label>
    <p>Password should be between 6-20 character</p>
    <input name="txtPassword" type="password"  class="form-control" placeholder="Password">
  </div>
  <div class="form-group">
    <label>Confirm Password</label>
    <input name="txtConfirmPassword" type="password"  class="form-control" placeholder="Password">
  </div>
    <input type="hidden" name="token" value="<?= $csrf ?>">
  <button type="submit" class="btn btn-secondary">Submit</button>
</form>

</div>


