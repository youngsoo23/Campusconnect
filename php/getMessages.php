<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
    $id = $json["ID"];
    $id2 = $json["ID"];

    $query = $conn->prepare("SELECT * FROM `Messages` AS m1
        WHERE (m1.SenderID = :id AND NOT EXISTS (SELECT * FROM `Messages` AS m2 WHERE m1.SenderID = m2.SenderID AND m1.ReceiverID = m2.ReceiverID AND m1.Date < m2.Date))
        OR (m1.ReceiverID = :id2 AND NOT EXISTS (SELECT * FROM `Messages` AS m2 WHERE m1.ReceiverID = m2.ReceiverID AND m1.SenderID = m2.SenderID AND m1.Date < m2.Date))
        ORDER BY Date DESC");

    $pass = $query->execute(array(
        "id" => $id,
        "id2" => $id2
    ));

    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($fetch);
?>