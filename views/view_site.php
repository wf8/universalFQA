<?php
session_start(); 
require('fqa_config.php');
if( !$_SESSION['valid'] ) {
	header( "Location: login.php" );
	exit;
} 
$this->db_link = mysql_connect($db_server, $db_username, $db_password);
if (!$this->db_link) 
	die('Not connected : ' . mysql_error());
$db_selected = mysql_select_db($db_database);
if (!$db_selected) 
	die ('Database error: ' . mysql_error());
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Universal FQA Calculator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="../css/fqa.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic' rel='stylesheet' type='text/css'>    
    
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
            			<li><a href="view_assessments.php">Assessments</a></li>
            			<li><a href="view_databases.php">FQA Databases</a></li>
            			<li><a href="view_account.php">Account Info</a></li>
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
					<img src="/assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Site: Somme Prairie Grove</h1>
					<button class="btn btn-info" onclick="javascript:window.location = 'edit_site.php';return false;">Edit Site</button>
					<button class="btn btn-info" onClick="asdf_changes();">Download Site Assessments Summary</button> 
					<button class="btn btn-info" onclick="javascript:window.history.back(-1);return false;">Done</button>
				</div>
			</div>
			<br><br>
			<div class="row-fluid">	
				<div class="span4">	
					Northbrook<br>
					Cook, Illinois, USA<br>
					<br><br>
				</div>
				<div class="span8">
					Location:<br>
					Notes:<br>
				</div>
			</div>
		</div>
    </div> 
    <br><br>
	<footer class="footer">
		<div class="container">
			<p><a href="http://universalFQA.org">universalFQA.org</a> | <a href="../about.html">About this site</a></p>
		</div>
	</footer>
  </body>
</html>