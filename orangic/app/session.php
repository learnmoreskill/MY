<?php

   date_default_timezone_set('Asia/Kathmandu');

   require('../config/config.php');
   session_start();

  /*  if(isset($_SESSION['login_user_admin'])){
   
       $user_check = $_SESSION['login_user_admin'];
       
       $ses_sql = mysqli_query($db,"SELECT * FROM `user` WHERE `email` = '$user_check' and `status` = 1 ");
       
       $pac = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

       $countrow = mysqli_num_rows($ses_sql);
       if($countrow != 1) {
       session_destroy();
       unset($_SESSION['login_user_admin']);
       header("Location: login.php");
       exit();
        }
       //mysqli_close($db);
       
       $LOGIN_CAT = 4;

       $LOGIN_ID = $pac['id'];
       $LOGIN_NAME = $pac['name'];
       $LOGIN_EMAIL = $pac['email'];
       $LOGIN_SEX  = $pac['gender'];
       $LOGIN_MOBILE  = $pac['mobile'];

    }
*/
   
   /*if(!isset($_SESSION['login_user_admin'])){
      header("location:login.php");
   }*/

   if(isset($_SESSION['login_user_admin']) || isset($_SESSION['login_user_moderator'])){
   }else{
      header("location:login.php");
   }

?>
