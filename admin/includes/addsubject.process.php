<?php

if(isset($_POST['subject'])){
  include 'dbh.inc.php';

	$subject = $_POST['subject'];
	
  
  $sql = "INSERT INTO `subject`(`sub_name`) VALUES (?)";
  $stmt = $pdo->prepare($sql);
  
  if($stmt->execute([$subject]) === false){
    echo "x Something Goes Wrong!";
  } else {
    echo "✓ Subject Added Successfully";
  }
}