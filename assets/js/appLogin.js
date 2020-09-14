var AppLogin = {
	initLogin: function(){
        this.LoginUser()
	},
	MessageBox: function(rps, answer){
        if (rps) {
            $("#alertBox").css("display", "block");
            $("#alertBox").removeClass("alert-danger").addClass("alert-success");
            $("#alertLogin").html(answer); 
        }else{
            $("#alertBox").css("display", "block");
            $("#alertLogin").html(answer);
        }
    },
    LoginUser: function(){
		$("form[name=FormLogin]").submit(function(event){
            event.preventDefault()
            $.ajax({
              type: 'POST',
              dataType: 'json',
              url: '../includes/ajax/ajaxLogin.php',
              data: $('form[name=FormLogin]').serialize(),
              success: function(response, xhr, settings){
                if (response.rps) {
                  AppLogin.MessageBox(response.rps, response.answer);
                  window.location = 'home.php';
                }else{
                  AppLogin.MessageBox(response.rps, response.answer);
                }
              },error: function(response, xhr, settings){
                alert("Error");
              }
            });
        });
	}
}