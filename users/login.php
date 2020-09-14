<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Twitter</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 4.5 -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
    <div class="global-container">
        <div class="card login-form">
            <div class="card-body">
                <h3 class="card-title text-center">Log In</h3>
                <div class="alert alert-danger" id="alertBox" style="display:none;">
                    <p id="alertLogin"></p>
                </div>
                <div class="card-text">
                    <form action="" method="post" id="FormLogin" name="FormLogin">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-sm" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-sm" id="password" name="password" required>
                        </div>
                        <input type="hidden" name="case" value="LoginUser">
                        <button type="submit" class="btn btn-primary btn-block">Log in</button>
                        
                        <div class="sign-up">
                            Haven't registered yet? <a href="../index.php" class="registera">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery 3.5 -->
<script src="../assets/bootstrap/js/jquery-3.5.1.min.js"></script>
<!-- Bootstrap 4.5 -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/js/appLogin.js"></script>
<script>
    $(document).ready(function(){
        AppLogin.initLogin();   
    });
</script>
</body>
</html>
