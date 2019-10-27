<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
	$id = $json["ID"];	
	$id2 = $json["ID"];

	/*$query = $conn->prepare("SELECT * FROM Groups WHERE ID IN (
                                SELECT GroupID FROM `Member Of`
                                WHERE UserID = :id
                            )");*/
    $query = $conn->prepare("SELECT * FROM Groups WHERE ID IN (SELECT GroupID FROM `Member Of` WHERE UserID = :id) OR ID IN (SELECT ID FROM `Groups` WHERE CreatedByID = :id2)");
	$query->execute(array(
		"id" => $id,
		"id2" => $id2
	));
	 
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($fetch);
?>