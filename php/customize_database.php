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
					<img src="../images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>Customize Public FQA Database</h1>
					<button class="btn btn-info" onclick="javascript:window.location = 'databases.php';return false;">Save</button>
					<button class="btn btn-info" onclick="javascript:window.location = 'databases.php';return false;">Cancel</button>
					<br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<h4>&#187; Customized Database Details:</h4>
					<label class="small-text">Customized Database Name: <font class="red">*</font></label>
					<input class="field" type="text" id="change_first_name" value="" maxlength="256" required />
					<label class="small-text">Customized Database Description: <font class="red">*</font></label>
					<input class="field" type="text" id="change_first_name" value="" maxlength="256" required />
				</div>
				<div class="span6">
					<h4>&#187; Original Database Details:</h4>
					Region: Chicago<br>
					Year Published: 1994<br>
					Description: Swink and Wilhelm
				</div>	
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<h4>&#187; Species:</h4>
					<table class="table table-hover">
<tr>
<td><strong>Scientific Name</strong></td>
<td><strong>Family</strong></td>
<td><strong>Acronym</strong></td>
<td><strong>Nativity</strong></td>
<td><strong>C</strong></td>
<td><strong>W</strong></td>
<td><strong>Wetland Status</strong></td>
<td><strong>Physiognomy</strong></td>
<td><strong>Duration</strong></td>
<td><strong>Common Name</strong></td>
<td><strong>Options</strong></td>
</tr> 
<tr>
<td><input class="input-mini" id="percentCover" type="text" value=""></td>
<td><input class="input-mini" id="percentCover" type="text" value=""></td>
<td><input class="input-mini" id="percentCover" type="text" value=""></td>
<td><input class="input-mini" id="percentCover" type="text" value=""></td>
<td><input class="input-mini" id="percentCover" type="text" value=""></td>
<td><input class="input-mini" id="percentCover" type="text" value=""></td>
<td><input class="input-mini" id="percentCover" type="text" value=""></td>
<td><input class="input-mini" id="percentCover" type="text" value=""></td>
<td><input class="input-mini" id="percentCover" type="text" value=""></td>
<td><input class="input-mini" id="percentCover" type="text" value=""></td>
<td><a href="javascript">Add</a></td>
</tr>                   
<tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr>
<tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr>
<tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr>
<tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr><tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr>
<tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr><tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr>
<tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr><tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr>
<tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr><tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr>
<tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr><tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr>
<tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr><tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr>
<tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr><tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr>
<tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr><tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr>
<tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr><tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr>
<tr>
<td><input class="input-mini" id="percentCover" type="text" value="Acorus calamus"></td>
<td><input class="input-mini" id="percentCover" type="text" value="n/a"></td>
<td><input class="input-mini" id="percentCover" type="text" value="ACOCAL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Native"></td>
<td><input class="input-mini" id="percentCover" type="text" value="7"></td>
<td><input class="input-mini" id="percentCover" type="text" value="-5"></td>
<td><input class="input-mini" id="percentCover" type="text" value="OBL"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Forb"></td>
<td><input class="input-mini" id="percentCover" type="text" value="Perennial"></td>
<td><input class="input-mini" id="percentCover" type="text" value="SWEET FLAG"></td>
<td><a href="javascript">Delete</a></td>
</tr>


</table>						
				</div>
			</div>
			<br><br>
			<div class="row-fluid">
				<div class="span12">				
					<h4>Finished?</h4>
					<button class="btn btn-info" onclick="javascript:window.location = 'databases.php';return false;">Save</button> 
					<button class="btn btn-info" onclick="javascript:window.location = 'databases.php';return false;">Cancel</button><br>
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
