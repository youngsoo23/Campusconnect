<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
	
    $subject = $json["Subject"];

    $date = date("Y-m-d", strtotime($date));

	if(empty($subject)) {
        $query = $conn->prepare("SELECT * FROM `Posts (General)` ORDER BY `Date` DESC");
        $query->execute();
    } else {
        $query = $conn->prepare("SELECT * FROM `Posts (Subject)` ORDER BY `Date` DESC");
        $query->execute();
    }
    $query = $conn->prepare("SELECT * FROM `Posts (General)` ORDER BY `Date` DESC");
    $query->execute();
	 
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($fetch);
?>