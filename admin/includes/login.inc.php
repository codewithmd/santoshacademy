<?php
session_start();

if (isset($_POST['submit'])) {

  include 'dbh.inc.php';

	$email = $_POST['email'];
	$pwd = $_POST['password'];

	//Error handlers
	//Check if inputs are empty
	if (empty($email) || empty($pwd)) {
		header("Location: ../login.php?login=empty");
		exit();
	} else {
		$sql = "SELECT * FROM `admin` WHERE `admin_email`=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    
    

		if ($stmt->rowCount() < 1) {
			header("Location: ../login.php?login=error");
			exit();
		} else {
			if ($user = $stmt->fetch()) {
				//Check Password
				$correctPassword = $pwd === $user['admin_password'] ? true : false;
				if ($correctPassword == false) {
					header("Location: ../login.php?login=password not matched");
					exit();
				} elseif ($correctPassword == true) {
					//Log in the user here
					$_SESSION['a_id'] = $user['admin_id'];
					$_SESSION['a_email'] = $user['admin_email'];

					header("Location: ../index.php?login=success");
					exit();
				}
			}
		}
	}
} else {
	header("Location: ../login.php?login=error");
	exit();
}
