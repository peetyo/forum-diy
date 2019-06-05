// Find user
$(document).on('click', '#btn-find-user', function () {
    // hide errors if they already shown
    hideError()
    const userToFind = $('#userToFind').val();
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
            displayList(response.data)
        } else if (response.status == 0) {
            displayError(response.message)
        } else {
            displayError('Internal Server Error')
        }
    })
});

// Save user data
$(document).on('click', '#btnSaveUser', function () {
    const iUserId = $('#userId').val()
    const iActive = document.getElementById('activeCheck').checked == true ? 1 : 0;
    const iRole = document.getElementById('moderatorCheck').checked == true ? 5 : 4;
    const token = $('#token').val()
    console.log('iRole', iRole)
    $.ajax({
        url: 'admin-users-update-api',
        type: 'POST',
        data: {
            'iUserId' : iUserId,
            'iActive' : iActive,
            'iRole' : iRole,
            'token': token
        },
        dataType: 'json'
    }).always(function (response) {
        //append information
        if (response.status == 1) {
            // execute function to append
            displaySuccess()
            disableEdit()
        } else if (response.status == 0) {
            displayError(response.message)
        } else {
            displayError('Internal Server Error')
        }
    })
})

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
    $('#userId').val(iUserId)
    // activate the checkbox
    $('#activeCheck').prop("disabled", false)
    // if the user active, select it
    if (iActive == 1) {
        $('#activeCheck').prop("checked", true)
    }
    $('#moderatorCheck').prop("disabled", false)
    if (iRole == 5) {
        $('#moderatorCheck').prop("checked", true)
    }
    $('#btnSaveUser').prop("disabled", false)
}

function disableEdit() {
    // disable current status
    $('#activeCheck').prop("disabled", true)
    $('#moderatorCheck').prop("disabled", true)
    $('#btnSaveUser').prop("disabled", true)

}

function displayList(users) {
    // first, remove whatever is lest
    //$('#usersResult').empty()
    $('#usersResult').children().fadeOut(200).promise().then(function() {
        $('#usersResult').empty();
        // then insert new results
        let fadeInTime = 200
        users.forEach(function (user) {
            console.warn(fadeInTime)
            console.log(user.id)
            let txtRole = '';
            if(user.user_role_id == 5){
                txtRole = 'Moderator'
            } else if (user.user_role_id == 6){
                txtRole = 'Administrator'
            }
            $('#usersResult').append('<li class="list-group-item d-flex justify-content-between align-items-center">\n' +
                '                    '+user.username+
                '                    <span class="badge badge-primary badge-pill">'+txtRole+'</span>\n' +
                '                </li>').hide().fadeIn(fadeInTime)
            fadeInTime = fadeInTime + 100
        })
    });

    //$('#usersResult').append()
}