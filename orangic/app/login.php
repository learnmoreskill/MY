<?php
session_start();

   if(isset($_SESSION['login_user_admin']) || isset($_SESSION['login_user_manager'])){
      header("location:admin/welcome.php");
   }
   
   elseif (isset($_SESSION['login_user_moderator'])) {
       header("location:admin.php");
   }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

	<form id="login_request_form" action="updatescript.php" method="POST">

			<input type="hidden" name="login_request" value="login_request" >
			
			<input type="text" name="email" placeholder="Email id" style="height: 40px; width: 400px;">
			<br><br>
			<input type="password" name="password" placeholder="password" style="height: 40px; width: 400px;">
			<br>
			<input type="submit" name="submit">
			
		</form>

</body>
</html>
<script type="text/javascript" src="../assets/js/jquery-2.1.4.min.js"> </script>
<script type="text/javascript">
	// this is the id of the form
	$("#login_request_form").submit(function(e) {

		e.preventDefault(); // avoid to execute the actual submit of the form.

	    var form = $(this);
	    var url = form.attr('action');

	    $.ajax({
	           type: "POST",
	           url: url,
	           data: form.serialize(), // serializes the form's elements.
	           success: function(data)
	           {
	           	if (data.trim() === 'Login success as moderator'.trim()) {
	           		alert(data); // show response from the php script.
	               window.location.href = 'admin.php';
	           	}else{
	           		alert(data); // show response from the php script.
	               window.location.href = window.location.href;
	           	}
	               
	           },
	           error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            	}
	         });

	    

	    
	});
</script> 
