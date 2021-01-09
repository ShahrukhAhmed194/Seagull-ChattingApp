<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <title>Create New Account</title>
</head>
<body>
<div class="signup-form">
    <form action="" method="post">
        <div class="form-header">
            <h2>Sign Up</h2>
            <p>Sign Up To A New Social World</p>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="user_name" placeholder="Example: Shahrukh"  required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="user_pass" placeholder="Make it Hard" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" class="form-control" name="user_email" placeholder="yourname@gmail.com"  required>
        </div>
        <div class="form-group">
            <label>Country</label>
            <select class="form-control" name="user_country" required>
                <option disabled=>Select a country</option>
                <option>Bangladesh</option>
                <option>America</option>
                <option>Canada</option>
                <option>India</option>
                <option>Pakistan</option>
                <option>China</option>
            </select>
        </div>
        <div class="form-group">
            <label>Gender</label>
            <select class="form-control" name="user_gender" required>
                <option disabled=>Select your gender</option>
                <option>Male</option>
                <option>Female</option>
                <option>Others</option>
            </select>
        </div>
         <div class="form-group">
             <label class="checkbox-inline"><input type="checkbox" required>I accept the <a href="#">Terms of User </a> &amp;
                 <a href="#">Privacy Policy</a></label>
         </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-lg" name="sign_up" >Sign Up</button>
        </div>
        <?php include("signup_user.php"); ?>
    </form>

    <div class="text-center small" style="color: #674288;">Already Have an Account? <a href="signin.php">SignIn Here</a></div>

</div>


<!-- Script Support Link-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>