<!doctype html>
<?php
session_start();
include("include/connection.php");

if(!isset($_SESSION['user_email'])){
    header("Location: signin.php");
}else{
    ?>
<html lang="en">
<head>
    <title>SEAGULL - HOME</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" data-auto-a11y="true"></script>


<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>-->
<!--<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" data-auto-replace-svg="nest"></script>-->


    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>
<body>
   <div class="container main-section">
       <div class="row">
           <div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
               <div class="input-group searchbox">
                   <div class="input-group-btn">
                       <center><a href="include/find_friends.php"><button class="btn btn-primary search-icon" name="search_user" type="submit">Add New User</button></a></center>
                   </div>
               </div>
               <div class="left-chat">
                   <ul>
                       <?php include("include/get_users_data.php"); ?>
                   </ul>
               </div>
           </div>
           <div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
               <div class="row">
<!--                   Getting the logged in user info -->
                   <?php
                   $user = $_SESSION['user_email'];
                   $get_user = "select * from users where user_email='$user'";
                   $run_user = mysqli_query($con, $get_user);
                   $row = mysqli_fetch_array($run_user);

                   $user_id = $row['user_id'];
                   $user_name = $row['user_name'];
                   ?>

<!--                   Info according to user click and need-->
                   <?php
                   if(isset($_GET['user_name'])){

                       global $con;
                       $get_username = $_GET['user_name'];
                       $get_user = "select * from users where user_name='$get_username'";

                       $run_user = mysqli_query($con, $get_user);

                       $row_user = mysqli_fetch_array($run_user);

                       $username = $row_user['user_name'];
                       $user_profile_image = $row_user['user_profile'];
                   }
                   $total_messages = "select * from users_chat where (sender_username = '$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username')";
                   $run_messages = mysqli_query($con, $total_messages);
                   $total = mysqli_num_rows($run_messages);
                   ?>

                   <div class="col-md-12 right-header">
                       <div class="right-header-img">
                           <img src=<?php echo"$user_profile_image";?>>
                       </div>
                       <div class="right-header-detail">
                           <form method="post">
                               <p><?php echo "$username"; ?></p>
                               <span><?php echo $total; ?>messages</span>&nbsp;&nbsp;
                               <button name="logout" class="btn btn-danger">Logout</button>
                           </form>
                           <?php
                               if (isset($_POST['logout'])){
                                   $update_msg = mysqli_query($con,"UPDATE users SET log_in='offline' WHERE user_name='$user_name'");
                                   header("Location:logout.php");
                                   exit();
                               }
                           ?>
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
                   <?php
                   $update_msg = mysqli_query($con,"UPDATE users_chat SET msg_status='read' WHERE sender_username='$user_name' AND receiver_username='$username'");

                   $sel_msg = "select * from users_chat where (sender_username = '$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username') ORDER  BY 1 ASC ;";
                   $run_msg = mysqli_query($con, $sel_msg);

                   while($row = mysqli_fetch_array($run_msg)) {

                       $sender_username = $row['sender_username'];
                       $receiver_username = $row['receiver_username'];
                       $msg_content = $row['msg_content'];
                       $msg_date = $row['msg_date'];

                       ?>

                       <ul>
                           <?php
                           if ($user_name == $sender_username AND $username == $receiver_username) {
                               echo "
                         <li>
                           <div class='rightside-right-chat'>
                             <span>$username </span><small>$msg_date</small>
                             <p>$msg_content</p>
                           </div>
                         </li>
                         ";

                           }

                           else if ($user_name == $receiver_username AND $username == $sender_username) {
                               echo "
                         <li>
                           <div class='rightside-left-chat'>
                             <span>$username <small>$msg_date</small></span><br><br>
                             <p>$msg_content</p>
                           </div>
                         </li>
                         ";

                           }

                           ?>
                       </ul>
                       <?php
                        }
                       ?>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-12 right-chat-textbox">
                       <form method="post">
                           <input autocomplete="off" type="text" name="msg_content" placeholder="write you message.....">
                           <button class="btn btn-success" name="submit">Send</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>

   <?php
    if(isset($_POST['submit'])){
        $msg = htmlentities($_POST['msg_content']);

        if($msg==""){
            echo"
            <div class='alert alert-danger'>
             <strong> <center>Unable to send message.</center> </strong>
            </div>
            ";
        }
        else if(strlen($msg)>100){
            echo"
            <div class='alert alert-danger'>
             <strong> <center>Message can not be over 100 characters .</center> </strong>
            </div>
            ";
        }
        else{
            $insert = "insert into users_chat(sender_username, receiver_username, msg_content, msg_status, msg_date) values('$user_name', '$username', '$msg', 'unread', NOW())";
            $run_insert = mysqli_query($con, $insert);
        }
    }
   ?>

   <script>
       $('#scrolling_to_bottom').animate({
           scrollTop: $('#scrolling_to_bottom').get(0).scrollHeight}, 1000);
   </script>
   <script type="text/javascript">
       $(document).ready(function(){
           var height = $(window).height();
           $('.left-chat').css('height', (height - 92) + 'px');
           $('.right-header-contentChat').css('height', (height - 163) + 'px');
       });
   </script>

</body>
</html>
<?php } ?>