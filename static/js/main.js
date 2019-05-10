//Redirect to the sign up page
 $('#sign-up').click(function(){
    window.location.href = 'sign-up'
 })
// Submit the login form from the header/nav
 $('#loginfrm').submit(function(e){
   e.preventDefault()
   $.ajax({
     url: "login",
     method: "POST",
     data: $('#loginfrm').serialize(),
     dataType: "JSON"
   }).always(function(jData){
       if(jData.Error){
           //TODO create a toast message or something like that ?
           console.log(jData.Error)
       }else{
          // PETER: Removing the form and the signup button immediately on successful login.  	
         $('#sign-up').remove();
         $('#loginfrm').remove();
         $('#navbarSupportedContent').append('<button class="btn btn-logout my-2 my-sm-0" type="submit" id="logout" >Logout</button>')
       }
   })
 })

 //Redirect to home after logout
 $(document).click(function(e){
  if(e.target.id == 'logout'){
    window.location.href = 'logout'
  }
})