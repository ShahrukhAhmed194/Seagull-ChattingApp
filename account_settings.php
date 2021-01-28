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
    <title>SEAGULL - Account Settings</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" data-auto-a11y="true"></script>-->
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>-->
<!--    <script src="maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/boootstrap.min.js"></script>-->


    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>-->
    <!--<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" data-auto-replace-svg="nest"></script>-->

<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.js">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>
<body>
    <div class="row">
        <div class="col-sm-2">

        </div>
<!--        get info start-->
        <?php
            $user = $_SESSION['user_email'];
            $get_user = "select * from users where user_email='$user'";
            $run_user = mysqli_query($con,$get_user);
            $row = mysqli_fetch_array($run_user);

            $user_name = $row['user_name'];
            $user_pass = $row['user_pass'];
            $user_email = $row['user_email'];
            $user_profile = $row['user_profile'];
            $user_country = $row['user_country'];
            $user_gender = $row['user_gender'];
        ?>
    <!--        get info end-->

<!--    design part start-->
    <div class="col-sm-8" >
        <form action="" method="post" enctype="multipart/form-data">
            <table class="table table-bordered table-hover">
                <tr align="center">
                    <td colspan="6" class="active"><h2>Change Account Settings</h2></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Change Your Name.</td>
                    <td>
                        <input type="text" name="u_name" class="form-control" required value="<?php echo $user_name;?>"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><a class="btn btn-dark" style="text-decoration: none;font-size: 15px;" href="upload.php"><i class="fa fa-user" aria-hidden="true"></i>Change Profile Picture</a></td>
                </tr>

                <tr>
                    <td style="font-weight: bold;">Change Your Email.</td>
                    <td>
                        <input type="email" name="u_email" class="form-control" required value="<?php echo $user_email;?>"/>
                    </td>
                </tr>

                <tr>
                    <td style="font-weight:bold;">Country</td>
                    <td>
                        <select class="form-control" name="u_country">
                            <option><?php echo $user_country;?></option>
                            <option>America</option>
                            <option>Bangladesh</option>
                            <option>India</option>
                            <option>Pakistan</option>
                            <option>Uganda</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td style="font-weight:bold; ">Gender</td>
                    <td>
                        <select class="form-control" name="u_gender">
                            <option><?php echo $user_gender;?></option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Others</option>
                        </select>
                    </td>
                </tr>
                <!--    design part end-->
                <!--   Security Question Section start-->

                <tr>
                    <td style="font-weight: bold;">Security Question</td>
                    <td>
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal">Update Answer</button>

                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="recovery.php?id=<?php echo $user_id; ?>" method="post" id="f">
                                            <strong>Who was your best friend in school?</strong>
                                            <textarea class="form-control" cols="83" rows="4"  name="content" placeholder="A Friend"></textarea>
                                            <br>
                                            <input class="btn btn-secondary" type="submit" name="sub" value="Submit" style="width: 100px;"><br><br>
                                            <pre>These questions will be asked if you forger your <br> password.</pre>
                                            <br><br>
                                        </form>
                                        <?php
                                        if(isset($_POST['sub'])){
                                          $bfn = htmlentities($_POST['content']);
                                          if($bfn == ''){
                                             echo"<script>alert('Please Write a Name.')
                                             </script>";
                                             echo"<script>window.open('account_settings.php','_self')
                                             </script>";
                                             exit();
                                          }
                                          else{
                                              $update = "update users set forgotten_answer = '$bfn' where user_email='$user'";
                                              $run = mysqli_query($con, $update);

                                              if($run){
                                                  echo"<script>alert('Working.....')</script>";
                                                  echo"<script>window.open('account_settings.php','_self')</script>";
                                              }
                                              else{
                                                  echo"<script>alert('Error while updating.')
                                                  </script>";
                                                  echo"<script>window.open('account_settings.php','_self')
                                                  </script>";
                                              }
                                          }
                                        }

                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                        <!--Security Question Section End-->
                </tr>
                <tr><td></td>
                    <td><a class="btn btn-dark" style="text-decoration: none;font-size: 15px;" href="change_password.php"><i class="fa fa-key fa-fw" aria-hidden="true"></i>Change Password</a></td>
                </tr>
                <tr align="center">
                    <td colspan="6">
                        <input type="submit" value="update" name="update" class="btn btn-info">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if(isset($_POST['update'])){
            $user_name = htmlentities($_POST['u_name']);
            $email = htmlentities($_POST['u_email']);
            $u_country = htmlentities($_POST['u_country']);
            $u_gender = htmlentities($_POST['u_gender']);

            $update = "update users set user_name = '$user_name', user_email='$email', user_country='$u_country', user_gender='$u_gender' where user_email='$user'";

            $run = mysqli_query($con, $update);

            if($run){
                echo"<script>window.open('account_settings.php','_self')</script>";
            }
        }
        ?>

    </div>


    <div class="col-sm-2">

    </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<?php }?>
