//Redirect to the sign up page
$('#sign-up').click(function () {
    window.location.href = 'sign-up'
})
// Submit the login form from the header/nav
$('#loginfrm').submit(function (e) {
    e.preventDefault()
    $.ajax({
        url: "login",
        method: "POST",
        data: $('#loginfrm').serialize(),
        dataType: "JSON"
    }).always(function (jData) {
        if (jData.status == 1) {
            if(window.location.href.includes('forum-diy/topic')){
                location.reload();
            }
            $('#sign-up').remove();
            $('#loginfrm').remove();
            $('#navbarSupportedContent').append('<button class="btn btn-logout my-2 my-sm-0" type="submit" id="logout" >Logout</button>')
            $('#actions').append('<div id="userActions">\n' +
                '                            <p>\n' +
                '                                <a href="logout">Log out</a>\n' +
                '                            </p>\n' +
                '                        </div>')
            $('#guestActions').remove()
            if (window.location.href.includes('forum-diy/category')) {
                $('#create-button-wrapper').append('<a href="create-topic" class="btn create-topic mb-2">Create topic</a>')
            }
        } else if (jData.status == 0) {
            console.log(jData.message)
        } else {
            console.log('Internal Server error')
        }

    })
})

//Redirect to home after logout
$(document).click(function (e) {
    if (e.target.id == 'logout') {
        window.location.href = 'logout'
    }
})

//function for displaying the error message if the signup is invalid
function displayError(message) {
  
    document.getElementById("err-msg").style.display ="block";
    setTimeout(function(){
        console.log('scroll')
        document.getElementById("err-msg").scrollIntoView({
            behavior: 'smooth',
            block:'start'});
    },500)
    // errorContainer.scrollIntoView();
    if(message){
      document.querySelector("#err-msg p").textContent = message;
    }
}

//function for displaying the success message
function displaySuccess() {
    document.getElementById("err-msg").style.display = "none";
    document.getElementById("succ-msg").style.display = "block";
    const errorContainer = document.getElementById("succ-msg");
    setTimeout(function(){
        document.getElementById("succ-msg").scrollIntoView({
            behavior: 'smooth',
            block:'start'});
    },500)
}