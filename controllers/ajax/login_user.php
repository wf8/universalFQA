<?php
$user = new User;
$user->login(mysql_real_escape_string($_POST['email']), $_POST['password']);
?>