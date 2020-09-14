var AppRegister = {
	initRegister: function(){
        this.RegisterUser()
	},
	MessageBox: function(rps, answer){
        if (rps) {
            $("#alertBox").css("display", "block");
            $("#alertBox").removeClass("alert-danger").addClass("alert-success");
            $("#alertRegister").html(answer); 
        }else{
            $("#alertBox").css("display", "block");
            $("#alertRegister").html(answer);
        }
    },
    RegisterUser: function(){
		$("form[name=FormRegister]").submit(function(event){
            event.preventDefault()
            $.ajax({
              type: 'POST',
              dataType: 'json',
              url: 'includes/ajax/ajaxRegister.php',
              data: $('form[name=FormRegister]').serialize(),
              success: function(response, xhr, settings){
                if (response.rps) {
                  AppRegister.MessageBox(response.rps, response.answer);
                  window.location = 'users/login.php';
                }else{
                  AppRegister.MessageBox(response.rps, response.answer);
                }
              },error: function(response, xhr, settings){
                alert("Error");
              }
            });
        });
	}
}