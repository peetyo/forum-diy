<!-- Initialize the editor. -->
console.log('init')

const contentTextbox = new SimpleMDE({ element: $("#content")[0] });
contentTextbox.value("This text will appear in the editor");

$(document).on('click', '#btnSubmit', function (event) {
    event.preventDefault();

    // Check if fields are empty and valid

    const form = $('#new-topic-form').serialize()+'&content='+contentTextbox.value()
    //Maka an ajax call
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
    });
    console.log('something', simplemde.value());
})
