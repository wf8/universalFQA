<?php
require('fqa_config.php');

$connection = mysql_connect($db_server, $db_username, $db_password);
if (!$connection) 
	die('Not connected : ' . mysql_error());	
$db_selected = mysql_select_db($db_database, $connection);
if (!$db_selected) 
	die ('Can\'t use db : ' . mysql_error());

// retrieve email from POST
$email = $_POST['email'];
if ($email == '') {
	echo 'Please enter your email address.';
	exit;
}
// check to see if email address exists
$sql = "SELECT * FROM user WHERE email='$email'";
$result = mysql_query($query, $connection);
if (mysql_num_rows($result) == 0) {
	echo 'There is no account registered for that email address. Please register a new account.';
	exit;
}
// get salt and hash
$temp_password = uniqid();
$temp_string = md5(uniqid(rand(), true));
$salt = substr($temp_string, 0, 3);
$hash = hash('sha256', $temp_password);
$hash = hash('sha256', $salt . $hash);					
$query = "UPDATE user SET password='$hash', salt='$salt' WHERE email='$email'";
$result = mysql_query($query, $connection);
if (!$result) {
	echo 'Database error: ' . mysql_error();
	exit;
} else {
	mail($email, "Universal FQA: Password retrieval", " Your temporary password is: " . $temp_password . " \r\n Please login and set a new password. \r\n http://universalFQA.org");
	echo "success";
	exit;
}
?>