<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
    $sending = $json["authorID"];
    $body = $json["Body"];

    date_default_timezone_set('America/Los_Angeles');
    $date = date('m/d/Y h:i:s a', time());
    $date = date("Y-m-d h:i:s");

    $query = $conn->prepare("INSERT INTO `Posts (General)`(`authorID`, `Date`, `Body`) 
            VALUES(:sending, :date, :body)");
    $pass = $query->execute(array(
        "sending" => $sending,
        "body" => $body,
        "date" => $date
    ));

    //$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    //echo "Message sent to " , $fetch[0][FirstName] , " " , $fetch[0][LastName];
?>