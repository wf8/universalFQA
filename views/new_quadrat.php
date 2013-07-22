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
					<img src="../assets/images/blue-eyed.jpg" width="70" height="105" class="img-rounded">
					<br><br>
				</div>
				<div class="span11">
					<br>
					<h1>New Quadrat</h1>
					<button class="btn btn-info" onclick="javascript:window.history.back(-1);return false;">Save</button> 
					<button class="btn btn-info" onclick="javascript:window.history.back(-1);return false;">Cancel</button><br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<label class="small-text">Quadrat Number or Name: <font class="red">*</font></label>
					<input class="field" type="text" id="change_first_name" value="" maxlength="256" required />
 					<label class="small-text">Latitude:</label>
					<input class="field" type="text" id="change_first_name" value="" maxlength="256" /><br>
 					<label class="small-text">Longitude:</label>
					<input class="field" type="text" id="change_first_name" value="" maxlength="256" /><br>
					<label class="small-text">% Bare Ground:</label>
					<input class="field" type="text" id="change_first_name" value="" maxlength="256" /><br>
 					<label class="small-text">% Water:</label>
					<input class="field" type="text" id="change_first_name" value="" maxlength="256" /><br>						
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
				<h3>FQA Database: Chicago, 1994</h3>
				<br>
				<h4>To Add Species Individually:</h4>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<form class="form-inline">
						<input class="input-medium" id="appendedInputButton" type="text" placeholder="Scientific Name">
						<div class="input-append">
							<input class="input-mini" id="appendedInputButton" type="text" placeholder="% Cover">
							<button class="btn btn-info" type="button">Add</button>
						</div>
					</form>
				</div>
				<div class="span4">
					<form class="form-inline">
						<input class="input-medium" id="appendedInputButton" type="text" placeholder="Acronym">
						<div class="input-append">
							<input class="input-mini" id="appendedInputButton" type="text" placeholder="% Cover">
							<button class="btn btn-info" type="button">Add</button>
						</div>
					</form>
				</div>
				<div class="span4">
					<form class="form-inline">
						<input class="input-medium" id="appendedInputButton" type="text" placeholder="Common Name">
						<div class="input-append">
							<input class="input-mini" id="appendedInputButton" type="text" placeholder="% Cover">
							<button class="btn btn-info" type="button">Add</button>
						</div>
					</form>
				</div>	
			</div>
			<div class="row-fluid">
				<div class="span12">
				<h4>To Add Species In Bulk:</h4>
				List each species separated by a comma. For example: "Acorus calamus, Alisma subcordatum, Anemone virginiana, etc."<br>
				<textarea class="input-xxlarge" rows="3" id="items_location7"></textarea><br>
				<button class="btn btn-info" type="button">Add Species</button><br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<h4>To Remove Species:</h4>
					Select the species to remove and click remove at the bottom of the list.<br>
					<br>
					<table class="table table-hover">
<tr>
<td></td>
<td><strong>Scientific Name</strong></td>
<td><strong>Family</strong></td>
<td><strong>Acronym</strong></td>
<td><strong>% Cover</strong></td>
<td><strong>Nativity</strong></td>
<td><strong>C</strong></td>
<td><strong>W</strong></td>
<td><strong>Wetland Status</strong></td>
<td><strong>Physiognomy</strong></td>
<td><strong>Duration</strong></td>
<td><strong>Common Name</strong></td>
</tr> 
<tr><td colspan=12>You have not added any species yet.</td></tr>   
<!--                 
<tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td><input class="input-mini" id="percentCover" type="text" value="23"></td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
-->
</table>
				<button class="btn btn-info" onclick="javascript:window.location = 'view_site.php';return false;">Remove Selected Species</button>
				</div>
			</div>
			<br><br>
			<div class="row-fluid">
				<div class="span12">				
					<h4>Finished?</h4>
					<button class="btn btn-info" onclick="javascript:window.history.back(-1);return false;">Save</button> 
					<button class="btn btn-info" onclick="javascript:window.history.back(-1);return false;">Cancel</button><br>
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
