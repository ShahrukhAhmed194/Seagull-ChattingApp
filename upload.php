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
    <title>SEAGULL - Change Profile Picture</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/upload.css">
</head>
<body>
     <?php
     $user = $_SESSION['user_email'];
     $get_user = "select * from users where user_email='$user'";
     $run_user = mysqli_query($con,$get_user);
     $row = mysqli_fetch_array($run_user);

     $user_name = $row['user_name'];
     $user_profile = $row['user_profile'];

     echo"
       <div class='card' >
        <img src='$user_profile'>
        <h3>$user_name</h3>
        <form method='post' enctype='multipart/form-data'>
          <label id='update_profile'>
          <i class='fa fa-circle-o' aria-hidden='true'></i>Select
          <input type='file' name='u_image' size='60'>
          </label>
          <button id='button_profile' name='update'>
          <i class='fa fa-heart' aria-hidden='true'></i>Update</button>
        </form>
        </div> 
        <br><br>
     ";

     if(isset($_POST['update'])){
         $u_image = $_FILES['u_image']['name'];
         $image_tmp = $_FILES['u_image']['tmp_name'];
         $random_number = rand(1,99);

         if($u_image==''){
             echo"<script>alert('Please Select a Profile Picture')</script>";
             echo"<script>window.open('upload.php', '_self')</script>";
             exit();
         }
         else{
             move_uploaded_file($image_tmp,"images/$u_image.$random_number");

             $update = "update users set user_profile='images/$u_image.$random_number'
             where user_email='$user'";

             $run = mysqli_query($con, $update);

             if($run){
                 echo"<script>alert('Profile Picture uploaded successful.')</script>";
                 echo"<script>window.open('upload.php', '_self')</script>";

             }
         }
     }
     ?>
</body>
</html>
<?php } ?>