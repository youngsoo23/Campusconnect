<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
	$groupid = $json["GroupID"];
	$userid = $json["UserID"];

	$query = $conn->prepare("INSERT INTO `Member Of`(GroupID, UserID) 
			values(:groupid, :userid)");
	$pass = $query->execute(array(
		"userid" => $userid,
		"groupid" => $groupid
	));
	 
	echo ($pass? "Record was added successfully" : "Falied to add record");
?>
