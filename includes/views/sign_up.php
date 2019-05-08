

<form id='frmSignup' class='col-4 m-3'>
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
    <label>User name</label>
    <input name="txtUserName" type="text" value='test' class="form-control" placeholder="Enter username">
  </div>
  <div class="form-group">
    <label>Email address</label>
    <input name="txtEmail" type="email" value='AKER@a.com' class="form-control" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input name="txtPassword" type="password" value='1234567' class="form-control" placeholder="Password">
  </div>
  <div class="form-group">
    <label>Confirm Password</label>
    <input name="txtConfirmPassword" type="password" value='1234567' class="form-control" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>