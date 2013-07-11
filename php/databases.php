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
					<h1>FQA Databases</h1>
					<button class="btn btn-info" onclick="javascript:window.location = 'new_database.php';return false;">Upload New Public FQA Database</button>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<h2>Public Databases</h2>
					<table class="table table-hover">
						<tr>
							<td><strong>Region</strong></td>
							<td><strong>Year Published</strong></td>
							<td><strong>Description</strong></td>
							<td><strong>Options</strong></td>
						</tr>
						<tr>
							<!-- <td>There are no FQA databases available.</td> -->
							<td><a href="view_database.php">Chicago</a></td>
							<td>1994</td>
							<td>Swink & Wilhelm</td>
							<td><a href="view_database.php">View</a> | <a href="customize_database.php">Customize</a> | <a href="download_database.php">Download</a></td>
						</tr>
						</tr>
						<tr>
							<td><a href="view_database.php">Chicago</a></td>
							<td>2013</td>
							<td>US Army Corps of Engineers</td>
							<td><a href="view_database.php">View</a> | <a href="customize_database.php">Customize</a> | <a href="download_database.php">Download</a></td>
						</tr>
						</tr>
					</table>
					<h2>Your Customized Databases</h2>
					<table class="table table-hover">
						<tr>
							<td><strong>Name</strong></td>
							<td><strong>Description</strong></td>
							<td><strong>Orginal FQA Database</strong></td>
							<td><strong>Options</strong></td>
						</tr>
						<tr>
							<!-- <td>You have not made any customized FQA databases.</td> -->
							<td><a href="edit_custom_database.php">My Custom Chi-town</a></td>
							<td>updated some taxonomy</td>
							<td>Chicago, 1994</td>
							<td><a href="edit_custom_database.php">Edit</a> | <a href="download_custom_database.php">Download</a> | <a href="delete_custom_database.php">Delete</a></td>

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