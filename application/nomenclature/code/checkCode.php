<?php
  session_start();
  require_once('sql_functions.php');

  // create base directory path with opening quotes
  $baseDirectory = '/Library/WebServer/Documents/syn/EPI';

  // Getting info from request
  $codefilename = "Task1.r";
  $id = (int) $_SESSION['id'];
  $event = $_POST['event'];
  $currenttask = (int) $_SESSION['currentTask']+1;
  $t = $_SESSION['task'];
  $tasks = $t[$currenttask-1];
  $base = $tasks['base'];

  $maxtime = 12;
  $entry = $_POST['entry'];

  // creating file path for temporary storage
  $filepath = "../tmp/".$id."/".$currenttask;

  // creates file path to tmp file for interpretation by Rscript
  $file = $filepath."/".$tasks['fileNameCode']; 

  $tmpz = shell_exec("pwd");

  // create folder 
  exec("mkdir -p ".$filepath);

  //create variables for filepath of csv
  $csvFilePath = '"'.$baseDirectory.'/data/americanStats.csv"';

  // add csvfilename to read.csv function
  $csvRead = 'americanStats=read.csv('.$csvFilePath.')'.PHP_EOL;

  // variable to store path to solution
  $solutionPath = $baseDirectory."/documents/".$base."/solutions/".$tasks['fileNameCode'];

  // variable to store handle of solutionpath
  $solutionHandle = fopen($solutionPath, "r") or die ("Unable to open file!");

  // variable to store read of handle
  $solutionContents = fread($solutionHandle, filesize($solutionPath));

  // close the solution handle
  fclose($solutionHandle);

  // open the tmp task file for writing 
  $taskfile = fopen($file, "w") or die ("Unable to open file!");
  
  // write csvRead function, the entry code, and the solution contents
  fwrite($taskfile, $csvRead);

  fwrite ($taskfile, $entry);

  fwrite($taskfile, $solutionContents);
 
  fclose($taskfile);

  $errorFile = $baseDirectory.'/tmp/'.$id.'/'.$currenttask.'/errorOutput.txt';

  $answerFile = '\tmp\answer.txt'; 
  $errorFile = '\tmp\error-output.txt';
  // descriptor array
  $desc = array(
      0 => array('pipe', 'r'), // 0 is STDIN for process
      1 => array('pipe', 'w'), // 1 is STDOUT for process //1 => array('file', $baseDirectory.'\tmp\output.txt', 'w'), // 1 is STDOUT for process
      2 => array('pipe', 'w') // 2 is STDERR for process
  );

  // command to invoke rscript
  $cmd = "/usr/local/bin/Rscript ".$file;

  // spawn the process
  $p = proc_open($cmd, $desc, $pipes);

  $getoutput = "Test";
  $getoutput = stream_get_contents($pipes[1]);
  fclose($pipes[1]);

  $geterror = "Test";
  $geterror = stream_get_contents($pipes[2]);
  fclose($pipes[2]);

  //if error print error
  if($getoutput == ""){
    $outputarray = explode("\n", $geterror, -1);
    $returncode = 1;
  }else{

    //if solution
    //run solution script
    // command to invoke rscript
    $cmd = "/usr/local/bin/Rscript ".$baseDirectory."/documents/solutionBool.r";

    // spawn the process
    $p = proc_open($cmd, $desc, $pipes);
    // get the solution result;
    $getsolution = "Test";
    $getsolution = stream_get_contents($pipes[1]);
    fclose($pipes[1]);

    //compare scripts

    if($getsolution == $getoutput){
      $outputarray = explode("\n", $getoutput, -1);
      $returncode = 0;
      $event = 8;
    }else{
      // $getoutput = "Incorrect answer. Did you use the correct function. Did you use the correct column variable.".PHP_EOL.$getoutput;
      $getoutput = "Incorrect answer. Check which function you used. Check which column variable you used.".PHP_EOL.$getoutput;
      $outputarray = explode("\n", $getoutput, -1);
      $returncode = 1;
      $event = 13;
    } 
  }

  // encode JSON out of result
  $returnJson = json_encode(array( 
    'returncode' => $returncode,
    'outputText' => $outputarray,
    'id' => $id,
    'event' => $event,
    'task' => $currenttask,
  ));

  //error_log($output);
  // insert data into database table
  insertCodeEvent($id, $_SESSION['uuid'], $event, $currenttask-1, $entry, implode('\n', $outputarray));
  echo $returnJson;
?>