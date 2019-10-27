<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
    $author = $json["ID"];
    $date = $json["Date"];
    $body = $json["Body"];
    $subject = $json["Subject"];

    $date = date("Y-m-d", strtotime($date));

    if(empty($subject)) {
        $query = $conn->prepare("INSERT INTO `Posts (General)`(`authorID`, `Date`, `Body`) 
                VALUES(:author, :date, :body)");
        $pass = $query->execute(array(
            "author" => $author,
            "date" => $date,
            "body" => $body
        ));
    } else {
        $query = $conn->prepare("INSERT INTO `Posts (Subject)`(`authorID`, `Date`, `Body`, `Subject`) 
                VALUES(:author, :date, :body, :subject)");
        $pass = $query->execute(array(
            "author" => $author,
            "date" => $date,
            "body" => $body,
            "subject" => $subject
        ));
    }
	 
    
	echo ($pass? "Record was added successfully" : "Falied to add record");
?>