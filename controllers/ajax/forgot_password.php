<?php
$user = new User;
$user->email_forgot_password(mysql_real_escape_string($_POST['email']));
?>