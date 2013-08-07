<?php
$user = new User;
$user->email_forgot_password(mysqli_real_escape_string($db_link, $_POST['email']));
?>