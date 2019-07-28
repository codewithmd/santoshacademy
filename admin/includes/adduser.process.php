<?php

if(isset($_POST['email']) && isset($_POST['name'])){
  include 'dbh.inc.php';

	$name = $_POST['name'];
	$email = $_POST['email'];
  $password = $_POST['password'];
  
  $sql = "INSERT INTO `users` (`user_name`, `user_email`, `user_password`) VALUES (?,?,?)";
  $stmt = $pdo->prepare($sql);
  
  if($stmt->execute([$name, $email, $password]) === false){
    echo " x Something Goes Wrong!";
  } else {
    echo " ✓ User Added Successfully";
  }
}