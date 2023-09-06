<?php
  session_start();
  require_once('sql_functions.php');
  $id = (int) $_SESSION['id'];
  $event = $_POST['event'];
  $task = (int) $_SESSION['currentTask'];
  $entry = $_POST['entry'];

  $timer = $_POST['timer'];
  $timerID = $_POST['timerID'];
  if ($whichtimer == "sample") {
    $_SESSION['sampletimer'] = $timer;
  }
  if ($whichtimer == "task") {
    $_SESSION['tasktimer'] = $timer;
  }


  insertCodeEvent($id, $_SESSION['uuid'], $event, $task, $entry);
  echo $id, $event, $task, $entry;
?>
