// $(document).ready(function () {
//     const table = $('#user-list').DataTable({
//         buttons: [
//             'selectRows',
//             'selectColumns',
//             'selectCells'
//         ],
//         "select": true,
//         "processing": true,
//         "serverSide": true,
//         "ajax": "admin-users-api",
//         "columns": [
//             { "data": "id" },
//             { "data": "username" },
//             { "data": "email" },
//             { "data": "date_createad" },
//             { "data": "active" },
//             { "data": "user_role_id"}
//         ],
//         "ordering": false
//     });
//     $('#user-list tbody').on( 'click', 'tr', function () {
//         if ( $(this).hasClass('selected') ) {
//             $(this).removeClass('selected');
//         }
//         else {
//             table.$('tr.selected').removeClass('selected');
//             $(this).addClass('selected');
//         }
//     } );
//
//     $('#button').click( function () {
//         table.row('.selected').remove().draw( false );
//     } );
// });

$(document).on('click', '#btn-find-user', function () {
    const userToFind = $('#userToFind').val();
    console.log('lecim', userToFind)
    // send an AJAX request to get the user's info
    $.ajax({
        url: 'admin-users-api',
        type: 'POST',
        data: {
            'txtSearch': userToFind
        },
        dataType: 'json'
    }).always(function (response) {
        //append information
        if (response.status == 1) {
            // execute function to append
            enableEdit(response.data)
        } else if (response.status == 0) {
            displayError(response.message)
        } else {
            displayError('Internal Server Error')
        }
    })
});

function enableEdit(dataToEnable) {
    // bind received values to variables
    const iUserId = dataToEnable['id']
    const sUserName = dataToEnable['username']
    const sEmail = dataToEnable['email']
    const iActive = dataToEnable['active']
    const iRole = dataToEnable['user_role_id']

    // insert values into the input fields
    $('#txtUsername').val(sUserName)
    $('#txtEmail').val(sEmail)
    // activate the checkbox
    $('#activeCheck').prop("disabled", false);
    // if the user active, select it
    if (iActive == 1) {
        $('#activeCheck').prop("checked", true);
    }
    $('#moderatorCheck').prop("disabled", false);
    if (iRole == 5){
        $('#moderatorCheck').prop("checked", true)
    }


}