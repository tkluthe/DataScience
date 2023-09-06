var numTasks;
var task;
var timerInterval;

$(document).ready(function(){
    $.ajax({
        url:"code/get_study_status.php",
        complete: function (response) {
            var status = JSON.parse(response.responseText);
            numTasks = status.total_tasks;
            $.ajax({
                url:"code/get_current_task.php",
                async: false,
                complete: setUpTask
            });
            console.log(status.task_stage);
            if (status.task_stage === "sample") {
                displaySample();
            } else if (status.task_stage === "coding") {
                displayCode();
            }
        }
    });
    $("#sampleButton").click(function() {
        displayCode();
    });
    $("#checkButton").on('click', function(){
//        $("#pleaseWaitDialog").modal(); // show loading animation
//        $(this).button('loading');
        $("#checkButton").button('loading');
        checkTask(12);
    });
    $("#hidetimerbutton").click(function() {
      if($("#task-timer").is(":visible")) {
        $("#task-timer").hide();
        $("#hidetimerbutton").html("Show Timer");
      }
      else{
        $("#task-timer").show();
        $("#hidetimerbutton").html("Hide Timer");
      }
    });
    $("#modalButton").click(function(){
        goToNextTask();
    });
    $(document).delegate('#entry-area', 'keydown', function(e) {
      var keyCode = e.keyCode || e.which;

      if (keyCode == 9) {
        e.preventDefault();
        var start = $(this).get(0).selectionStart;
        var end = $(this).get(0).selectionEnd;

        // set textarea value to: text before caret + tab + text after caret
        $(this).val($(this).val().substring(0, start)
                    + "\t"
                    + $(this).val().substring(end));

        // put caret at right position again
        $(this).get(0).selectionStart = start + 1;
        $(this).get(0).selectionEnd = start + 1;
      }
    });
});

function setUpTask(response) {
  task = JSON.parse(response.responseText);
  var i = 0;
  for (i = 0; i < task.codeSample.length; i++){
    addSampleTab("Sample " + (i + 1)  , i);
    addSampleDisplayArea(i);
    var id = "#smplA"+i;
    $(id).load("documents/" + task.codeSample[i]);
  }
  $("#task-num").html("Task: " + task.taskNum + " of " + task.totaltasks); 
  $("#task-output").load("documents/" + task.taskOutput);
  $("#timerSample").text(task.timeSample + ":00");
  $("#timerTask").text(task.timeTask + ":00");

  $.get("documents/" + task.template, function(result) {
      $("#entry-area").val(result);
  });
}

function addSampleTab(name, id) {
  if (id == 0){
    var tag = "<li id='smplT"+id+"' role='presentation' class='active'> <a id='smplL"+id+"'href='#smplA"+id+"' aria-controls='#smplA"+id+"' role='tab' data-toggle='tab'>" + name + "</a></li>"
  } else {
    var tag = "<li id='smplT"+id+"' role='presentation'> <a id='smplL"+id+"'href='#smplA"+id+"' aria-controls='#smplA"+id+"' role='tab' data-toggle='tab'>" + name + "</a></li>"
  }
  $("#sampletab").append(tag);
  $("#smplT"+id).click(function () {
    $.ajax({
        url: 'code/insertSampleSwitchEvent.php',
        type: 'POST',
        data: { 'event': '14', 'samplename' : name },
    });
  });
}

function addSampleDisplayArea(id) {
  if (id == 0) {
    $("#tabpanel").append("<div class='tab-pane form-control display-area codeSample active' id='smplA"+id+"' >empty</div>");
  } else {
    $("#tabpanel").append("<div class='tab-pane form-control display-area codeSample ' id='smplA"+id+"' >empty</div>");
  }
}

function showModal() {
  $(".modal-title").html("Success!");
  $(".modal-body").html("<p> You have successfully solved the task! </p><p> Click the button below to go to the next part of the experiment</p>");
  $("#modal").modal();
}

function showTimeupModal() {
  $(".modal-title").html("Time up!");
  $(".modal-body").html("<p> The time for this task ran out. Please move on to the next task </p><p> To move on please click the button below</p>");
  $("#modal").modal();
}

/**
 * Check if code is correct by using checkCode.php, if yes, go to next page
 */
function checkTask(num) {
    console.log({'entry' : $("#entry-area").val()});
    $.ajax({
        url: 'code/checkCode.php',
        type: 'POST',
        async: true,
        data: { 'event': num, 'entry': $("#entry-area").val()},
        complete: function(response) {
          console.log(response);
          output = JSON.parse(response.responseText);
          var joinedtext = output.outputText.join("\n");
          $("#task-output").text(joinedtext);

          $("#checkButton").button('reset'); // stop showing loading animation
          if (output.returncode === 0) {
            showModal();
          } else {
            if (num === 13) {
              showTimeupModal();

            }
          }
        }
    });
}


