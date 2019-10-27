<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
	$name = $json["Name"];	
	$description = $json["Description"];	
	$creator_id = $json["CreatedByID"];	

	$query = $conn->prepare("INSERT INTO Groups(CreatedByID, Description, Name) 
			values(:creator_id, :description, :name)");
	$pass = $query->execute(array(
		"creator_id" => $creator_id,
		"description" => $description,
		"name" => $name
	));

	// Get the group ID of the group just made
	/*$query = $conn->prepare("SELECT g.ID FROM `Groups` AS g
		WHERE NOT EXISTS (SELECT g2.ID FROM `Groups` AS g2 WHERE g2.ID > g.ID");
	$groupid = $query->execute();*/
	
	// Make creator a member of group
	/*$query = $conn->prepare("INSERT INTO `Member Of`(UserID, GroupID) 
			values(:creator_id, :groupid");
	$pass = $query->execute(array(
		"creator_id" => $creator_id,
		"groupid" => $groupid
	));*/

	echo ($pass? "Record was added successfully" : "Falied to add record");
?>
