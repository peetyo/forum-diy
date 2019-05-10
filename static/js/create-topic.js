console.log('init')


const contentTextbox = new SimpleMDE({element: $("#content")[0]});
contentTextbox.value("This text will appear in the editor");


/*
onSubmit() is called by reCaptcha. We get a token in return, that needs
to be send to the server to get verified.
 */
function onSubmit(token) {
    console.log('submit', token)

    // Check if fields are empty and valid

    const form = $('#new-topic-form').serialize() + '&content=' + contentTextbox.value() + '&token=' + token
    // Make an ajax call
    $.ajax({
        url: 'api-create-topic',
        type: 'POST',
        data: form,
        dataType: 'json'
    }).always(function (response) {
        /*
        Response should include the status code
        and, if successful, the ID so we can go directly to the page.
        Otherwise, the error code. It should be a little bit more specific
         */
        console.log('response', response);
        if (response.status == 1) {
            // redirect to the proper page
            displaySuccess();
            window.location.href = "topic?id=" + response.topic;
        } else {
            displayError();
            // reset the reCaptcha to default state
            grecaptcha.reset();
        }
    });
}

$(document).on('click', '#btnSubmit', function (event) {
    event.preventDefault();
    console.log('btn clicked')
})


//function for displaying the error message if the signup is invalid
function displayError() {
    document.getElementById("err-msg").style.display = "block";
}

//function for displaying the success message
function displaySuccess() {
    document.getElementById("succ-msg").style.display = "block";
}
