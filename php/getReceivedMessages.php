<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
    $id = $json["ID"];

    $query = $conn->prepare("SELECT u.`ID`, u.`FirstName`, u.`LastName`, u.`Pic`, m.`Body`, m.`Date`
                             FROM `Messages` AS m
                             INNER JOIN `Users` AS u ON u.ID = m.SenderID 
                             WHERE m.`ReceiverID`= :id AND m.`MessageRead` = 0 
                             ORDER BY m.`Date` DESC"
    );
    $pass = $query->execute(array(
        "id" => $id
    ));

    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($fetch);
?>