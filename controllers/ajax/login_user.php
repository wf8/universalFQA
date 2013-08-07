<?php
$user = new User;
$user->login(mysqli_real_escape_string($db_link, $_POST['email']), $_POST['password']);
?>