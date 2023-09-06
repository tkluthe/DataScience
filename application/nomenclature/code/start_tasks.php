<?php
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
  
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	## LANG1 = R
	## LANG2 = Python
	## LANG3 = Matlab
	
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
		
	#SELECT TEST_ID FROM TEST
	$test_ids = getTests();
	$_SESSION['language'] = $language;
	
	
	#randomize result set order
	shuffle($test_ids);
	$_SESSION['test_list'] = $test_ids;
	
	foreach($test_ids as $test) {
		
	}
	
	#create task order variable starting at 1
	$task_order = 0;
	$_SESSION['task_iterator'] = $task_order;
	}
	#go to generic task page
    $_SESSION['page'] = "task.php";
    header("Location: ../task.php");
    exit();
?>
