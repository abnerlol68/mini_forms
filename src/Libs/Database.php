<?php
  $host = "127.0.0.1";
  $database = "miniforms";
  $user = "abner";
  $password = "myu53r4bn3rdb";

  try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
  } catch (PDOException $e) {
    die("PDO Connection Error: " . $e->getMessage());
  }
?>