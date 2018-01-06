var choice = '0';
var correctlyAnswered = 0;

$(document).ready(function () {
    var obj;

    $.post("getquiz.php", {getquiz: ""}, function(data, status) {
        console.log(data);
        obj = JSON.parse(data);
        $("#question-text").html(obj.question);
        $("#answer-a-text").html(obj.a);
        $("#answer-b-text").html(obj.b);
        $("#answer-c-text").html(obj.c);
        $("#answer-d-text").html(obj.d);
    });

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

    $("#submit").click( function () {
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
        }
    });
});

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