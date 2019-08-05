<?php
	include('../config/config.php');

	 if (isset($_GET["catbytype"])){
			$type_id = $_GET['catbytype'];

		 	$sqlsection = "SELECT * FROM `loksewa_cat` WHERE `type`='$type_id' AND `status` = 1 ";
		    $result = $db->query($sqlsection);
		    echo "<option value='' >Select category</option>";
		    while($row1 = $result->fetch_assoc()) {


		  echo "<option value='".$row1['id']."'>".$row1['name']."</option>";
		 }
		 exit;
	}

?>
