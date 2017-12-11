<?php
include "config.php";
include "sendmail.php";

if (isset($_POST['email'])) {

}
?>
<html>
<head>
    <title>Reset your password</title>
</head>
<body>
    <form action="reset-pw.php" method="post">
        <input type="text" value="email" placeholder="Enter your e-mail address">
        <input type="submit" value="Submit">
    </form>
</body>
</html>
