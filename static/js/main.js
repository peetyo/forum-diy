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
    if (jData.status == 1) {
      $('#sign-up').remove();
         $('#loginfrm').remove();
         $('#navbarSupportedContent').append('<button class="btn btn-logout my-2 my-sm-0" type="submit" id="logout" >Logout</button>')
         if(window.location.href.includes('forum-diy/category')){
           $('#create-button-wrapper').append('<a href="create-topic" class="btn create-topic mb-2">Create topic</a>')
         }
    } else if(jData.status == 0){
      console.log(jData.message)
    } else{
      console.log('Internal Server error')
    }

   })
 })

 //Redirect to home after logout
 $(document).click(function(e){
  if(e.target.id == 'logout'){
    window.location.href = 'logout'
  }
})