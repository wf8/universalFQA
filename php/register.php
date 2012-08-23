<?php
session_start();
require('fqa_config.php');

// connect to MySQL database
$connection = mysql_connect($db_server, $db_username, $db_password);
if (!$connection) 
	die('Not connected : ' . mysql_error());	


// set the active MySQL database.
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
    echo "Passwords are not the same. User not added.";
else
{

	// check that email is valid

	// get salt and hash
	$temp_string = md5(uniqid(rand(), true));
	$salt = substr($temp_string, 0, 3);
	$hash = hash('sha256', $pass1);
	$hash = hash('sha256', $salt . $hash);
											
	//sanitize user input
	$email = mysql_real_escape_string($email);
	$first_name = mysql_real_escape_string($first_name);
	$last_name = mysql_real_escape_string($last_name);
	
	// check if there is already a user registered to that email address
	$query = "SELECT * FROM user WHERE email = '$email'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) > 0) 
	 	echo "There is already a user registered with that email address.";
	else {
		// check for user already registered with the same name
		$query = "SELECT * FROM user WHERE first_name = '$first_name' AND last_name = '$last_name'";
		$result = mysql_query($query);
		if (mysql_num_rows($result) > 0) 
  			echo "There is already a user registered with that name.";
  		else {
  			// finally insert the new user into database
			$query = "INSERT INTO user (email, first_name, last_name, password, salt) VALUES ('$email', '$first_name', '$last_name', '$hash', '$salt')";
			$result = mysql_query($query, $connection);
			if (!$result) 
		  		echo 'Error: ' . mysql_error();
		  	else {
		  		// now login the user
				// first get the new user id
				$query = "SELECT id FROM user WHERE email = '$email'";
				$result = mysql_query($query);
				$userData = mysql_fetch_assoc($result);
				// set the session variables
		  		// first regen session id as security measure
				session_regenerate_id (); 
				//set the session data for this user
		    	$_SESSION['valid'] = 1;
		    	$_SESSION['email'] = $email;
		    	$_SESSION['user_id'] = $userData['id'];
		    //	$_SESSION['admin'] = $userData['admin'];
		    	$_SESSION['first_name'] = $first_name;
		    	$_SESSION['last_name'] = $last_name;
		  			
				echo "success";
		  	}
  		}
 	}
}
?>