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
					<h1>Edit Inventory Assessment</h1>
					<button class="btn btn-info" onclick="javascript:window.location = 'view_inventory.php';return false;">Save Changes and View Results</button> 
					<button class="btn btn-info" onclick="javascript:window.history.back(-1);return false;">Cancel</button><br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<label class="small-text">Inventory Name: <font class="red">*</font></label>
					<input class="field" type="text" id="change_first_name" value="Coyote Hill 1" maxlength="256" required />
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<p>
					<label class="small-text">Month: </label>
					<select>
  						<option>1</option>
  						<option>2</option>
  						<option>3</option>
  						<option>4</option>
  						<option>5</option>
  						<option>6</option>
  						<option selected>7</option>
  						<option>8</option>
  						<option>9</option>
  						<option>10</option>
  						<option>11</option>
  						<option>12</option>
					</select>
					<label class="small-text">Day: </label>
					<select>
  						<option selected>23</option>
					</select>
					<label class="small-text">Year: </label>
					<select>
  						<option selected>2010</option>
					</select>
				</div>	
				<div class="span6">
					<label class="small-text">Site: </label>
					<select>
  						<option>Somme Prairie Grove</option>
  						<option>Harms Woods</option>
  						<option>Deer Grove</option>
					</select>			
					<br>	
					<button class="btn btn-info" onclick="javascript:window.location = 'edit_site.php';return false;">Edit Selected Site</button>
					<button class="btn btn-info" onclick="javascript:window.location = 'edit_site.php';return false;">Create New Site</button>
				</div>		
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<label class="small-text">Practitioner:</label>
					<input class="field" type="text" id="change_first_name" value="Stephen and crew" maxlength="256" /><br>
 					<label class="small-text">Latitude:</label>
					<input class="field" type="text" id="change_first_name" value="" maxlength="256" /><br>
 					<label class="small-text">Longitude:</label>
					<input class="field" type="text" id="change_first_name" value="" maxlength="256" /><br>
					<br>
					<label class="radio">
  						<input type="radio" name="publicOrPrivate" id="public_inventory" value="public">
  						Public (viewable by any users of this site)
					</label>
					<label class="radio">
  						<input type="radio" name="publicOrPrivate" id="private_inventory" value="private" checked>
  						Private (viewable only by you)
					</label>
 				</div>
 				<div class="span6">
 					<label class="small-text">Weather Notes:</label>
					<textarea rows="3" id="site_location3">Perfect breezy summer day, with storms on the horizon.</textarea><br>
 					<label class="small-text">Duration Notes:</label>
					<textarea rows="3" id="site_location3"></textarea><br>
 					<label class="small-text">Community Type Notes:</label>
					<textarea rows="3" id="site_location4"></textarea><br>
 					<label class="small-text">Other Notes:</label>
					<textarea rows="3" id="site_location5"></textarea><br>
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
					<label class="small-text">Search by Scientific Name:</label>
					<div class="input-append">
 					 	<input class="input-medium" id="appendedInputButton" type="text">
  						<button class="btn btn-info" type="button">Add</button>
					</div>
				</div>
				<div class="span4">
					<label class="small-text">Search by Acronym:</label>
 					<div class="input-append">
 					 	<input class="input-medium" id="appendedInputButton" type="text">
  						<button class="btn btn-info" type="button">Add</button>
					</div>
				</div>
				<div class="span4">
					<label class="small-text">Search by Common Name:</label>
					<div class="input-append">
 					 	<input class="input-medium" id="appendedInputButton" type="text">
  						<button class="btn btn-info" type="button">Add</button>
					</div>
				</div>	
			</div>
			<div class="row-fluid">
				<div class="span12">
				<h4>To Add Species In Bulk:</h4>
				List each species separated by a comma. For example: "Acorus calamus, Alisma subcordatum, Anemone virginiana, etc." Species not found will be ignored.<br>
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
<td><strong>Nativity</strong></td>
<td><strong>C</strong></td>
<td><strong>W</strong></td>
<td><strong>Wetland Status</strong></td>
<td><strong>Physiognomy</strong></td>
<td><strong>Duration</strong></td>
<td><strong>Common Name</strong></td>
</tr>                    
<tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Alisma subcordatum</td>
<td>n/a</td>
<td>ALISUB</td>
<td>Native</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Alisma subcordatum</td>
<td>n/a</td>
<td>ALISUB</td>
<td>Native</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Alisma subcordatum</td>
<td>n/a</td>
<td>ALISUB</td>
<td>Native</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr><tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Alisma subcordatum</td>
<td>n/a</td>
<td>ALISUB</td>
<td>Native</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr><tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Alisma subcordatum</td>
<td>n/a</td>
<td>ALISUB</td>
<td>Native</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr><tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Alisma subcordatum</td>
<td>n/a</td>
<td>ALISUB</td>
<td>Native</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr><tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Acorus calamus</td>
<td>n/a</td>
<td>ACOCAL</td>
<td>Native</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td><input type="checkbox" id="checkbox1" value="option1"></td>
<td>Alisma subcordatum</td>
<td>n/a</td>
<td>ALISUB</td>
<td>Native</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr>
</table>
<button class="btn btn-info" onclick="javascript:window.location = 'view_site.php';return false;">Remove Selected Species</button>
				</div>
			</div>
			<br><br>
			<div class="row-fluid">
				<div class="span12">				
					<h4>Finished making changes?</h4>
					<button class="btn btn-info" onclick="javascript:window.location = 'view_inventory.php';return false;">Save Changes and View Results</button> 
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
