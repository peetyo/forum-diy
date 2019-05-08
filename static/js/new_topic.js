<!-- Initialize the editor. -->
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
    //Make an ajax call
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
        if (response.status == "ok") {

        } else {
            // redirect to the proper page
            //window.location.href = "topic.php";
        }
    });
    console.log('something', simplemde.value());
}

$(document).on('click', '#btnSubmit', function (event) {
    event.preventDefault();


})
