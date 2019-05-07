$('#loginfrm').submit(function(e){
  e.preventDefault()
  $.ajax({
    url: "login",
    method: "POST",
    data: $('#loginfrm').serialize(),
    dataType: "JSON"
  }).always(function(jData){
    console.log(jData)
      if(jData.Error){
          //TODO create a toast message or something like that ?
          console.log(jData.Error)
      }

  })
})