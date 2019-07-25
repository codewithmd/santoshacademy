<?php
session_start();
include 'config.php';

$response = array();
if (isset($_POST['request']) && ($_POST['request'] == 'addQuestionAnswer')) {
	$response['msg'] = $_POST;
	if (($_POST['question'] != '') && ($_POST['answer'] != '') && ($_POST['testNumber'] != '')) {
		$question = $_POST['question'];
		$options = $_POST['options'];
		$answer = $_POST['answer'];
		$testNumber = $_POST['testNumber'];

		$sql = "INSERT INTO `question`(`question`, `options`, `answer`, `test_number`) VALUES (?, ?, ?, ?)";
		$query = $con->prepare($sql);
		$query->execute([$question, json_encode($options), $answer, $testNumber]);

		if ($query) {
			$response['msg'] = 'qas'; // question add successful
		} else {
			$response['msg'] = 'qau'; // question add uuccessful
		}

	} else {
		$response['msg'] = 'pwfaf'; // *pwfaf means 'please fill all the fields'
	}

} elseif (isset($_POST['request']) && ($_POST['request'] == 'getQuestions')) {
	$testNumber = $_POST['testNumber'];
	$sql = "SELECT * FROM `question` WHERE test_number = ?";
	$query = $con->prepare($sql);
	$query->execute([$testNumber]);
	$questions = $query->fetchAll(PDO::FETCH_OBJ);

	$response['data'] = $questions;

} elseif (isset($_POST['request']) && ($_POST['request'] == 'viewQuestionAnswer')) {

	$questionId = $_POST['question'];
	$sql = "SELECT * FROM `question` WHERE id = ?";
	$query = $con->prepare($sql);
	$query->execute([$questionId]);
	$questions = $query->fetchAll(PDO::FETCH_OBJ);

	$response['data'] = $questions;
} elseif (isset($_POST['request']) && ($_POST['request'] == 'deleteQuestionAnswer')) {
	$questionId = $_POST['question'];
	$sql = "DELETE FROM `question` WHERE id = ?";
	$query = $con->prepare($sql);
	$query->execute([$questionId]);
	if ($query) {
		$response['msg'] = "qds"; // *qds means 'question delete successful'
	} else {
		$response['msg'] = "qdu"; // *qdu means 'question delete unsuccessful'
	}

} elseif (isset($_POST['request']) && ($_POST['request'] == 'updateQuestionAnswer')) {
	$question = $_POST['question'];
	$options = $_POST['options'];
	$answer = $_POST['answer'];
	$questionId = $_POST['questionId'];

	$sql = "UPDATE `question` SET `question`=?,`options`=?,`answer`=? WHERE `id`= ?";
	$query = $con->prepare($sql);
	$query->execute([$question, json_encode($options), $answer, $questionId]);
	if ($query) {
		$response['msg'] = 'qus'; // *qus means 'question add successful'
	} else {
		$response['msg'] = 'quu'; // *qus means 'question add unsuccessful'
	}

} else {

}

echo json_encode($response);

?>
