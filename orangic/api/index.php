<?php
require_once 'Functions.php';
$fun = new Functions();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  	$data = json_decode(file_get_contents("php://input"));
  	if(isset($data -> operation)) {
  		$operation = $data -> operation;
  		if(!empty($operation)) {

			if($operation == 'getDetails') {
        		if(isset($data -> type ) && !empty($data -> type) && $data -> type == "slcNotes"){
          			echo $fun -> getSlcNotes();
        		}else{
          			echo $fun -> getMsgInvalidParam();
        		} 

			}else{
				echo $fun -> getMsgInvalidParam();
			}
		}else{
    		echo $fun -> getMsgParamNotEmpty();
    	}
	}else{
		echo $fun -> getMsgInvalidOperation();
	}

}else{
	echo $fun -> getMsgInvalidRequest();
}

?>