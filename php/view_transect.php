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
					<h1>Transect Assessment</h1>
					<button class="btn btn-info" onclick="javascript:window.location = 'edit_transect.php';return false;">Edit This Transect</button>
					<button class="btn btn-info" onClick="asdf_changes();">Download Report</button> 
					<button class="btn btn-info" onclick="javascript:window.location = 'assessments.php';return false;">Done</button>
					<br>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<h2>Pothole Pond</h2>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<h4>&#187; Date & Location:</h4>
					6/28/2013<br>
					Somme Prairie Grove<br>
					Northbrook<br>
					Cook, Illinois, USA<br>					
				</div>	
				<div class="span6">
					<h4>&#187; FQA Database:</h4>
					Region: Chicago<br>
					Year Published: 1994<br>
					Description: Swink and Wilhelm
				</div>		
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<h4>&#187; Details:</h4>			
					Practitioner: Stephen and crew<br>
 					Latitude:<br>
 					Longitude:<br>
					Weather Notes: Perfect breezy summer day, with storms on the horizon.<br>
 					Duration Notes:<br>
 					Community Type Notes:<br>
 					Other Notes:<br>
 					This assessment is private (viewable only by you).<br>
 				</div>
 			</div>
			<br>
			<div class="row-fluid">
				<div class="span3">
					<h4>&#187; Conservatism-Based Metrics:</h4>
					Total Mean C: <strong>4.5</strong><br>
					Native Mean C: <strong>5.5</strong><br>
					Native Tree Mean C: <strong>5.5</strong><br>
					Native Shrub Mean C: <strong>5.5</strong><br>
					Native Herbaceous Mean C: <strong>5.5</strong><br>
					Total FQI: <strong>30.5</strong><br>
					Native FQI: <strong>45.5</strong><br>
					Cover-weighted FQI: <strong>30.5</strong><br>
					Cover-weighted Native FQI: <strong>45.5</strong><br>
					Adjusted FQI: <strong>45.5</strong><br>
					% C value 0-3:  <strong>0%</strong><br>
					% C value 4-6:  <strong>0%</strong><br>
					% C value 7-10:  <strong>0%</strong><br>
				</div>
				<div class="span3">	
					<h4>&#187; Species Richness and Wetness:</h4>
					Total Species: <strong>44</strong><br>
					Native Species: <strong>37 (84.1%)</strong><br>
					Non-native Species: <strong>7 (15.9%)</strong><br>
					Mean Wetness: <strong>-2</strong><br>
					Native Mean Wetness: <strong>-2</strong><br>
				</div>
				<div class="span3">
					<h4>&#187; Physiognomy Metrics:</h4>
					Tree: <strong>0 (0.0%)   </strong><br>
					Shrub: <strong>1     (2.3%) </strong><br>    
					Vine: <strong>1     (2.3%)  </strong><br>
					Forb: <strong>22    (50.0%)      </strong><br>
					Grass: <strong>6    (13.6%) </strong><br>
					Sedge: <strong>7    (15.9%) </strong><br>
					Rush: <strong>0     (0.0%) </strong><br>
					Fern: <strong>0     (0.0%) </strong><br>
					Other: <strong>0     (0.0%)      </strong><br>  
				</div>
				<div class="span3">
					<h4>&#187; Duration Metrics:</h4>
					Annual: <strong>22 (50.0%)</strong><br>
					Perennial: <strong>22 (50.0%)</strong><br>
					Biennial: <strong>0 (0.0%)</strong><br>
					<br>	
					Native Annual: <strong>22 (50.0%)</strong><br>
					Native Perennial: <strong>22 (50.0%)</strong><br>
					Native Biennial: <strong>0 (0.0%)</strong><br>
				</div>	
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">
					<h4>&#187; Quadrat Level Metrics:</h4>

<table class="table table-hover">
<tr>
<td><strong>Quadrat</strong></td>
<td><strong>Species Richness</strong></td>
<td><strong>Native Species Richness</strong></td>
<td><strong>Total Mean C</strong></td>
<td><strong>Native Mean C</strong></td>
<td><strong>Total FQI</strong></td>
<td><strong>Native FQI</strong></td>
<td><strong>Cover-weighted FQI</strong></td>
<td><strong>Cover-weighted Native FQI</strong></td>
<td><strong>Adjusted FQI</strong></td>
<td><strong>Mean Wetness</strong></td>
<td><strong>Mean Native Wetness</strong></td>
<td><strong>Latitude</strong></td>
<td><strong>Longitude</strong></td>
</tr>                    
<tr>
<td>1</td>
<td>5</td>
<td>4</td>
<td>6</td>
<td>7</td>
<td>56</td>
<td>67</td>
<td>56</td>
<td>67</td>
<td>67</td>
<td>-2</td>
<td>-2</td>
<td>n/a</td>
<td>n/a</td>
</tr>
<tr>
<td>2</td>
<td>5</td>
<td>4</td>
<td>6</td>
<td>7</td>
<td>56</td>
<td>67</td>
<td>56</td>
<td>67</td>
<td>67</td>
<td>-2</td>
<td>-2</td>
<td>n/a</td>
<td>n/a</td>
</tr>
<tr>
<td>3</td>
<td>5</td>
<td>4</td>
<td>6</td>
<td>7</td>
<td>56</td>
<td>67</td>
<td>56</td>
<td>67</td>
<td>67</td>
<td>-2</td>
<td>-2</td>
<td>n/a</td>
<td>n/a</td>
</tr>
<tr>
<td>4</td>
<td>5</td>
<td>4</td>
<td>6</td>
<td>7</td>
<td>56</td>
<td>67</td>
<td>56</td>
<td>67</td>
<td>67</td>
<td>-2</td>
<td>-2</td>
<td>n/a</td>
<td>n/a</td>
</tr>
</table>

				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<h4>&#187; Quadrat 1 Species:</h4>
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
</tr>                    
<tr>
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
</table>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<h4>&#187; Quadrat 2 Species:</h4>
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
</tr>                    
<tr>
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
</table>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<h4>&#187; Quadrat 3 Species:</h4>
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
</tr> 
<tr>
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
</table>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<h4>&#187; Quadrat 4 Species:</h4>
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
</tr> 
<tr>
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