function goToNextTask() {
    clearWorkingArea();
    getNextTask();
    if (task == numTasks) {
        $.ajax({
          url: 'code/gotoFeedback.php',
          type: 'POST',
          async: true,
          complete: function (response) {
            window.location.replace("feedback.php");
          }
        });

    } else {
        displayCode();
    }
}

function clearWorkingArea() {
    $("#entry-area").val('');
    $("#tabpanel").empty();
    $("#sampletab").empty();
    deleteCookie("tasktimer");
    deleteCookie("sampletimer");
}

function displayCode() {
    $("#instruction-div").hide();
    $("#assignment-div").show();
    $("#user-div").show();
    $("#best-shot-panel").show();
    $("#sampleButton").hide();
    $("#label-sample").hide();
    $("#label-code").show();
    $("#entry-area").focus();
    $("#entry-area").height(1200);
//    $("#entry-area").height($("#sample-area").height());
    clearInterval(timerInterval);
    startTimer(task.timeTask, timerTask);
    setCaretToPos($("#entry-area")[0], 0);
    $("#entry-area").scrollTop(0);
    $.ajax({
        url: 'code/insertTaskTimeEvent.php',
        type: 'POST',
        data: { 'event': '6' },
    });
}

function displaySample() {
    console.log("sample display");
    $("#instruction-div").show();
    $("#sampleButton").show();
    $("#label-sample").show();
    $("#label-code").hide();
    $("#assignment-div").hide();
    $("#user-div").hide();
    $("#best-shot-panel").hide();
    clearInterval(timerInterval);
    startTimer(task.timeSample, timerSample);
    $.ajax({
        url: 'code/insertTaskTimeEvent.php',
        type: 'POST',
        data: { 'event': '5'},
    });
}

function getNextTask() {
    $.ajax({
        url:"code/next_task.php",
        async: false,
        complete: function (response) {
            var res = response.status + " - " + response.statusText + "\n";
            if (!response.responseText) {
                task = numTasks;
            } else {
                setUpTask(response);
            }
        },
        error: function () {
            $("#sample-area").text("There was an error");
        }
    });
}

function startTimer(duration, timerID) {
    var start = Date.now(), diff, m, s;
    if (timerID == timerTask) {
      var cookie = getCookie("tasktimer");
      if ( cookie ) {
        start = cookie;
      } else {
        document.cookie = "tasktimer="+start;
      }
    } else {
      var cookie = getCookie("tasktimer");
      if ( cookie ) {
        start = cookie;
      } else {
        document.cookie = "sampletimer="+start;
      }
    }
    var postInterval = 5;
    var whichtimer;
    if (timerID == timerTask) {
      whichtimer = "task";
    } else {
      whichtimer = "sample";
    }
    duration *= 60;
    var nextPost = duration - postInterval;
    function timer() {
        diff = duration - (((Date.now() - start) / 1000) | 0);
        if (diff <= 0) {
            if (timerID == timerTask) {
                checkTask(13);
            } else {
                displayCode();
            }
        }
        if (diff <= nextPost) {
            $.ajax({
                url: 'code/insertCodeEvent.php',
                type: 'POST',
                data: { 'event': '7', 'entry': $("#entry-area").val(), 'timer' : diff, 'timerId' : whichtimer},
            });
            nextPost = diff - postInterval;
        }
        m = (diff / 60) | 0;
        s = (diff % 60) | 0;
        s = s < 10 ? "0" + s : s;
        timerID.textContent= m + ":" + s;
        if (diff <= 0) {
            start = Date.now() + 1000;
        }
    };
    timer();
    timerInterval = setInterval(timer, 1000);
}

function setSelectionRange(input, selectionStart, selectionEnd) {
  if (input.setSelectionRange) {
    input.focus();
    input.setSelectionRange(selectionStart, selectionEnd);
  } else if (input.createTextRange) {
    var range = input.createTextRange();
    range.collapse(true);
    range.moveEnd('character', selectionEnd);
    range.moveStart('character', selectionStart);
    range.select();
  }
}

function setCaretToPos(input, pos) {
  setSelectionRange(input, pos, pos);
}


function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') {
          c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
          return c.substring(name.length,c.length);
      }
  }
  return "";
}

function deleteCookie(name) {
  document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
