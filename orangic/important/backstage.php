<?php
class back_stage_class
{

	function get_loksewa_cat_by_type($type)
			{
				require("../config/config.php");
				$response = array();
				$result = mysqli_query($db, "SELECT `id`,`name` 
					FROM `loksewa_cat` 
					WHERE `type` = '$type' AND `status` = 1 ");

				while($row = mysqli_fetch_assoc($result))
				{
					array_push($response,array(
						"id" => $row['id'],
						"name" => $row['name'],						
					));
				}
				mysqli_close($db);
				return json_encode($response);
			
			}


}
?>
