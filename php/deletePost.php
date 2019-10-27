<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
    $id = $json["ID"];
    
	$query = $conn->prepare("DELETE FROM `Posts (General)` WHERE generalPostID = :id");
	$pass = $query->execute(array(
        "id" => $id,
    ));
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
	 
    echo ($pass ? "Group updated successfully." : "Failed to update group.");
?>