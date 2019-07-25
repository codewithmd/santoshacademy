<?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "stacademy";
  $charset = "utf8mb4";
  
  try{    
      $dsn = "mysql:host=".$servername.";dbname=".$dbname.";charset=".$charset;
      $pdo = new PDO($dsn, $username, $password);
      // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTON);  
  } catch (PDOException $e) {
    echo "Connection Faild". $e;
  }