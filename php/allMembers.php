<?php 
require_once('connect.php');
      //$fetch = mysqli_query($link, "SELECT * FROM Users");
      	$json = json_decode(file_get_contents('php://input'), true);
		$id = $json["ID"];
      	$query = $conn->prepare("SELECT u.`ID`, u.`LastName`, u.`FirstName` FROM `Users` AS u INNER JOIN `Member Of` as mo ON u.ID = mo.userID WHERE mo.ID = :id");
      	$query->execute();
      	$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
      	echo json_encode($fetch);
?>
