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
            // something to display error message like toast or something 
            console.log('ebaha mamata na tazi darjava')
        }
  
    })
  })