<?php
   include("../config/config.php");

   if($_SERVER['REQUEST_METHOD']=='POST') {

   		if (isset($_POST['add_question_request'])) {

   			session_start();
   			if (isset($_SESSION['login_user_id'])) {
   				$uploader = $_SESSION['login_user_id'];
   			}else{
   				$uploader=0;
   			}

   			$type = $_POST['type'];
   			$loksewa_cat_id = $_POST['loksewa_cat_id'];

   			$question = $_POST['question'];
   			$answer = $_POST['answer'];


        	if (!empty($question) && !empty($answer)) {

        		if ($type == 2) {
        			$insertQ = "INSERT INTO `loksewa_question`(`question`, `answer`, `cat_id`,`added_by`, `status`) VALUES ('$question', '$answer', '$loksewa_cat_id','$uploader', 1)";
        		}else if ($type == 3) {
        			$insertQ = "INSERT INTO `teacher_question`(`question`, `answer`, `cat_id`,`added_by`, `status`) VALUES ('$question', '$answer', '$loksewa_cat_id','$uploader', 1)";
        		}
                  
                  
                  if(mysqli_query($db, $insertQ)) {  
                    
                      echo 'Question is succesfully added';                   

                  } else { echo 'ERROR: Could not able to execute - '.mysqli_error($db); }

                  }else{ echo 'required filled are missing'; }




        	}else if (isset($_POST['login_request'])) {

   			$email = mysqli_real_escape_string($db,$_POST['email']);
   			$password = mysqli_real_escape_string($db,$_POST['password']);

   			session_start();

        	if (!empty($email) && !empty($password)) {


			        $sql_unique_login = "SELECT `id` FROM user WHERE email = '$email'";

			        $result_unique_login = mysqli_query($db,$sql_unique_login);

			        $count_unique_login = mysqli_num_rows($result_unique_login);

			        if ($count_unique_login < 1){
			            $msg="Your login name or password is invalid";
			        }else if ($count_unique_login > 1){
			            $msg="Multiple user found with same email,Please contact your school.";
			        }else{

			            $resultLogin = mysqli_query($db,"SELECT `id`,`name`,`email`,`pwkey`,`role`,`status` FROM `user` WHERE `email` = '$email'");
			            $rowResult = mysqli_fetch_array($resultLogin,MYSQLI_ASSOC);
			              
			            $count = mysqli_num_rows($resultLogin);

			            if ($count == 1) {

			                if($rowResult['pwkey'] == $password && $rowResult['status'] == 1 ) {

			                	$_SESSION['login_user_id'] = $rowResult['id'];

			                	if($rowResult['role']==1){			                     
			                    	$_SESSION['login_user_admin'] = $email;     
			                    	$msg="Login success as admin";
			                	}else if($rowResult['role']==3){			                     
			                    	$_SESSION['login_user_moderator'] = $email;     
			                    	$msg="Login success as moderator";
			                	}

			                }else if ($rowResult['pwkey'] == $password && $rowResult['status'] != 0){
			                    $msg="Your account is disabled.";
			                }else if (empty($rowResult['pwkey']) && $rowResult['status'] == 0){
			                    $msg="Your password has been expired,Please contact support team.";
			                }else{ $msg="Your login name or password is invalid"; }
			                  
			            }else{
                                $msg = 'Unable to validate your account.';
                            } 

			        }


			    echo $msg;
        		

        	}else{ echo 'required filled are missing'; }

  
    	}else { echo 'invalid submission';  } 

    }else{ echo 'invalid request'; }

?> 
