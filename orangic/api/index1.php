<?php
require_once 'Functions.php';
$fun = new Functions();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  $data = json_decode(file_get_contents("php://input"));
  if(isset($data -> operation)) {
  	$operation = $data -> operation;
  	if(!empty($operation)) {

  		if($operation == 'addition') {

  			if ($data -> type == 'category') {

	          if(isset($data -> data -> name)){

	            $value = $data -> data;
	            $name = $value -> name;

	            echo $fun -> addCategory($name);

	          }else {
	            echo $fun -> getMsgInvalidParam();
	          }

  			}else if ($data -> type == 'subcategory'){

	          if(isset($data -> data -> cat_id) && isset($data -> data -> name)){

	            $value = $data -> data;
	            $cat_id = $value -> cat_id;
	            $name = $value -> name;

	            echo $fun -> addSubCategory($cat_id , $name);

	          }else {
	            echo $fun -> getMsgInvalidParam();
	          }

  			}else if ($data -> type == 'multiplechoice'){






  			}else{
  				echo $fun -> getMsgInvalidParam();
  			}

	} else if ($operation == 'details') {

        if ($data -> type == 'category') {

            echo $fun -> getCategory();

        } else if ($data -> type == 'subcategory'){

        	if(isset($data -> data -> cat_id)){

	            $value = $data -> data;
	            $cat_id = $value -> cat_id;

	            echo $fun -> getSubCategory($cat_id);

	        }else {
	            echo $fun -> getMsgInvalidParam();
	        }

        }
      

  	} else if ($operation == 'modify') {

        if ($data -> type == 'category') {

            if(isset($data -> data -> id) && isset($data -> data -> name)){

	            $value = $data -> data;
	            $id = $value -> id;
	            $name = $value -> name;

	            echo $fun -> updateCategory($id , $name);

	        }else {
	            echo $fun -> getMsgInvalidParam();
	        }

        } else if ($data -> type == 'subcategory'){

        	if(isset($data -> data -> id) && isset($data -> data -> name)){

	            $value = $data -> data;
	            $id = $value -> id;
	            $name = $value -> name;

	            echo $fun -> updateSubCategory($id , $name);

	        }else {
	            echo $fun -> getMsgInvalidParam();
	        }

        }
      

  	} else if ($operation == 'delete') {

        if ($data -> type == 'category') {

            if(isset($data -> data -> id)){

	            $value = $data -> data;
	            $id = $value -> id;

	            echo $fun -> deleteCategory($id);

	        }else {
	            echo $fun -> getMsgInvalidParam();
	        }

        } else if ($data -> type == 'subcategory'){

        	if(isset($data -> data -> id)){

	            $value = $data -> data;
	            $id = $value -> id;

	            echo $fun -> deleteSubCategory($id);

	        }else {
	            echo $fun -> getMsgInvalidParam();
	        }

        }
      

  	} else if($operation == 'getschooldetails') {
        if(isset($data -> schooldetails ) && !empty($data -> schooldetails)) {
          $schooldetails = $data -> schooldetails;
          echo $fun -> getschooldetails($schooldetails);
        } else {
          echo $fun -> getMsgInvalidParam();
        }

  }  else if($operation == 'isAttendanceDone') {

        if(isset($data -> attendanceCheck ) && !empty($data -> attendanceCheck) && isset($data -> attendanceCheck -> abclass) && isset($data -> attendanceCheck -> absec)){

          $attendanceCheck = $data -> attendanceCheck;
          $standard = $attendanceCheck -> abclass;
          $section = $attendanceCheck -> absec;

          echo $fun -> AttendanceCheck($standard,$section);

        } else {

          echo $fun -> getMsgInvalidParam();

        }

	}else if($operation == 'fetchsection') {

        if(isset($data -> teacher ) && !empty($data -> teacher)) {

          $teacher = $data -> teacher;
          $class = $teacher -> standard;

          echo $fun -> fetchsectionbyclass($class);

        } else {

          echo $fun -> getMsgInvalidParam();

        }

  	}else{
  		echo $fun -> getMsgInvalidOperation();
  	}
  	}else{

  		echo $fun -> getMsgParamNotEmpty();
  	}

  } else {
  		echo $fun -> getMsgParamNotEmpty();
  }

} else if ($_SERVER['REQUEST_METHOD'] == 'GET'){

  echo "Welcome to hackster world!!!";

}

?>
