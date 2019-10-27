<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
    $group_id = $json["GroupID"];
    $user_id = $json["UserID"];

	$query = $conn->prepare("DELETE FROM `Member Of` WHERE GroupID = :group_id AND UserID = :user_id");
    
	$query->execute(array(
		"group_id" => $group_id,
		"user_id" => $user_id
	));

    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
?>