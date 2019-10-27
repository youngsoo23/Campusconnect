<?php 
require_once('connect.php');
	$json = json_decode(file_get_contents('php://input'), true);
	$id = $json["GroupID"];
	/*$query = $conn->prepare("SELECT * FROM Users WHERE ID IN (SELECT UserID FROM `Member Of` WHERE GroupID = :id)");*/

	$query = $conn->prepare("SELECT * FROM Users WHERE ID IN (SELECT UserID FROM `Member Of` WHERE GroupID = :id) OR ID IN (SELECT CreatedByID FROM `Groups` WHERE ID = :id2)");

	$pass = $query->execute(array(
		"id" => $id,
		"id2" => $id
	));
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($fetch);
?>