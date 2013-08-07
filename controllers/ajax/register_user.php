<?php
require('../config/db_config.php');
$db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
if (mysqli_connect_errno($db_link)) {
	error_log("Failed to connect to MySQL: " . mysqli_connect_error());
}
// retrieve our data from POST
$email = mysqli_real_escape_string($db_link,$_POST['email']);
$first_name = mysqli_real_escape_string($db_link,$_POST['first_name']);
$last_name = mysqli_real_escape_string($db_link,$_POST['last_name']);
$pass1 = $_POST['password1'];
$pass2 = $_POST['password2'];
$user = new User;
$user->register($email, $first_name, $last_name, $pass1, $pass2);
?>