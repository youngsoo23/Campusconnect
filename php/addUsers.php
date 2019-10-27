<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
	$id = $json["ID"];
	$email = $json["Email"];	
	$fname = $json["FirstName"];	
	$lname = $json["LastName"];	
	$depart = $json["Major"];	
	$year = $json["AcademicYear"];	

	$query = $conn->prepare("INSERT INTO Users(ID, Email, FirstName, LastName, Major, AcademicYear) 
			values(:id, :email, :fname, :lname, :depart, :year)");
	$pass = $query->execute(array(
		"id" => $id,
		"email" => $email,
		"fname" => $fname,
		"lname" => $lname,
		"depart" => $depart,
		"year" => $year
	));
	 
	echo ($pass? "Record was added successfully" : "Falied to add record");
?>
