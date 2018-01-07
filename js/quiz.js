var choice = '0';
var correctlyAnswered = 0;
var answering = true;
var obj;

$(document).ready(function () {
    submitButton();
    getQuiz();
});

function getQuiz(send_correct) {

    if (send_correct === undefined) {
        $.post("getquiz.php", {getquiz: ""}, function (data, status) {
            fillWithQuestion(data)
        });
    } else {
        $.post("getquiz.php", {getquiz: "", correct: send_correct}, function (data, status) {
            fillWithQuestion(data)
        });
    }


    $("#answer-a").click(function () {
        choice = 'a';
        updateSelected();
    });

    $("#answer-b").click(function () {
        choice = 'b';
        updateSelected();
    });

    $("#answer-c").click(function () {
        choice = 'c';
        updateSelected();
    });

    $("#answer-d").click(function () {
        choice = 'd';
        updateSelected();
    });

    $("#submit").click(function () {
        submit();
    });

    $("#next").click(function () {
        console.log("next");
        nextQuestion();
    })
}

function fillWithQuestion(data) {
    console.log(data);
    obj = JSON.parse(data);
    if (obj.type == "question") {
        $("#question-text").html(obj.question);
        $("#answer-a-text").html(obj.a);
        $("#answer-b-text").html(obj.b);
        $("#answer-c-text").html(obj.c);
        $("#answer-d-text").html(obj.d);
        $("#question-header").html("<h3>Question: " + obj.questionnumber + "/20</h3>");
    } else if (obj.type == "result") {
        $("#quiz").html('<div class="w3-container w3-helvetica" id="result">' +
            ' <div class="w3-card-4" style="width:100%;"> ' +
            '<header class="w3-container w3-blue" id="result-header"> ' +
            '<h3>Result</h3> ' +
            '</header> ' +
            '<div id="result-text" style="font-size: 14pt">You answered ' + obj.correctly_answered + ' out of 20 question correctly.<br></div> </div> </div>');
        againButton();
    }

}

function updateSelected() {
    if (choice === 'a') {
        $("#answer-a").css("background", "lightgray");
    } else {
        $("#answer-a").css("background", "");
    }

    if (choice === 'b') {
        $("#answer-b").css("background", "lightgray");
    } else {
        $("#answer-b").css("background", "");
    }

    if (choice === 'c') {
        $("#answer-c").css("background", "lightgray");
    } else {
        $("#answer-c").css("background", "");
    }

    if (choice === 'd') {
        $("#answer-d").css("background", "lightgray");
    } else {
        $("#answer-d").css("background", "");
    }
}

function submit() {
    if (choice === '0') {
        alert("Nothing selected!");
    } else {
        if (choice == obj.correct) {
            correctlyAnswered = 1;
        } else {
            correctlyAnswered = 0;
            if (choice == 'a') {
                $("#answer-a").css("background", "red");
            } else if (choice == 'b') {
                $("#answer-b").css("background", "red");
            } else if (choice == 'c') {
                $("#answer-c").css("background", "red");
            } else if (choice == 'd') {
                $("#answer-d").css("background", "red");
            }
        }

        if (obj.correct == 'a') {
            $("#answer-a").css("background", "green");
        } else if (obj.correct == 'b') {
            $("#answer-b").css("background", "green");
        } else if (obj.correct == 'c') {
            $("#answer-c").css("background", "green");
        } else if (obj.correct == 'd') {
            $("#answer-d").css("background", "green");
        }

        answering = false;
        nextButton();
    }
}

function nextQuestion() {
    choice = '0';
    $("#answer-a").css("background", "");
    $("#answer-b").css("background", "");
    $("#answer-c").css("background", "");
    $("#answer-d").css("background", "");

    submitButton();

    answering = true;
    getQuiz(correctlyAnswered);
}

function submitButton() {
    $("#quizbutton").html("");
    var submitButton = document.createElement("input");
    submitButton.value = "Submit";
    submitButton.name = "submit";
    submitButton.classList.add("quiz-button");
    submitButton.onclick = function () {
        submit();
    };
    document.getElementById("quizbutton").appendChild(submitButton);
}

function nextButton() {
    $("#quizbutton").html("");
    var nextButton = document.createElement("input");
    nextButton.value = "Next";
    nextButton.name = "next";
    nextButton.classList.add("quiz-button");
    nextButton.onclick = function () {
        nextQuestion();
    };
    document.getElementById("quizbutton").appendChild(nextButton);
}

function againButton() {
    var againButton = document.createElement("input");
    againButton.value = "Again";
    againButton.name = "again";
    againButton.classList.add("quiz-button");
    againButton.onclick = function () {
        window.location = "quiz.php";
    };
    document.getElementById("result-text").appendChild(againButton);
}