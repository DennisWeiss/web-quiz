$(document).ready(function () {
    $("#submit-reset").click(function () {
        var pw1 = $("#pw1").val();
        var pw2 = $("#pw2").val();
        if (verifyInput(pw1, pw2)) {
            console.log('send');
            $.post("change-pw.php", {pw1: pw1}, function (data, status) {
                $("#register").html(data);
            });
        }
    });
});

function verifyInput(pw1, pw2) {
    if (pw1 != pw2) {
        $("#register").append("<br>Passwords do not match!");
        return false;
    }
    if (pw1.length < 8) {
        $("#register").append("<br>The password needs to be at least 8 characters long.");
        return false;
    }
    return true;
}