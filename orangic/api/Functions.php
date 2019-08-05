<?php

require_once 'DBOperations.php';

class Functions{

  private $db;

  public function __construct() {

        $this -> db = new DBOperations();

  }

  public function getSlcNotes(){
  $db = $this -> db;

       $result =  $db -> getSlcNotes();
       if(!$result) {
        $response["status"] = 201;
        $response["message"] = "Something went wrong";
        return json_encode($response);
       } else {
        $response["status"] = 200;
        $response["message"] = "SEE / SLC Notes fetched";
        $response["data"] = $result;
        return json_encode($response);
        }
  }




  public function loginUser($email, $password) {
    $db = $this -> db;
    if (!empty($email) && !empty($password)) {

      $checkUser = $db -> checkUserExist($email);

      if ($checkUser < 1) {

        $response["status"] = 202;
        $response["message"] = "Your login name or password is invalid";
        return json_encode($response);

      }else if ($checkUser > 1) {

        $response["status"] = 202;
        $response["message"] = "Multiple user found with same email,Please contact your school.";
        return json_encode($response);
        
      }else {

         $result =  $db -> checkUserLogin($email, $password);

         return $result;

      } 
    } else {
        return $this -> getMsgParamNotEmpty();
      }
  }

  public function userDetails($role, $id) {
    $db = $this -> db;
    if (!empty($role) && !empty($id)) {

      if ($role=='admin' || $role=='student' || $role=='parent' || $role=='teacher' || $role=='manager') {

        $userExist = $db -> checkSpecificUserExist($role,$id);

        if ($userExist) {

          if ($role=='admin') {
        
            $data = $db -> adminDetails($id);

          }else if ($role=='student') {
            
            $data = $db -> studentDetails($id);

          }else if ($role=='parent') {

            $data = $db -> parentDetails($id);
            
          }else if ($role=='teacher') {

            $data = $db -> teacherDetails($id);
            
          }else if ($role=='manager') {

            $data = $db -> managerDetails($id);
            
          }

          $response["status"] = 200;
          $response["message"] = "success";
          $response["data"] = $data;
          return json_encode($response);

        }else{
          $response["status"] = 202;
          $response["message"] = "User not exist";
          return json_encode($response);
        }


      }else{
        return $this -> getMsgInvalidParam();
      }

    } else {
        return $this -> getMsgParamNotEmpty();
    }
  }



  public function getschooldetails($schooldetails){
    $db = $this -> db;
    if (!empty($schooldetails)) {
         $result =  $db -> getschooldetails($schooldetails);
         if(!$result) {
          $response["result"] = "failure";
          $response["message"] = "Something went wrong";
          return json_encode($response);
         } else {
          $response["result"] = "success";
          $response["message"] = $result;
          return json_encode($response);
          }
    } else {
        return $this -> getMsgParamNotEmpty();
      }
  }


  public function getCategory(){
    $db = $this -> db;
    $result =  $db -> fetchCategory();
    if(!$result) {
      $response["status"] = "205";
      $response["message"] = "Something went wrong";
      return json_encode($response);
    } else {
      $response["status"] = "200";
      $response["message"] = "Success";
      $response["data"] = $result;
      return json_encode($response);
    }
  }

  public function getSubCategory($cat_id){

    if (!empty($name)) {
      $db = $this -> db;
      $result =  $db -> fetchSubCategory();
      if(!$result) {
        $response["status"] = "205";
        $response["message"] = "Something went wrong";
        return json_encode($response);
      } else {
        $response["status"] = "200";
        $response["message"] = "Success";
        $response["data"] = $result;
        return json_encode($response);
      }
    }else{
      return $this -> getMsgParamNotEmpty();
    }
  }

  public function addCategory($name){

    if (!empty($name)) {
      $db = $this -> db;

      $result =  $db -> addCategory($name);
      if(!$result) {
        $response["status"] = "205";
        $response["message"] = "Something went wrong";
        return json_encode($response);
      } else {
        $response["status"] = "200";
        $response["message"] = "Success";
        return json_encode($response);
      }
    }else{
      return $this -> getMsgParamNotEmpty();
    }
  }

  public function addSubCategory($cat_id , $name){

    if (!empty($cat_id) && !empty($name)) {
      $db = $this -> db;

      $result =  $db -> addSubCategory($cat_id , $name);
      if(!$result) {
        $response["status"] = "205";
        $response["message"] = "Something went wrong";
        return json_encode($response);
      } else {
        $response["status"] = "200";
        $response["message"] = "Success";
        return json_encode($response);
      }
    }else{
      return $this -> getMsgParamNotEmpty();
    }
  }

  public function updateCategory($id , $name){

    if (!empty($id) && !empty($name)) {
      $db = $this -> db;

      $result =  $db -> updateCategory($id , $name);
      if(!$result) {
        $response["status"] = "205";
        $response["message"] = "Something went wrong";
        return json_encode($response);
      } else {
        $response["status"] = "200";
        $response["message"] = "Success";
        return json_encode($response);
      }
    }else{
      return $this -> getMsgParamNotEmpty();
    }
  }

  public function deleteCategory($id){

    if (!empty($id)) {
      $db = $this -> db;

      $result =  $db -> deleteCategory($id);
      if(!$result) {
        $response["status"] = "205";
        $response["message"] = "Something went wrong";
        return json_encode($response);
      } else {
        $response["status"] = "200";
        $response["message"] = "Success";
        return json_encode($response);
      }
    }else{
      return $this -> getMsgParamNotEmpty();
    }
  }

  public function deleteSubCategory($id){

    if (!empty($id)) {
      $db = $this -> db;

      $result =  $db -> deleteSubCategory($id);
      if(!$result) {
        $response["status"] = "205";
        $response["message"] = "Something went wrong";
        return json_encode($response);
      } else {
        $response["status"] = "200";
        $response["message"] = "Success";
        return json_encode($response);
      }
    }else{
      return $this -> getMsgParamNotEmpty();
    }
  }

  public function getMsgInvalidEmail(){
    $response["status"] = "203";
    $response["message"] = "Invalid Email";
    return json_encode($response);
  }

  public function getMsgInvalidOperation(){
    $response["status"] = "204";
    $response["message"] = "Invalid Operation";
    return json_encode($response);
  }

  public function getMsgInvalidParam(){
    $response["status"] = "203";
    $response["message"] = "Invalid Parameters";
    return json_encode($response);
  }

  public function getMsgParamNotEmpty(){
    $response["status"] = "203";
    $response["message"] = "Parameters should not be empty!!";
    return json_encode($response);
  }

  public function getMsgInvalidToken(){
    $response["status"] = "205";
    $response["message"] = "Invalid token!!";
    return json_encode($response);
  }

  public function getMsgInvalidRequest(){
    $response["status"] = "205";
    $response["message"] = "Invalid request!!";
    return json_encode($response);
  }

  

}

?>

