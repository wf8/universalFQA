<?php
session_start();
require('../fqa_config.php');

if( !$_SESSION['valid'] ) {
	exit;
} 

$connection = mysql_connect($db_server, $db_username, $db_password);
if (!$connection) 
	die('Not connected : ' . mysql_error());	
$db_selected = mysql_select_db($db_database, $connection);
if (!$db_selected) 
	die ('Can\'t use db : ' . mysql_error());

// retrieve our data from POST
$email = $_POST['email'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$pass1 = $_POST['password1'];
$pass2 = $_POST['password2'];

// check that the 2 passwords are the same
if($pass1 != $pass2) 
    echo "The passwords don't match. Please try again.";
else
{
	// check that variables are right length
	if(strlen($email) < 3) {
		echo "Please enter a valid email address.";
		exit;
	} else if(strlen($first_name) < 1) {
		echo "Please enter a first name.";
		exit;
	} else if(strlen($last_name) < 1) {
		echo "Please enter a last name.";
		exit;
	} else if(strlen($pass1) < 5) {
		echo "Please use a longer password.";
		exit;
	} 

	// check that email is valid....

	// get salt and hash
	$temp_string = md5(uniqid(rand(), true));
	$salt = substr($temp_string, 0, 3);
	$hash = hash('sha256', $pass1);
	$hash = hash('sha256', $salt . $hash);
											
	// sanitize user input
	$email = mysql_real_escape_string($email);
	$first_name = mysql_real_escape_string($first_name);
	$last_name = mysql_real_escape_string($last_name);
	
	$user_id = $_SESSION['user_id'];
	$query = "UPDATE user SET first_name='$first_name', last_name='$last_name', email='$email', password='$hash', salt='$salt' WHERE id='$user_id'";
	$result = mysql_query($query, $connection);
	if (!$result) {
		echo 'Database error: ' . mysql_error();
		exit;
	} else {
		$_SESSION['email'] = $email;
		$_SESSION['first_name'] = $first_name;
		$_SESSION['last_name'] = $last_name;
		echo "success";
		exit;
	}
}
?>