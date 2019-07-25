<?php

// logout admin
if (isset($_GET['logout'])) {
	// unset($_SESSION['admin']);
	echo 'hi';
	header('location: ../login.php');
//    exit;
} else {

}

?>
