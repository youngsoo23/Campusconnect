<?php
  $conn = new PDO('mysql:dbname=CampusConnect;host=localhost;charset=utf8', 'root', 'c4m9p1s0');

  $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
