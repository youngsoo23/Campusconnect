<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
    $id = $json["ID"];
    $fname = $json["FirstName"];
    $lname = $json["LastName"];
    $major = $json["Major"];
    $year = $json["AcademicYear"];

	$query = $conn->prepare("UPDATE `Users` SET `FirstName` = :fname, `LastName` = :lname, `Major` = :major, `AcademicYear` = :year WHERE `ID` = :id");
	$pass = $query->execute(array(
        "id" => $id,
        "fname" => $fname,
        "lname" => $lname,
        "major" => $major,
        "year" => $year
    ));
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
	 
    echo ($pass ? "Profile edited successfully" : "Failed to update profile");
?>