<?php
require('../config/db_config.php');
$db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
if (mysqli_connect_errno($db_link)) {
	error_log("Failed to connect to MySQL: " . mysqli_connect_error());
}

$user = new User;
$user->email_forgot_password(mysqli_real_escape_string($db_link, $_POST['email']));
?>