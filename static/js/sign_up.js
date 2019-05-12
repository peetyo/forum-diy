//function for displaying the error message if the signup is invalid
function displayError(message) {
  
  document.getElementById("err-msg").style.display ="block";
  if(message){
    document.querySelector("#err-msg p").textContent = message;
  }
}

//function for displaying the success message
function displaySuccess(){
  document.getElementById("succ-msg").style.display="block";
}

//AJAX POST Request with sign_up data 
$('#frmSignup').submit(function(e){
    e.preventDefault()

      // try and catch to handle frontend validation
      try{
        if($('input[name = "txtUsername"]').val() =='') throw 'Add username';
        if($('input[name = "txtEmail"]').val() =='') throw 'Add email';
        if($('#frmSignup input[name = "txtPassword"]').val() =='') throw 'Add password';
        // if($('input[name = "txtConfirmPassword"]').val() =='') throw 'Confirm password';

        // if($('#topic_name').val().length < 5) throw 'Topic name should be at least 5 characters';
        // if($('#topic_name').val().length > 255) throw 'Topic name should be less than 255 characters';
        // if(contentTextbox.value().length < 5) throw 'Topic content should be at least 5 characters';
      } catch (e) {
        displayError(e)
        return;
      }

    $.ajax({
      url: "create-user",
      method: "POST",
      data: $('#frmSignup').serialize(),
      dataType: "JSON"
    }).always(function(jData){

        if(jData.status == 1){
          console.log('user created successfuly');
          document.getElementById("err-msg").style.display ="none";
          displaySuccess();
          setTimeout("location.href = './index.php';", 2000)
        }else if(jData.status == 0){
          //TODO create a toast message or something like that ?
          //$('h1').text('Incorrect login')
          displayError(jData.message);
        }else{
          // when we get a php error and pass it in the response text
          displayError('Internal Server error');
        }
    })
  })

