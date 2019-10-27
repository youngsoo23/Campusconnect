<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
    $id = $json["ID"];
    $name = $json["Name"];
    $description = $json["Description"];

	$query = $conn->prepare("UPDATE `Groups` SET `Name`= :name,`Description`= :description WHERE `ID` = :id");
	$pass = $query->execute(array(
        "id" => $id,
        "name" => $name,
        "description" => $description
    ));
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
	 
    echo ($pass ? "Group updated successfully." : "Failed to update group.");
?>