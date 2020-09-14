<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Twitter</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 4.5 -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    <div class="global-container">
        <div class="card login-form">
            <div class="card-body">
                <h3 class="card-title text-center">Register</h3>
                <small for="username">Create an account</small>
                <div class="alert alert-danger" id="alertBox" style="display:none;">
                    <p id="alertRegister"></p>
                </div>
                <div class="card-text">
                    <form action="" method="post" id="FormRegister" name="FormRegister">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-sm" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" class="form-control form-control-sm" id="phone" name="phone" pattern="[0-9]{10}" required>
                            <small for="username">e.g. 1234566789</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-sm" id="password" name="password" minlength="6" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Repeat Password</label>
                            <input type="password" class="form-control form-control-sm" id="confirmPassword" name="confirmPassword" minlength="6" required>
                        </div>
                        <input type="hidden" name="case" value="RegisterUser">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                        
                        <div class="sign-up">
                            Already have an account? <a href="users/login.php" class="registera">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery 3.5 -->
<script src="assets/bootstrap/js/jquery-3.5.1.min.js"></script>
<!-- Bootstrap 4.5 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/appRegister.js"></script>
<script>
    $(document).ready(function(){
        AppRegister.initRegister();   
    });
</script>

</body>
</html>
