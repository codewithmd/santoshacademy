<?php
session_start();
include 'config.php';

if (isset($_POST['request']) && ($_POST['request'] == 'deleteAccountPasswordCheck')) {
	$response = array();
	$email = $_POST['email'];
	$password = $_POST['password'];
//    echo $password, $email;

	$sql = "SELECT * FROM admin WHERE admin_email = ? AND admin_password = ?";
	$query = $con->prepare($sql);
	$query->execute([$email, $password]);
//    echo '<br>'.$query->rowCount();
	if ($query->rowCount() != 0 || $query->rowCount() > 0) {
		// echo "</br>Admin founded. <strong style='color:green'> OK. ✔";
		$response['response'] = 200;
	} else {
		// echo"</br>Admin not founded with this email and password <strong style='color:red'> unable to login. ";
		// *e means 'error' and *eapne = email and password not match
		$response['response'] = 400;
	}

	echo json_encode($response);

} elseif (isset($_POST['request']) && ($_POST['request'] == 'deleteAccount')) {

	$email = $_POST['email'];
	$password = $_POST['password'];
	//    echo $password, $email;

	$sql = "SELECT * FROM admin WHERE admin_email = ? AND admin_password = ?";
	$query = $con->prepare($sql);
	$query->execute([$email, $password]);
	//    echo '<br>'.$query->rowCount();
	if ($query->rowCount() != 0 || $query->rowCount() > 0) {
		echo "</br>Admin founded. <strong style='color:green'> OK. ✔";
		$sql = "DELETE FROM `admin` WHERE admin_email = ? AND admin_password = ? ";
		$query = $con->prepare($sql);
		$query->execute([$email, $password]);

		if ($query) {
			unset($_SESSION['admin']);
			header('location: /admin/index.php');
		} else {
			// *e means 'error' and *uda means 'unable to delete account'
			header('location: ../profile.php?e=uda');
		}

	} else {
		echo "</br>Admin not founded with this email and password <strong style='color:red'> unable to login. ";
		// *e means 'error' and *eapne = email and password not match

	}

} elseif (isset($_POST['request']) && ($_POST['request'] == 'addSubject')) {
	$response = array();
	if ($_POST['subject'] != '') {
		$subject = $_POST['subject'];
		$sql = "SELECT `sub_name` FROM `subject` WHERE `sub_name` = ?";
		$query = $con->prepare($sql);
		$query->execute([$subject]);
		if ($query->rowCount() == 0) {
			$admin = $_SESSION['admin'];
			$sql = "INSERT INTO `subject`(`sub_name`, `admin`) VALUES (?, ?)";
			$query = $con->prepare($sql);
			$query->execute([$subject, $admin]);
			if ($query) {
				// subject added
				$response['msg'] = "sas"; // *msg means messages and *sas means 'subject add successful'

			} else {
				$response['msg'] = 'piq'; // *piq means 'problem in query'
			}

		} else {
			// This subject already exist
			$response['msg'] = 'sae'; // *msg means messages and *sae means 'subject already exists'
		}

	} else {
		// subject field null
		$response['msg'] = 'sfn';
	}

	echo json_encode($response);
} elseif (isset($_POST['request']) && ($_POST['request'] == 'getSubjects')) {
	$response = array();
	$sql = "SELECT * FROM `subject`";
	$query = $con->prepare($sql);
	$query->execute();
	$subjects = $query->fetchAll(PDO::FETCH_OBJ);
	$response['subjects'] = $subjects;
	echo json_encode($response);

} elseif (isset($_POST['request']) && ($_POST['request'] == 'addUser')) {
	$response = array();
	$userName = $_POST['name'];
	$response['response'] = $_POST;
	if (($_POST['name'] != '') && ($_POST['email'] != "") && ($_POST['password'] != '')) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		$sql = "SELECT  `user_email` FROM `users` WHERE `user_email` = ?";
		$query = $con->prepare($sql);
		$query->execute([$email]);
		if ($query->rowCount() == 0) {
			$sql = "INSERT INTO `users`(`user_name`, `user_email`, `user_password`) VALUES (?, ?, ?)";
			$query = $con->prepare($sql);
			$query->execute([$name, $email, $password]);

			if ($query) {
				$response['msg'] = "uas"; // *uas means  'user add successful'
			} else {
				$response['msg'] = "uau"; // *uas means  'unable to add successful'
			}

		} else {
			$response['msg'] = "uaewte"; // *uawte mean 'user already exists with this email
		}

	} else {
		$response['msg'] = "pfaf"; // *pfaf means 'please fillup all the fields '
	}
	// $sql="SELECT * FROM `subject`";
	// $query=$con->prepare($sql);
	// $query->execute();
	// $subjects=$query->fetchAll(PDO::FETCH_OBJ);
	// $response['subjects'] = $subjects;
	echo json_encode($response);

} elseif (isset($_POST['request']) && ($_POST['request'] == 'addNewTest')) {

	$response = array();

	if (($_POST['subject'] != '') && ($_POST['testName'] != '')) {

		$subject = $_POST['subject'];
		$testName = $_POST['testName'];
		$date = date("d/m/Y");
		$sql = "INSERT INTO `tests`(`test_name`, `subject`, `test_date`) VALUES (?, ?, ?)";
		$query = $con->prepare($sql);
		$query->execute([$testName, $subject, $date]);
		if ($query) {
			$testNo = $con->lastInsertId();

			$response['msg'] = "ntas"; // *ntas means 'new test add successful'
			$response['testId'] = $testNo;
		} else {
			$response['msg'] = "ntau"; // *ntau means 'new test add unsuccessful'
		}

	} else {
		$response['msg'] = "pfsn"; // *pfsn means 'please fill test name'
	}

	echo json_encode($response);

} else {
	// echo 'no requests from server';
}

?>
