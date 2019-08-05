<?php

class DBOperations{

    private $conn;

    public function __construct() {

        require('../config/config.php');

        $this -> conn = new PDO("mysql:host=$db_server;dbname=$db_database", $db_username, $db_password);
    }



    public function getSlcNotes() {

        // header('Content-Type: text/html; charset = utf-8');
        // $query1 = $this -> conn -> prepare("SET NAMES utf8");
        // $query1 -> execute();

        $response = array();
        $sql = 'SELECT `notes`.* , `users`.`name` AS `uploaded_by`
        FROM `notes` 
        LEFT JOIN `users` ON `notes`.`users_id` = `users`.`id`
        WHERE `notes`.`notes_category_id` = :id AND `notes`.`status` = 1';
        $query = $this -> conn -> prepare($sql);
        $query -> execute(array(':id' => 1));

        $data = $query -> fetchAll();

        foreach($data as $row) {

            array_push($response,array(

                "title" => $row['title'],
                "details" => $row['details'],
                "url" => $row['url'],
                "file_type" => $row['file_type'],
                "uploaded_by" => $row['uploaded_by'],
                "uploaded_date" => date('Y-m-d', strtotime($row['uploaded_date'])),

            ));
        }
        return $response;
    }



    public function getschooldetails($schooldetails) {
        Global $schoolFolderName;
        $sql = 'SELECT * FROM `schooldetails`';
        $query = $this -> conn -> prepare($sql);
        $query -> execute();
        $data = $query -> fetchObject();

            $school["school_code"] = $data -> school_code;
            $school["school_name"] = $data -> school_name;
            $school["school_address"] = $data -> school_address;
            $school["logo"] = ((!empty($data -> slogo))? "https://a1pathshala.com/manager/uploads/".$schoolFolderName."/logo/".$data -> slogo : "");
            $principal["estd"] = $data -> estd;
            $school["phone_no"] = $data -> phone_no;
            $school["phone_no2"] = $data -> phone_2;
            $school["email_id"] = $data -> email_id;
            $school["facebook"] = $data -> facebook;
            $school["twitter"] = $data -> twitter;
            $school["instagram"] = $data -> instagram;
            $school["youtube"] = $data -> youtube;

        return $school;    
    }
    
   

    
    
}

?>
