<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
	$userid = $json["UserID"];
	$otherid = $json["OtherID"];

	$query = $conn->prepare("INSERT INTO `Friends With` (Friend1, Friend2) 
			values(:userid, :otherid)");
	$pass = $query->execute(array(
		"userid" => $userid,
		"otherid" => $otherid
	));
	 
	echo ($pass? "Record was added successfully" : "Falied to add record");
?>