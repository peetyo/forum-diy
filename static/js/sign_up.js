//function for displaying the error message if the signup is invalid
function displayError(text) {
  
  document.getElementById("err-msg").style.display ="block";
  if(text){
    document.querySelector("#err-msg p").textContent = text;
  }
}

//function for displaying the success message
function displaySuccess(){
  document.getElementById("succ-msg").style.display="block";
}

//AJAX POST Request with sign_up data 
$('#frmSignup').submit(function(e){
    e.preventDefault()
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
          displayError(jData.text);
        }else{
          // when we get a php error and pass it in the response text
          displayError('Internal Server error')
        }
    })
  })

