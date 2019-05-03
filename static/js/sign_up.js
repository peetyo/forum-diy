
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
        }
  
    })
  })