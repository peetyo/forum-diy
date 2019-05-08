//function for displaying the error message if the signup is invalid
function displayError() {
  document.getElementById("err-msg").style.display ="block";
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
      console.log(jData)
        if(jData.Error){
            //TODO create a toast message or something like that ?
            console.log(jData.Error)
            //$('h1').text('Incorrect login')
            displayError();

        }else{
          console.log('Valid signup - not necessary successful :)');
          displaySuccess();
         // setTimeout("location.href = './index.php';", 3000)
        }
  
    })
  })

