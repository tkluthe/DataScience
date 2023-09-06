<?php

  // This sets up the entire task loading infrastructure
  // mostly from the studyConfig.json file.
  session_start();
  require_once('sql_functions.php');

  function updateLanguages($year, $languagenumber) {
	if ($languagenumber == 1) {
		UpdateLang1($year);
        } else if ($languagenumber == 2) {
		UpdateLang2($year);
        } else if ($languagenumber == 3) {
		UpdateLang3($year);
	} 
  }


  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $_SESSION['currentTask'] = 0;
    $_SESSION['task_stage'] = "sample";
    $_SESSION['task_status'] = "in progress";
    $taskCfg = json_decode(file_get_contents("../code/studyConfig.json"));
    $_SESSION['totalTasks'] = $taskCfg->numTasks;


    $languagesAssigned = getAssignedLanguages($_SESSION['year']);
    if ($languagesAssigned['Lang1'] == 0 && $languagesAssigned['Lang2'] == 0 && $languagesAssigned['Lang3'] == 0) {
	$language = rand(1, 3);
	updateLanguages($_SESSION['year'], $language);
    } else if ($languagesAssigned['Lang1'] == 1 && $languagesAssigned['Lang2'] == 0 && $languagesAssigned['Lang3'] == 0) {
	$language = rand(2, 3);
	updateLanguages($_SESSION['year'], $language);
    } else if ($languagesAssigned['Lang1'] == 0 && $languagesAssigned['Lang2'] == 1 && $languagesAssigned['Lang3'] == 0) {
	$numbers = array(1, 3);
	$language = $numbers[rand(1, 2)];
	updateLanguages($_SESSION['year'], $language);
    } else if ($languagesAssigned['Lang1'] == 0 && $languagesAssigned['Lang2'] == 0 && $languagesAssigned['Lang3'] == 1) {
	$language = rand(1, 2);
	updateLanguages($_SESSION['year'], $language);
    } else if ($languagesAssigned['Lang1'] == 1 && $languagesAssigned['Lang2'] == 1 && $languagesAssigned['Lang3'] == 0) {
	$language = 3;
	updateLanguages($_SESSION['year'], $language);
    } else if ($languagesAssigned['Lang1'] == 1 && $languagesAssigned['Lang2'] == 0 && $languagesAssigned['Lang3'] == 1) {
	$language = 2;
	updateLanguages($_SESSION['year'], $language);
    } else if ($languagesAssigned['Lang1'] == 0 && $languagesAssigned['Lang2'] == 1 && $languagesAssigned['Lang3'] == 1) {
	$language = 1;
	updateLanguages($_SESSION['year'], $language);
    } else if ($languagesAssigned['Lang1'] == 1 && $languagesAssigned['Lang2'] == 1 && $languagesAssigned['Lang3'] == 1) {
	resetAllLanguages($_SESSION['year']);	
	$language = rand(1, 3);
	updateLanguages($_SESSION['year'], $language);
    }

    setLanguage($_SESSION['id'], $language);

    $i = 0;
    // this could be more flexible if it was set up better but works for now/
    // in the future, remove switch case and make loop for number of groups and change file format
    foreach ($taskCfg->tasks as $taskRec) {
      $task[$i]['taskNum'] = $taskRec->taskNum;
      switch($language) {
        case 1:
          $task[$i]['fileNameCode'] = $taskRec->templateL1;
          $task[$i]['codeSample'] = $taskRec->codeSampleL1;
          $task[$i]['template'] = $taskRec->baseL1 . "/tasks/" . $taskRec->templateL1;
          $task[$i]['environment'] = $taskRec->environmentL1;
          $task[$i]['base'] = $taskRec->baseL1;
          $task[$i]['totaltasks'] = $_SESSION["totalTasks"];
          break;
        case 2:
          $task[$i]['fileNameCode'] = $taskRec->templateL2;
          $task[$i]['codeSample'] = $taskRec->codeSampleL2;
          $task[$i]['template'] = $taskRec->baseL2 . "/tasks/" .  $taskRec->templateL2;
          $task[$i]['environment'] = $taskRec->environmentL2;
          $task[$i]['base'] = $taskRec->baseL2;
          $task[$i]['totaltasks'] = $_SESSION["totalTasks"];
          break;
        case 3:
          $task[$i]['fileNameCode'] = $taskRec->templateL3;
          $task[$i]['codeSample'] = $taskRec->codeSampleL3;
          $task[$i]['template'] = $taskRec->baseL3 . "/tasks/" . $taskRec->templateL3;
          $task[$i]['environment'] = $taskRec->environmentL3;
          $task[$i]['base'] = $taskRec->baseL3;
          $task[$i]['totaltasks'] = $_SESSION["totalTasks"];
          break;
     }
      $task[$i]['taskDesc'] = $taskRec->taskDesc;
      $task[$i]['taskOutput'] = $taskRec->taskOutput;
      $task[$i]['timeSample'] = $taskRec->timeSample;
      $task[$i]['timeTask'] = $taskRec->timeTask;
      $i++;
      error_log("samples: ".implode(", ", $taskRec->codeSampleL1));
    }
    $_SESSION["task"] = $task;
    //error_log("Inserting time event with id: ". $_SESSION['id']. "code: 5");
    //insertTimeEvent($_SESSION['id'], 5);
    $_SESSION['page'] = "tasks.php";
    header("Location: ../tasks.php");
  }
?>
