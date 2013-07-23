<?php
// retrieve our data from POST
$email = mysql_real_escape_string($_POST['email']);
$first_name = mysql_real_escape_string($_POST['first_name']);
$last_name = mysql_real_escape_string($_POST['last_name']);
$pass1 = $_POST['password1'];
$pass2 = $_POST['password2'];
$user = new User;
$user->change_user_info($email, $first_name, $last_name, $pass1, $pass2);
?>