<?php
  session_start();
  require_once('sql_functions.php');
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uuid = $_SESSION['uuid'];
	$task_order = $_SESSION['task_iterator'];
	error_log("submitting responses");
	#incrementing here so it saves order starting at 1
	$task_order = $task_order + 1;
	
	$test_id = filter_var($_POST['test_id'],FILTER_VALIDATE_INT);
	$method_choices = $_SESSION['method_choices'];
	$method_count = count($method_choices);
	$max = filter_var($_POST['maxPoints_' . $task_order],FILTER_VALIDATE_INT);
	error_log("Test ID: " . $test_id);
	error_log("Method Count: " . $method_count);
	error_log("Task Order; " . $task_order);
	if($method_count > 0) {
		$method_order1 = filter_var($_POST['method_order_' . $task_order . '_1'],FILTER_VALIDATE_INT);
		$method_id1 = filter_var($_POST['method_id_' . $task_order . '_1'],FILTER_VALIDATE_INT);
		$response1 = filter_var($_POST['choice_' . $task_order . '_1'],FILTER_VALIDATE_INT);
		error_log($method_order1);
		error_log($method_id1);
		error_log($response1);
		insertTaskResponse($uuid, $task_order, $test_id, $method_order1, $method_id1, $response1, $max);
	}
	if($method_count > 1) {
		$method_order2 = filter_var($_POST['method_order_' . $task_order . '_2'],FILTER_VALIDATE_INT);
		$method_id2 = filter_var($_POST['method_id_' . $task_order . '_2'],FILTER_VALIDATE_INT);
		$response2 = filter_var($_POST['choice_' . $task_order . '_2'],FILTER_VALIDATE_INT);
		insertTaskResponse($uuid, $task_order, $test_id, $method_order2, $method_id2, $response2, $max);
	}
	if($method_count > 2) {
		$method_order3 = filter_var($_POST['method_order_' . $task_order . '_3'],FILTER_VALIDATE_INT);
		$method_id3 = filter_var($_POST['method_id_' . $task_order . '_3'],FILTER_VALIDATE_INT);
		$response3 = filter_var($_POST['choice_' . $task_order . '_3'],FILTER_VALIDATE_INT);
		insertTaskResponse($uuid, $task_order, $test_id, $method_order3, $method_id3, $response3, $max);
	}
	if($method_count > 3) {
		$method_order4 = filter_var($_POST['method_order_' . $task_order . '_4'],FILTER_VALIDATE_INT);
		$method_id4 = filter_var($_POST['method_id_' . $task_order . '_4'],FILTER_VALIDATE_INT);
		$response4 = filter_var($_POST['choice_' . $task_order . '_4'],FILTER_VALIDATE_INT);
		insertTaskResponse($uuid, $task_order, $test_id, $method_order4, $method_id4, $response4, $max);
	}
	if($method_count > 4) {
		$method_order5 = filter_var($_POST['method_order_' . $task_order . '_5'],FILTER_VALIDATE_INT);
		$method_id5 = filter_var($_POST['method_id_' . $task_order . '_5'],FILTER_VALIDATE_INT);
		$response5 = filter_var($_POST['choice_' . $task_order . '_5'],FILTER_VALIDATE_INT);
		insertTaskResponse($uuid, $task_order, $test_id, $method_order5, $method_id5, $response5, $max);
	}
	if($method_count > 5) {
		$method_order6 = filter_var($_POST['method_order_' . $task_order . '_6'],FILTER_VALIDATE_INT);
		$method_id6 = filter_var($_POST['method_id_' . $task_order . '_6'],FILTER_VALIDATE_INT);
		$response6 = filter_var($_POST['choice_' . $task_order . '_6'],FILTER_VALIDATE_INT);
		insertTaskResponse($uuid, $task_order, $test_id, $method_order6, $method_id6, $response6, $max);
	}
	
    insertTimeEvent($_SESSION['id'], $_SESSION['uuid'], 4);
	
	$_SESSION['task_iterator'] = $task_order;
	unset($_SESSION['method_choices']);
	
	$test_list = $_SESSION['test_list'];
	
	error_log("current: ".$task_order);
	error_log("max: ".count($test_list));
	if($task_order >= count($test_list)) {
		$_SESSION['page'] = "feedback.php";
		header("Location: ../feedback.php");
	}
	else {
		$nextPage = "task.php";
		
		$_SESSION['page'] = "task.php";
		header("Location: ../task.php");
	}
  }
?>
