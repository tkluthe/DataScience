<?php require_once("header.php"); ?>
<!--temporary for testing-->
<?php  $_SESSION["task_status"] = ""; ?>
<!--copied from Patrick-->
<?php
  if(!isset($_SESSION)){
	session_start();
  }
  require_once('code/sql_functions.php');
  $test_list = $_SESSION['test_list'];
  $test_id = $_SESSION['test_list'][$_SESSION['task_iterator']];
  $phrase = getTestPhrase($test_id);
  
  if(isset($_SESSION['method_choices'])) {
	  $method_choices = $_SESSION['method_choices'];
  }
  else {
	  $method_choices = getMethodDetails($test_id, $_SESSION['language']);
	  shuffle($method_choices);
	  $_SESSION['method_choices'] = $method_choices;
  }
  $points = count($method_choices) * 5;
  $current_task = $_SESSION['task_iterator'] + 1;
  $total_tasks = count($test_list);
?>
<script type="text/javascript" src="code/js/rankedchoice.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/rankedchoice.css"></link>
	  <h3 style="color:red" align="center"><b><u>Do not use your browser navigation controls.</u></b></h3>
    <div class="container">
		<form role="form" action="code/validate_task_response.php" method="post" onsubmit="validateForm();">
	  <?php
		echo "<h1>Task $current_task of $total_tasks</h1>";
	  ?>
      <h4>Instructions</h4>
      <div>
	  <?php
          echo "<p>Please read the following phrase and distribute points according to your preference. You are allotted a bank of <b>$points points</b> that you are to distribute across the set of methods; where <u>more points means it matches the phrase or concept well</u> and <u>less points means it is not a very good match</u>. The total points in the bank will vary between questions based on the number of response options are avaialble. <b>You must use all of the points on each question, and there cannot be any ties in your selection.</b></p>";
      ?>
	  </div>
	  
	  <hr>
		<div style class="form-group">
			<?php
			echo "<div name='question_$current_task'>";
			?>
				<div class="col-lg-12">
					<?php
						echo "<div id='errorLabel_points_$current_task' style='display: none'>";
					?>
						<p style="color: #FF0000">Please make sure you have used all the points.</p>
					</div>
					<?php
						echo "<div id='errorLabel_tied_$current_task' style='display: none'>"
					?>
						<p style="color: #FF0000">Please make sure there are no ties in your ranking.</p>
					</div>
				</div>
				<div class="col-lg-12 questionStatement">
					<p><b>Phrase:</b></p>
					<?php
						echo "<input type='hidden' id='test_id' name='test_id' value='$test_id'>";
					?>
					<?php
						echo "<p>$phrase</p>";
					?>
				</div>
				<div class="col-lg-12 pointPoolDiv">
				<?php
					echo "<span class='pointPoolLabel'><b>Points Remaining:</b></span><input class='pointPool' type='text' id='pointPool_$current_task' value='$points' disabled></input>";
					echo "<input type='hidden' id='maxPoints_$current_task' name='maxPoints_$current_task' value='$points'/>";
				?>
				</div>
				<?php
					$method_count = 1;
					foreach($method_choices as $row) {
						$name_suffix = $current_task . "_" . $method_count;
						echo "<div class='col-lg-12 selectionDiv'>";
						echo "	<input type='hidden' id='method_order_$name_suffix' name='method_order_$name_suffix' value='$method_count'/>";
						echo "	<input type='hidden' id='method_id_$name_suffix' name='method_id_$name_suffix' value='$row[0]'>";
						echo "	<input class='choice' type='number' id='choice_$name_suffix' name='choice_$name_suffix' min='0' max='$points' value='0' onkeyup='isNumeric( this ); checkPoints($points, $current_task, $method_count)' onchange='isNumeric( this ); checkPoints($points, $current_task, $method_count)'></input><span class='choiceLabel'>$row[1]</span>";
						echo "</div>";
						$method_count = $method_count + 1;
					}
				?>
			</div>
		</div>
	  
      <hr>
      <div class="row">
        <div class="col-lg-9"> <!--left column-->
        </div>
        <div class="col-lg-3"> <!--right column-->
            <p align="right">
              <button type="submit" class="btn btn-success">Next</button>
            </p>
        </div>
      </div>
      </form>
    </div>

<?php require_once("footer.php"); ?>
