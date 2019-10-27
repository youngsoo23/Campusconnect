<?php 
require_once('connect.php');
	 
	$json = json_decode(file_get_contents('php://input'), true);
		
	$id = $json["ID"];

	$query = $conn->prepare("SELECT `ReceiverID`, `SenderID`, `Body`, MAX(`Date`) AS MostRecentMessage, `MessageRead`
                                FROM `Messages`
                                WHERE `SenderID` = :id
                                GROUP BY `ReceiverID`, `SenderID`, `Body`,`MessageRead`
                                UNION
                                SELECT `ReceiverID`, `SenderID`, `Body`, MAX(`Date`) AS MostRecentMessage, `MessageRead`
                                FROM `Messages`
                                WHERE `ReceiverID` = :id2
                                GROUP BY `ReceiverID`, `SenderID`, `Body`,`MessageRead`");

	$pass = $query->execute(array(
        "id" => $id,
        "id2" => $id
    ));
    $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
    
    $maxSentDate = "2010-01-21 00:00:00";
    $maxReceivedDate = "2010-01-21 00:00:00";

    $mostRecentReceived = [];
    $mostRecentSent= [];
    $mostRecentReceivedIDs = [];
    $mostRecentSentIDs= [];
    $data = [];
    foreach ($fetch as $message){
        if ($message["ReceiverID"] == $id){
            if(!in_array($message["SenderID"], $mostRecentReceivedIDs)) {
                array_push($mostRecentReceived, $message);
                array_push($mostRecentReceivedIDs, $message["SenderID"]);
            } else {
                $tmp = array_pop($mostRecentReceived);
                if($message["MostRecentMessage"] > $tmp["MostRecentMessage"]) {
                    array_push($mostRecentReceived, $message);
                } else {
                    array_push($mostRecentReceived, $tmp);
                }
            }
        }
        if ($message["SenderID"] == $id){
            if(!in_array($message["ReceiverID"], $mostRecentSentIDs)) {
                array_push($mostRecentSent, $message);
                array_push($mostRecentSentIDs, $message["ReceiverID"]);
            } else {
                $tmp = array_pop($mostRecentSent);
                if($message["MostRecentMessage"] > $tmp["MostRecentMessage"]) {
                    array_push($mostRecentSent, $message);
                } else {
                    array_push($mostRecentSent, $tmp);
                }
            }
        }
    }

    $foundIDs = [];
    foreach($mostRecentSent as $sent){
        if(!in_array($sent["ReceiverID"], $foundIDs)) {
            array_push($data, $sent);
            array_push($foundIDs, $sent["ReceiverID"]);
        } else {
            $tmp = array_pop($data);
            if($sent["MostRecentMessage"] > $tmp["MostRecentMessage"]) {
                array_push($data, $sent);
            } else {
                array_push($data, $tmp);
            }
        }
    }

    
    foreach($mostRecentReceived as $received){
        if(!in_array($received["SenderID"], $foundIDs)) {
            array_push($data, $received);
            array_push($foundIDs, $received["SenderID"]);
        } else {
            $tmp = array_pop($data);
            if($received["MostRecentMessage"] > $tmp["MostRecentMessage"]) {
                array_push($data, $received);
            } else {
                array_push($data, $tmp);
            }
        }
    }

    $data = array_reverse($data);
    echo json_encode($data);
	 
    
?>