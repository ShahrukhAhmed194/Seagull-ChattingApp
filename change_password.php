<!doctype html>
<?php
session_start();
include("include/connection.php");
include("include/header.php");

if(!isset($_SESSION['user_email'])){
    header("Location: signin.php");
}else{
?>
<html lang="en">
<head>
    <title>SEAGULL - Change Password</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<!--    <link rel="stylesheet" type="text/css" href="css/upload.css">-->
</head>
<style>
    body{
        overflow-x: hidden;
    }
</style>
<body>
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="table table-bordered table-hover">
                    <tr align="center">
                        <td colspan="6" class="active">
                            <h2>Change Password</h2></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Current Password.</td>
                        <td>
                            <input type="password" name="current_pass" id="mypass" class="form-control"
                                   required placeholder="Current Password." />
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">New Password.</td>
                        <td>
                            <input type="password" name="u_pass1" id="mypass" class="form-control"
                                   required placeholder="New Password." />
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Confirm Password.</td>
                        <td>
                            <input type="password" name="u_pass2" id="mypass" class="form-control"
                                   required placeholder="Confirm Password." />
                        </td>
                    </tr>
                    <tr align="center">
                        <td colspan="6">
                            <input type="submit" name="change" value="Change" class="btn btn-info"/>
                        </td>
                    </tr>
                </table>
            </form>
             <?php
               if(isset($_POST['change'])){

                   $c_pass = $_POST['current_pass'];
                   $pass1 = $_POST['u_pass1'];
                   $pass2 = $_POST['u_pass2'];

                   $user = $_SESSION['user_email'];
                   $get_user = "select * from users where user_email='$user'";
                   $run_user = mysqli_query($con,$get_user);
                   $row = mysqli_fetch_array($run_user);

                   $user_password  = $row['user_pass'];

                   if($c_pass !== $user_password){
                       echo"
                       <div class='alert alert-danger'>
                         <strong>Old Password is Wrong</strong>
                       </div>
                       ";
                   }
                   if($pass1 !== $pass2){
                       echo"
                         <div class='alert alert-danger'>
                            <strong>New Passwords didn't Match.</strong>
                        </div>
                       ";
                   }
                   if($pass1 < 9 AND $pass2 < 9){
                       echo"
                         <div class='alert alert-danger'>
                            <strong>Use at least 9 characters.</strong>
                        </div>
                       ";
                   }
                   if($pass1 == $pass2 AND $c_pass == $user_password){
                       $update_pass = mysqli_query($con, "UPDATE users 
                        SET user_pass='$pass1' WHERE user_email='$user'");

                       echo"
                       <div class='alert alert-danger'>
                            <strong>Your password is changed.</strong>
                        </div>
                       ";
                   }
               }
             ?>
        </div>
    </div>
    <div class="col-sm-2">

    </div>
</body>
</html>
<?php } ?>