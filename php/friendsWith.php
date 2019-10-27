<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
	$id = $json["ID"];	

	$query = $conn->prepare("SELECT * FROM Users WHERE ID IN (
                                SELECT Friend2 FROM `Friends With`
                                WHERE Friend1 = :id
                            )");
	$query->execute(array(
		"id" => $id
	));
	 
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($fetch);
?>