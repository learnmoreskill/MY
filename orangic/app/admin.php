<?php 
	include('session.php');

	include("../important/backstage.php");
	$backstage = new back_stage_class();

	

?>
<!DOCTYPE html>
<html>
<head>
	<title>Question Answer</title>
</head>
<body>
	<?php if ($_GET["token"]=="nskqa") { 

		if (empty($_GET["type"])) 
			{  ?> <script> alert("Please select type"); window.location.href = 'admin.php';</script> <?php }
		if (empty($_GET["cat"])) 
			{  ?> <script> alert("Please select category"); window.location.href = 'admin.php';</script> <?php }

		?>

		<a href="admin.php">Go Home</a><a href="logout.php">Logout</a>
		<h1>Please Add Question Answer to <?php echo (($_GET["type"]=="2")? 'Loksewa' : (($_GET["type"]=="3")? 'Teachersewa' : '' ) ); ?></h1>

		<form id="add_question_request_form" action="updatescript.php" method="POST">

			<input type="hidden" name="add_question_request" value="add_question_request" >

			<input type="hidden" name="type" value="<?php echo (($_GET["type"]=="2")? '2' : (($_GET["type"]=="3")? '3' : '' ) ); ?>" >
			<input type="hidden" name="loksewa_cat_id" value="<?php echo $_GET["cat"]; ?>" >

			
			<input type="text" name="question" placeholder="Type question here" style="height: 40px; width: 800px;">
			<br><br>
			<input type="text" name="answer" placeholder="Type answer here" style="height: 40px; width: 800px;">
			<br>
			<input type="submit" name="submit">
			
		</form>

		<!-- <?php if ($_GET["type"]=="2") {
			$tableView = json_decode($backstage->get_loksewa_question($cal['year']));
		} ?> -->
		
	<?php }else{ ?>

		<!-- get section list from database-->
    <script>
    function showcat(str) {
      if (str == "") {
          document.getElementById("cat").innerHTML = "";
          return;
      } else { 
          if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp = new XMLHttpRequest();

          } else {
              // code for IE6, IE5
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  //var selectDropdown =    $("#cat");
                  document.getElementById("cat").innerHTML = this.responseText;
                  //selectDropdown.trigger('contentChanged');
              }
          };
          xmlhttp.open("GET","../important/getListById.php?catbytype="+str,true);
          xmlhttp.send();
         //  $('select').on('contentChanged', function() { 
         //  // re-initialize 
         // //$(this).material_select();
         //   });

          
      }
    }
    </script>
		<a href="logout.php">Logout</a>
		<form action="admin.php" method="GET">

			<input type="hidden" name="token" value="nskqa">

			<select name="type" onchange="showcat(this.value)">
	           <option value="" disabled selected>Choose type</option>
	            <option value="2">Loksewa Q/A</option>
	            <option value="3">Teacher Sewa Q/A</option>
            </select>

            <select name="cat" id="cat">
	           <option value="" disabled selected>Choose type first</option>
            </select>

            <input type="submit">
			
		</form>

	<?php } ?>
</body>
</html>
<script type="text/javascript" src="../assets/js/jquery-2.1.4.min.js"> </script>
<script type="text/javascript">
	// this is the id of the form
	$("#add_question_request_form").submit(function(e) {

		e.preventDefault(); // avoid to execute the actual submit of the form.

	    var form = $(this);
	    var url = form.attr('action');

	    $.ajax({
	           type: "POST",
	           url: url,
	           data: form.serialize(), // serializes the form's elements.
	           success: function(data)
	           {
	               alert(data); // show response from the php script.
	               window.location.href = window.location.href;
	           },
	           error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            	},
	         });

	    

	    
	});
</script>

