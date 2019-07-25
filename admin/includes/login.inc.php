<?php
session_start();
include 'config.php';
// print_r($_POST);

if (isset($_POST['admin-login'])) {
	// echo 'coming from login form';
	if (isset($_POST['email']) && isset($_POST['email']) && ($_POST['email'] != '') && ($_POST['password'] != '')) {
		// echo 'email and password is ok or not null';
		$email = $_POST['email'];
		$password = $_POST['password'];
		echo $email . '<br>' . $password;

		$sql = "SELECT * FROM admin WHERE admin_email = ? AND admin_password = ?";
		$query = $con->prepare($sql);
		$query->execute([$email, $password]);
		echo '<br>' . $query->rowCount();
		if ($query->rowCount() != 0 || $query->rowCount() > 0) {
			// echo "</br>Admin founded. <strong style='color:green'> OK. ✔";
			$_SESSION['admin'] = $email;
			header('location: ../index.php');
		} else {
			// echo"</br>Admin not founded with this email and password <strong style='color:red'> unable to login. ";
			// *e means 'error' and *eapne = email and password not match
			header('location: ../login.php?e=eapnm');
		}

	} else {
		// echo 'email and password is null';
		// *e means 'error' and *eopn = 'email or password null'
		header('location: ../login.php?e=eopn');
	}
} else {
	// echo 'not coming from login form';
	// *e means 'error' and *iv = 'illegal visit'
	header('location: ../login.php?e=iv');
}

?>
