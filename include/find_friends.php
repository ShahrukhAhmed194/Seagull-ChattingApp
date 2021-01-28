<!doctype html>
<?php
session_start();
include("find_friends_function.php");

if(!isset($_SESSION['user_email'])){
    header("Location: signin.php");
}else{
?>
<html lang="en">
<head>
    <title>SEAGULL - Find Friends</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" data-auto-a11y="true"></script>


    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>-->
    <!--<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" data-auto-replace-svg="nest"></script>-->


    <link rel="stylesheet" type="text/css" href="../css/find_people.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>
<body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark"  href="#">
            <a class="navbar-brand" href="#">
                <?php
                    $user = $_SESSION['user_email'];
                    $get_user = "select * from users where user_email = '$user'";
                    $run_user = mysqli_query($con,$get_user);
                    $row = mysqli_fetch_array($run_user);

                    $user_name = $row['user_name'];
                    echo"<a href='../home.php?user_name'>SEAGULL</a>";
                ?>
            </a>
            <ul class="navbar-nav">
                <li>
                    &nbsp;
                    &nbsp;
                    <a style="color: red;text-decoration: none;font-size: 20px;" href="../account_settings.php">Settings</a>
                </li>
            </ul>
        </nav>
        <br>
        <div class="row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-5">
                <form class="search_form" action="">
                    <input type="text" name="search_query" placeholder="Search Friends" autocomplete="off" required>
                    <button  type="submit" name="search_btn">Search</button>
                </form>
            </div>
            <div class="col-sm-3">
            </div>
        </div>
        <br><br>
        <?php search_user();?>

</body>
</html>
<?php } ?>