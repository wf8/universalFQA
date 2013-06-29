<?php
session_start(); 
require('fqa_config.php');
if( !$_SESSION['valid'] ) {
	header( "Location: login.php" );
	exit;
} 
$connection = mysql_connect($db_server, $db_username, $db_password);
if (!$connection) 
	die('Not connected : ' . mysql_error());
$db_selected = mysql_select_db($db_database, $connection);
if (!$db_selected) 
	die ('Database error: ' . mysql_error());
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Universal Floristic Quality Assessment Calculator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="../css/fqa.css" rel="stylesheet">
    
    <script src="../js/jquery-1.9.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/fqa.js"></script>
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
    	<div class="navbar-inner">
        	<div class="container">
          		<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
          		</button>
          		<a class="brand" href="../index.html">Universal FQA</a>
          		<div class="nav-collapse collapse pull-right">
            		<ul class="nav pull-right">
            			<li><a href="assessments.php">Assessments</a></li>
            			<li><a href="databases.php">FQA Databases</a></li>
            			<li><a href="account.php">Account Info</a></li>
            			<li><a href="../help.html">Help</a></li>
              			<li><a href="logout.php">Logout</a></li>
            		</ul>
          		</div>
        	</div>
      	</div>
    </div>
	<br>
    <div class="container padding-top">
		<div class="nice_margins">
			<div class="row-fluid">
				<div class="span1">
					<img src="../images/blue-eyed.jpg" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Account Info</h1>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<label class="small-text" for="signup">First name:</label>
					<input class="field" type="text" name="signup" id="change_first_name" value="<?php echo $_SESSION['first_name']; ?>" size="23" />
					<label class="small-text" for="signup">Last name:</label>
					<input class="field" type="text" name="signup" id="change_last_name" value="<?php echo $_SESSION['last_name']; ?>" size="23" />
					<label class="small-text" for="email">Email:</label>
					<input class="field" type="text" name="email" id="change_email" value="<?php echo $_SESSION['email']; ?>"size="23" />
					<label class="small-text" for="pwd">Password:</label>
					<input class="field" type="password" name="pwd" id="change_password1" value="" size="23" />
					<label class="small-text" for="pwd">Password (again):</label>
					<input class="field" type="password" name="pwd" id="change_password2" value="" size="23" /><br><br>
					<button class="btn btn-info" onClick="save_account_changes();">Save Changes</button> 
				</div>
			</div>
			<br><br>
		</div>
		<footer class="footer">
			<div class="container">
        		<p><a href="http://universalFQA.org">universalFQA.org</a> | <a href="../about.html">About this site</a></p>
      		</div>
      	</footer>
    </div> 
  </body>
</html>