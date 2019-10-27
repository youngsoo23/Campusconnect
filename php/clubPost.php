<?php 
require_once('connect.php');
      $query = $conn->prepare("SELECT * FROM `ClubPost` INNER JOIN `Groups` AS g INNER JOIN `Users` AS u WHERE groupID = g.ID AND authorID = u.ID ORDER BY `Date` DESC");
      $query->execute();
      $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($fetch);
?>