<?php
  session_start();
  require_once('sql_functions.php');
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int) $_SESSION['id'];
    $comments= $_POST['comments'];
    $stoodOutDifficult = $_POST['stoodOutDifficult'];
    $stoodOutEasier = $_POST['stoodOutEasier'];
    insertFeedback($id, $comments, $stoodOutDifficult, $stoodOutEasier);
    insertTimeEvent($id, $_SESSION['uuid'], 11);
  }
  $_SESSION['page'] = "finished.php";
?>
