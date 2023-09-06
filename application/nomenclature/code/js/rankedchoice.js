function checkPoints( max, question, choice ) {
	
	var pool = document.getElementById("pointPool_" + question);
	var max = document.getElementById("maxPoints_" + question);
	var total = 0;
	var choices = [];
	
	var choice1 = document.getElementById("choice_" + question + "_1");
	if(choice1 != null){
		total = total + parseInt(choice1.value);
		choices.push(choice1);
	}
	var choice2 = document.getElementById("choice_" + question + "_2");
	if(choice2 != null){
		total = total + parseInt(choice2.value);
		choices.push(choice2);
	}
	var choice3 = document.getElementById("choice_" + question + "_3");
	if(choice3 != null){
		total = total + parseInt(choice3.value);
		choices.push(choice3);
	}
	var choice4 = document.getElementById("choice_" + question + "_4");
	if(choice4 != null){
		total = total + parseInt(choice4.value);
		choices.push(choice4);
	}
	var choice5 = document.getElementById("choice_" + question + "_5");
	if(choice5 != null){
		total = total + parseInt(choice5.value);
		choices.push(choice5);
	}
	var choice6 = document.getElementById("choice_" + question + "_6");
	if(choice6 != null){
		total = total + parseInt(choice6.value);
		choices.push(choice6);
	}
	
	/*if(total > max) {
		reduceChoice = document.getElementById("choice_" + question + "_" + choice);
		reduceChoice.value = reduceChoice.value - ( total - max);
		total = max;
	}*/
	
	for(i = 0; i < choices.length; i++) {
		clearTies( choices[i] );
	}
	
	for(i = 0; i < choices.length; i++) {
		for(j = i + 1; j < choices.length; j++) {
			checkTies( choices[i], choices[j] );
		}
	}
	
	pool.value = max.value - total;
	
	var questionErrorLabel = document.getElementById("errorLabel_points_" + question);
	var pointTotal = document.getElementById("pointPool_" + question);
	if(total > max.value) {
		//questionErrorLabel.style.display = "block";
		pointTotal.classList.remove("successInput");
		pointTotal.classList.add("errorInput");
	}
	else if(total == max.value) {
		pointTotal.classList.remove("errorInput");
		pointTotal.classList.add("successInput");
	}
	else {
		//questionErrorLabel.style.display = "none";
		pointTotal.classList.remove("errorInput");
		pointTotal.classList.remove("successInput");
	}
	
}

function clearTies( choice ) {
	choice.classList.remove("errorInput");
}

function checkTies( choice1, choice2 ) {
	if(choice1.value == choice2.value) {
		choice1.classList.add("errorInput");
		choice2.classList.add("errorInput");
		return true;
	}
	return false;
		
}

function isNumeric( input ) {
	if(input.value == null || input.value == "")
		input.value = 0;
	else(input.value != 0)
		input.value = parseInt(input.value);
}

function validateForm() {
	
	var questions = document.querySelectorAll("[name^=question_]");
	var name = questions[0].getAttribute("name");
	var nameTokenized = name.split("question_");
	var questionNumber = nameTokenized[1];
	
	var total = 0;
	var choices = [];
	
	var method_id1 = document.getElementById("method_id_" + questionNumber + "_1");
	var choice1 = document.getElementById("choice_" + questionNumber + "_1");
	if(choice1 != null){
		total = total + parseInt(choice1.value);
		isNumeric(choice1);
		choices.push(choice1);
	}
	
	var method_id2 = document.getElementById("method_id_" + questionNumber + "_2");
	var choice2 = document.getElementById("choice_" + questionNumber + "_2");
	if(choice2 != null){
		total = total + parseInt(choice2.value);
		isNumeric(choice2);
		choices.push(choice2);
	}
	
	var method_id3 = document.getElementById("method_id_" + questionNumber + "_3");
	var choice3 = document.getElementById("choice_" + questionNumber + "_3");
	if(choice3 != null){
		total = total + parseInt(choice3.value);
		isNumeric(choice3);
		choices.push(choice3);
	}
	
	var method_id4 = document.getElementById("method_id_" + questionNumber + "_4");
	var choice4 = document.getElementById("choice_" + questionNumber + "_4");
	if(choice4 != null){
		total = total + parseInt(choice4.value);
		isNumeric(choice4);
		choices.push(choice4);
	}
	
	var method_id5 = document.getElementById("method_id_" + questionNumber + "_5");
	var choice5 = document.getElementById("choice_" + questionNumber + "_5");
	if(choice5 != null){
		total = total + parseInt(choice5.value);
		isNumeric(choice5);
		choices.push(choice5);
	}
	
	var method_id6 = document.getElementById("method_id_" + questionNumber + "_6");
	var choice6 = document.getElementById("choice_" + questionNumber + "_6");
	if(choice6 != null){
		total = total + parseInt(choice6.value);
		isNumeric(choice6);
		choices.push(choice6);
	}
	
	var error = false;
	
	for(i = 0; i < choices.length; i++) {
		clearTies( choices[i] );
	}
	
	var check = false;
	for(i = 0; i < choices.length; i++) {
		for(j = i + 1; j < choices.length; j++) {
			check = checkTies( choices[i], choices[j] );
			if(check)
				error = true;
		}
	}
	
	questionTieLabel = document.getElementById("errorLabel_tied_" + questionNumber);
	if(error) {
		questionTieLabel.style.display = "block";
	}
	else {
		questionTieLabel.style.display = "none";
	}
	
	var max = document.getElementById("maxPoints_" + questionNumber);
	
	var questionErrorLabel = document.getElementById("errorLabel_points_" + questionNumber);
	var	pointTotal = document.getElementById("pointPool_" + questionNumber);
	if(total != max.value) {
		questionErrorLabel.style.display = "block";
		pointTotal.classList.remove("successInput");
		pointTotal.classList.add("errorInput");
		
		error = true;
    }
	else {
		questionErrorLabel.style.display = "none";
		pointTotal.classList.remove("errorInput");
		pointTotal.classList.add("successInput");
	}
	
	if(error) {
		event.preventDefault();
		return false;
	}
	else {
		return true;
	}
}

