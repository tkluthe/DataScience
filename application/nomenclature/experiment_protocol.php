<?php require_once("header.php"); ?>
<!--temporary for testing-->
<?php  $_SESSION["task_status"] = "not started"; ?>
<!--copied from Patrick-->
<script type="text/javascript" src="code/js/rankedchoice.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/rankedchoice.css"></link>
<script>
    $(document).ready(function(){
        deleteCookie("tasktimer");
        deleteCookie("sampletimer");
    });
    function deleteCookie(name) {
      document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }
</script>
	  <h3 style="color:red" align="center"><b><u>Do not use your browser navigation controls.</u></b></h3>
    <div class="container">
		<form role="form" action="code/start_tasks.php" method="post" onsubmit="validateForm();">
      <h1>Experiment Protocol</h1>
      <p>Please read the following protocol carefully so that you understand what will happen during the study.</p>
      <h4>Survey Information</h4>
      <div>
          <p>The following survey will consist of weighted, ranked choice questions. Each question will consist of a definition or phrase explaining a statistical test or concept followed by a set of potential method names or operations. You are allotted a bank of <b>points</b> that you are to distribute across the set of methods; where <u>more points means it matches the phrase or concept well</u> and <u>less points means it is not a very good match</u>. The total points in the bank may vary between questions based on the number of response options that are available. <b>You must use all of the points on each question, and there cannot be any ties in your selection.</b>
          </p>
      </div>
	  
	  <hr>
	
		<h4>Example:</h4>
		
        <div class="row">
          <div class="col-lg-12"> 
			<div class="form-group">
				<div name="question_example">
					<div class="col-lg-12">
						<div id="errorLabel_points_example" style="display: none">
							<p style="color: #FF0000">Please make sure there are exactly 0 points remaining.</p>
						</div>
						<div id="errorLabel_tied_example" style="display: none">
							<p style="color: #FF0000">Please make sure there are no ties in your ranking.</p>
						</div>
					</div>
					<div class="col-lg-12 questionStatement">
						<p><b>Phrase:</b></p>
						<input type="hidden" id="test_id" value="example">
						<p>Find the central tendency of a set of numbers</p>
					</div>
					<div class="col-lg-12 pointPoolDiv">
						<span class="pointPoolLabel"><b>Points Remaining:</b></span><input class="pointPool" type="text" id="pointPool_example" value="15" disabled></input>
							<input type='hidden' id='maxPoints_example' name='maxPoints_example' value='15'/>
					</div>
					<div class="col-lg-12 selectionDiv">
						<input type="hidden" id="method_id_example_1" value="example_1">
						<input class="choice" type="number" id="choice_example_1" min="0" max="15" value="0" onkeyup="isNumeric( this ); checkPoints(15, 'example', 1)" onchange="isNumeric( this ); checkPoints(15, 'example', 1)"></input><span class="choiceLabel">average( ... )</span>
					</div>
					<div class="col-lg-12 selectionDiv">
						<input type="hidden" id="method_id_example_2" value="example_2">
						<input class="choice" type="number" id="choice_example_2" min="0" max="15" value="0"  onkeyup="isNumeric( this ); checkPoints(15, 'example', 2)" onchange="isNumeric( this ); checkPoints(15, 'example', 2)"></input><span class="choiceLabel">avg( ... )</span>
					</div>
					<div class="col-lg-12 selectionDiv">
						<input type="hidden" id="method_id_example_3" value="example_3">
						<input class="choice" type="number" id="choice_example_3" min="0" max="15" value="0"  onkeyup="isNumeric( this ); checkPoints(15, 'example', 3)" onchange="isNumeric( this ); checkPoints(15, 'example', 3)"></input><span class="choiceLabel">mean( ... )</span>
					</div>
				</div>
			</div>
			</div>
			</div>
	  
      <hr>
	  
      <h4>After Each Task</h4>
      <div>
          <p>After each task, your response will be saved and you will proceed to the next question.  Follow through the entire study until you receive a confirmation of completion at the end.
      </div>
      
      <div class="row">
        <div class="col-lg-9"> <!--left column-->
        </div>
        <div class="col-lg-3"> <!--right column-->
            <p align="right">
              <button type="submit" class="btn btn-success">Begin Survey</button>
            </p>
        </div>
      </div>
      </form>
    </div>

<?php require_once("footer.php"); ?>
