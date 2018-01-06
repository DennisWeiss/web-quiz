var username_ptn = /^[A-Za-z][A-Za-z0-9]{4,20}$/;
var email_ptn = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

$(document).ready(function () {
    $("#submit-register").click(function () {
        console.log("clicked");
        var username = $("#username").val();
        var email = $("#email").val();
        var pw1 = $("#pw1").val();
        var pw2 = $("#pw2").val();
        if (verifyInput(username, email, pw1, pw2)) {
            $.post("register.php", {register: "", username: username, email: email, pw1: pw1}, function (data, status) {
                var newDoc = document.open("text/html", "replace");
                newDoc.write(data);
                newDoc.close();
            });
        }
    });
});

function verifyInput(username, email, pw1, pw2) {
    if (!username.match(username_ptn)) {
        $("#register").append("<br>Username must only contain letters and numbers and must start with a letter!");
        return false;
    }
    if (!email.match(email_ptn)) {
        $("#register").append("<br>That is not a valid email-address!");
        return false;
    }
    if (pw1 != pw2) {
        $("#register").append("<br>Passwords do not match!");
        return false;
    }
    if (pw1.length < 8) {
        $("#register").append("<br>The password needs to be at least 8 characters long.");
        return false;
    }
    if (pw1 == username) {
        $("#register").append("<br>The password must not equal your username!");
        return false;
    }
    return true;
}