<?php
  $host = "localhost";
  $database = "miniforms";
  $user = "abner";
  $password = "myu53r4bn3rdb";
  $port = "3306";
  $conn = null;
  try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
  } catch (PDOException $e) {
    die("PDO Connection Error: " . $e->getMessage());
  }

//try {
//    $conn = new mysqli(
//        $host,
//        $user,
//        $password,
//        $database,
//        $port
//    );
//} catch (Exception $ex){
//    die("Error: ".$ex->getMessage());
//}

?>