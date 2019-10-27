<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
	$user_id = $json["uID"];
	$other_id = $json["oID"];		
	$user_id1 = $json["uID"];
	$other_id1 = $json["oID"];		
	$user_id2 = $json["uID"];
	$other_id2 = $json["oID"];

	$query = $conn->prepare("SELECT m.*, u1.FirstName as SFirstName, u1.LastName as SLastName, u1.Pic as SPic, u2.FirstName as RFirstName, u2.LastName as RLastName, u2.Pic as RPic
							FROM `Messages` AS m
							INNER JOIN `Users` AS u1 ON (u1.ID = :user_id)
							INNER JOIN `Users` AS u2 ON (u2.ID = :other_id)  
							WHERE (m.`ReceiverID` = :user_id1 AND m.`SenderID` = :other_id1)
							OR (m.`SenderID` = :user_id2 AND m.`ReceiverID` = :other_id2)
							ORDER BY m.`Date` DESC");

	$pass = $query->execute(array(
		"user_id" => $user_id,
		"other_id" => $other_id,
		"user_id1" => $user_id1,
		"other_id1" => $other_id1,
		"user_id2" => $user_id2,
		"other_id2" => $other_id2
    ));
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
	 
    echo json_encode($fetch);
?>