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
					<h1>Your Assessments</h1>
					<button class="btn btn-info" onclick="javascript:window.location = 'new_inventory.php';return false;">New Inventory</button>
					<button class="btn btn-info" onclick="javascript:window.location = 'new_transect.php';return false;">New Transect</button>
					<button class="btn btn-info" onclick="javascript:window.location = 'new_transect.php';return false;">Download Summary</button>
					<button class="btn btn-info" onclick="javascript:window.location = 'public_assessments.php';return false;">View All Public Assessments</button>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<h2>Your Inventory Assessments</h2>
					<table class="table table-hover">
						<!-- <tr>
							<td>You have not made any inventory assessments.</td> 
						</tr> -->
						<tr>
							<td><strong>Name</strong></td>
							<td><strong>Date</strong></td>
							<td><strong>Site</strong></td>
							<td><strong>Native FQI</strong></td>
							<td><strong>Public / Private</strong></td>
							<td><strong>Options</strong></td>							
						</tr>
						<tr>
							<td><a href="view_inventory.php?assessment=1">Coyote Hill 1</a></td>
							<td>7/23/2010</td>
							<td><a href="view_site.php?site=1">Somme Prairie Grove</a></td>
							<td>45.5</td>
							<td>Private</td>
							<td><a href="view_inventory.php">View</a> | <a href="edit_inventory.php">Edit</a> | <a href="download_inventory.php">Download</a> | <a href="delete_inventory.php">Delete</a></td>
						</tr>
						<tr>
							<td><a href="view_inventory.php?assessment=1">Coyote Hill 2</a></td>
							<td>6/9/2013</td>
							<td><a href="view_site.php?site=1">Somme Prairie Grove</a></td>
							<td>51.5</td>
							<td>Public</td>
							<td><a href="view_inventory.php">View</a> | <a href="edit_inventory.php">Edit</a> | <a href="download_inventory.php">Download</a> | <a href="delete_inventory.php">Delete</a></td>
						</tr>
					</table>
					<h2>Your Transect Assessments</h2>
					<table class="table table-hover">
						<!-- <tr>
							<td>You have not made any transect assessments.</td> 
						</tr> -->
						<tr>
							<td><strong>Name</strong></td>
							<td><strong>Date</strong></td>
							<td><strong>Site</strong></td>
							<td><strong>Native FQI</strong></td>
							<td><strong>Public / Private</strong></td>
							<td><strong>Options</strong></td>							
						</tr>
						<tr>
							<td><a href="view_transect.php?assessment=1">Pothole Pond</a></td>
							<td>6/8/2013</td>
							<td><a href="view_site.php?site=1">Somme Prairie Grove</a></td>
							<td>40.0</td>
							<td>Private</td>
							<td><a href="view_transect.php">View</a> | <a href="edit_transect.php">Edit</a> | <a href="download_transect.php">Download</a> | <a href="delete_transect.php">Delete</a></td>
						</tr>
					</table>
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
