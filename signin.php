<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/signin.css">
    <title>Log In To Your Account</title>
</head>
<body>
      <div class="signin-form">
          <form action="" method="post">
              <div class="form-header">
                  <h2>Sign In</h2>
                  <p>Login To Seagull</p>
              </div>
              <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" placeholder="yourname@gmail.com" autocomplete="off" required>
              </div>
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="pass" placeholder="Make it Hard" autocomplete="off" required>
              </div>
              <div class="small">
                  Forgot Password? <a href="forgot_pass.php">click here</a>
              </div> <br>
              <div class="form-group">
                 <button type="submit" class="btn btn-primary btn-block btn-lg" name="sign_in" >Sign In</button>
              </div>
              <?php include("signin_user.php"); ?>
          </form>
          
          <div class="text-center small" style="color: #674288;">Don't Have an Account? <a href="signup.php">Create Account</a></div>

      </div>


<!-- Script Support Link-->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>