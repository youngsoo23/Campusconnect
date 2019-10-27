<?php 
require_once('connect.php');
      //$fetch = mysqli_query($link, "SELECT * FROM Users");
      $query = $conn->prepare("SELECT * FROM `Posts (General)` INNER JOIN `Users` WHERE authorID = ID ORDER BY `generalPostID` DESC");
      $query->execute();
      $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($fetch);
?>