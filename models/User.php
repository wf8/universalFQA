<?php
class User {

	/*
	 * constructor
	 */
	public function __construct() {
		require('../config/config.php');
		$connection = mysql_connect($db_server, $db_username, $db_password);
		if (!$connection) 
			die('Not connected : ' . mysql_error());
		$db_selected = mysql_select_db($db_database);
		if (!$db_selected) 
			die ('Database error: ' . mysql_error());
	}

	/*
	 * function to login users
	 */
    public function login($email, $login_password) {
	
		$query = "SELECT * FROM user WHERE email = '$email';";
		$result = mysql_query($query);
		if(mysql_num_rows($result) < 1) {
			//no such user exists 
			echo "Login or password incorrect.";
			die();
		}
		$userData = mysql_fetch_assoc($result);
		$hash = hash('sha256', $userData['salt'] . hash('sha256', $login_password) );
		if($hash != $userData['password']) {
			//incorrect password
			echo "Login or password incorrect.";
			die();
		} else {
			// regen session id as security measure
			session_regenerate_id (); 
			//set the session data for this user
			$_SESSION['valid'] = 1;
			$_SESSION['email'] = $email;
			$_SESSION['user_id'] = $userData['id'];
			$_SESSION['admin'] = $userData['admin'];
			$_SESSION['editor'] = $userData['editor'];
			$_SESSION['first_name'] = $userData['first_name'];
			$_SESSION['last_name'] = $userData['last_name'];
		}
		echo "success login:" . $userData['id'];			 
    }
    
	/*
	 * function to register new users and then login them in
	 */
    public function register($email, $first_name, $last_name, $pass1, $pass2) {
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
					$result = mysql_query($query);
					if (!$result) 
						echo 'Database error: ' . mysql_error();
					else {
						// now login the user
						// first get the new user id
						$query = "SELECT * FROM user WHERE email = '$email'";
						$result = mysql_query($query);
						$userData = mysql_fetch_assoc($result);
						// set the session variables
						// first regen session id as security measure
						session_regenerate_id (); 
						//set the session data for this user
						$_SESSION['valid'] = 1;
						$_SESSION['email'] = $email;
						$_SESSION['user_id'] = $userData['id'];
						$_SESSION['admin'] = $userData['admin'];
						$_SESSION['editor'] = $userData['editor'];
						$_SESSION['first_name'] = $first_name;
						$_SESSION['last_name'] = $last_name;
						echo "success";
					}
				}
			}
		}
	}
	
	/*
	 * function to send forgot password email
	 */
    public function email_forgot_password($email) {
		if ($email == '') {
			echo 'Please enter your email address.';
			exit;
		}
		// check to see if email address exists
		$sql = "SELECT * FROM user WHERE email='$email'";
		$result = mysql_query($sql);
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
		$sql = "UPDATE user SET password='$hash', salt='$salt' WHERE email='$email'";
		$result = mysql_query($sql);
		if (!$result) {
			echo 'Database error: ' . mysql_error();
		} else {
			mail($email, "Universal FQA: Password retrieval", " Your temporary password is: " . $temp_password . " \r\n Please login and set a new password. \r\n http://universalFQA.org");
			echo "success";
		}
    }
    
    /*
	 * function update user account info
	 */
    public function change_user_info($email, $first_name, $last_name, $pass1, $pass2) {

		// check that the 2 passwords are the same
		if($pass1 != $pass2) 
			echo "The passwords don't match. Please try again.";
		else {
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
			
			$user_id = $_SESSION['user_id'];
			$query = "UPDATE user SET first_name='$first_name', last_name='$last_name', email='$email', password='$hash', salt='$salt' WHERE id='$user_id'";
			$result = mysql_query($query);
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
	}
}
?>
