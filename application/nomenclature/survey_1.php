<?php require_once("header.php"); ?>

	<h3 style="color:red" align="center"><b><u>Do not use your browser navigation controls.</u></b></h3>
    <div class="container">
      <h1>Demographics Survey</h1>
      
      <p>Please provide the following classification information about yourself.  This information is anonymous and confidential.  Please respond to every question.  If you are not sure what a question is asking, make your best guess and answer accordingly.</p>
      
      <form role="form" action="code/validate_page1.php" method="post">
        <div class="row">
          <div class="col-lg-6">  <!--left column-->

            <div class="form-group">
              <label for="totalxp">How many total years of programming experience do you have (excluding HTML)?</label>
              <input type="number" class="form-control input-md" name="totalxp" min="0" required>
              <p class="comment">Enter 0 if none.</p>
            </div>

            <div class="form-group">
              <label for="jobxp">How many years of studying or working in statistics do you have?</label>
              <input type="number" class="form-control input-md" name="jobxp" min="0" required>
              <p class="comment">Enter 0 if none.</p>
            </div>
              
            <div class="form-group">
              <label for="education">What is your highest level of education?</label>
              <select class="form-control input-md" name="education" required>
                <option></option>
                <option>High School / GED</option>
                <option>Some college / university</option>
                <option>Associate Degree</option>
                <option>Bachelor Degree</option>
                <option>Masters Degree</option>
                <option>Ph. D.</option>
                <option>Other</option>
              </select>
              <p class="comment">If you received your highest degree in another country, please pick the best match</p>
            </div>

            <div class="form-group">
              <label for="institution">At what institution are you completing this study?</label>
              <input type="text" class="form-control input-md" name="institution" required>
              <p class="comment">Type "none" if not affiliated or in school.</p>
            </div>

            <div class="form-group">
              <label for="major">What is your major?</label>
              <input type="text" class="form-control input-md" name="major" required>
              <p class="comment">Type "none" if non-degree seeking or not currently in school.</p>
            </div>

            <div class="form-group">
              <label for="degree">What is the exact title of your degree program (or the highest degree you received if you are not currently in school)?</label>
              <input type="text" class="form-control input-md" name="degree" required>
              <p class="comment">(e.g. B.S. in Biology, B.A. in Physics, etc.) If you have two majors you may list both.  If you have no major yet, enter "undecided".</p>
            </div>
            
            <div class="form-group">
              <label for="year">If you are enrolled in college, approximately what year are you in your education? If you are working in software please select "Professional".</label>
              <select class="form-control input-md" name="year" required>
                <option></option>
                <option>Not Applicable</option>
                <option>Freshman</option>
                <option>Sophomore</option>
                <option>Junior</option>
                <option>Senior</option>
                <option>Graduate</option>
                <option>Post-graduate</option>
                <option>Non-degree seeking</option>
                <option>Professional</option>
              </select>
              <p class="comment">If you are enrolled in another country, please pick the best match. If not in school, select "Not Applicable"</p>
            </div>
          </div>

          <div class="col-lg-6"> <!--right column-->
            <div class="form-group">
              <label for="gpa">On a 4.0 scale, approximately what is your academic GPA?</label>
              <select class="form-control input-md" name="gpa" required >
                <option></option>
                <option>3.50-4.00</option>
                <option>3.00-3.49</option>
                <option>2.50-2.99</option>
                <option>2.00-2.49</option>
                <option>Below 2.00</option>
                <option>I do not have a GPA</option>
              </select>
              <p class="comment">If you are not currently enrolled, please choose your GPA at the last educational institution that you attended.</p>
            </div>
              
            <div class="form-group">
              <label for="origin">What is your country of origin?</label>
              <select class="form-control input-md" name="origin" required size="1">
                  <option></option>
                  <?php require_once("code/country_list.php"); ?>
              </select>
            </div>
              
            <div class="form-group">
              <label for="language">What is your primary language (i.e., the language you speak at home)?</label>
              <select class="form-control input-md" name="language" required >
                <option></option>
                <?php require_once("code/language_list.php"); ?>
                <option>Other</option>
              </select>
            </div>
			
              
            <div class="form-group">
              <label for="fluency">If English is <u>not</u> your native language, on a scale from 0 to 10 (with 0 being not fluent at all and 10 being completely fluent) how fluent would you consider yourself to be in English.</label>
              <select class="form-control input-md" name="fluency">
                <option></option>
                <option>0</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
              </select>
              <p class="comment">Fluency in a language involves the ability to easily read and understand texts written in the language, the ability to formulate written texts in the language, the ability to follow and understand speech in the language, and the ability to produce speech in the language and be understood by its speakers.</p>
            </div>


			<div class="form-group">
				<label>Do you identify as having a disability or other chronic condition?</label>
				<div>
					<input type="radio" id="disabilityOrOtherYes" name="disclosed" value="Yes" required></input>
					<label>Yes</label>
				</div>
				<div>
					<input type="radio" id="disabilityOrOtherNo" name="disclosed" value="No"></input>
					<label>No</label>
				</div>
				<div>
					<input type="radio" id="disabilityOrOtherNotDisclosed" name="disclosed" value="Not Disclosed"></input>
					<label>Prefer not to disclose<label>
				</div>
			</div>
			
            <div class="form-group">
              <label>Please check all of the following that apply to you, if any:</label>
			  <div class="col-lg-6">
				  <div class="checkbox"><label><input type="checkbox" name="attentionDeficit">Attention deficit</label></div>
				  <div class="checkbox"><label><input type="checkbox" name="autism">Autism</label></div>
				  <div class="checkbox"><label><input type="checkbox" name="blind">Blind or visually impaired</label></div>
				  <div class="checkbox"><label><input type="checkbox" name="deaf">Deaf or hard of hearing</label></div>
				  <div class="checkbox"><label><input type="checkbox" name="health">Health-related disability</label></div>
				  <div class="checkbox"><label><input type="checkbox" name="learning">Learning disability</label></div>
			  </div>
			  <div class="col-lg-6">
				  <div class="checkbox"><label><input type="checkbox" name="mentalHealth">Mental health condition</label></div>
				  <div class="checkbox"><label><input type="checkbox" name="mobility">Mobility-related disability</label></div>
				  <div class="checkbox"><label><input type="checkbox" name="speech">Speech-related disability</label></div>
				  <div class="checkbox"><label><input type="checkbox" id="other" name="other" onclick="showHideOtherDescription()">Other (please specify):</label> </div>
				  <div style="padding-left: 20px"><input type="text" id="otherDescription" name="otherDescription" maxlength="200" disabled></input></div>
			  </div>
            </div>
              
          </div>
        </div>
        <p align="right">
          <button type="submit" class="btn btn-success" style="align">Next</button>
        </p>
      </form>
            
    </div>

<script>
	function showHideOtherDescription() {
		var otherCheckBox = document.getElementById("other");
		var otherDescription = document.getElementById("otherDescription");
		
		if(otherCheckBox.checked == true){
			otherDescription.disabled = false;
		} else {
			otherDescription.value = "";
			otherDescription.disabled = true;
		}
	}
</script>
<?php require_once("footer.php"); ?>
