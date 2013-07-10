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
					<h1>Inventory Assessment</h1>
					<button class="btn btn-info" onclick="javascript:window.location = 'edit_inventory.php';return false;">Edit This Inventory</button>
					<button class="btn btn-info" onClick="asdf_changes();">Download Report</button> 
					<button class="btn btn-info" onclick="javascript:window.location = 'assessments.php';return false;">Done</button>
					<br>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<h2>Coyote Hill 1</h2>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<p>
					<h4>&#187; Date & Location:</h4>
					7/23/2010<br>
					Somme Prairie Grove<br>
					Northbrook<br>
					Cook, Illinois, USA<br>					
				</div>	
				<div class="span6">
					<h4>&#187; FQA Database:</h4>
					Region: Chicago<br>
					Year Published: 1994<br>
					Description: Swink and Wilhelm
					</p>
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
				<div class="span6">
					<p>
					<h4>&#187; Floristic Quality Data:</h4>
					Total Species: <strong>44</strong><br>
					Native Species: <strong>37 (84.1%)</strong><br>
					Non-native Species: <strong>7 (15.9%)</strong><br>
					Total Mean C: <strong>4.5</strong><br>
					Native Mean C: <strong>5.5</strong><br>
					Total FQI: <strong>30.5</strong><br>
					Native FQI: <strong>45.5</strong><br>
					Mean W: <strong>-2</strong><br>
					Mean Wetland Status: <strong>Facultative Wetland- (FACW-)</strong></p>
				</div>
				<div class="span3">
					<h4>&#187; Physiognomy Data:</h4>
					Tree: <strong>0 (0.0%)   </strong><br>
					Shrub: <strong>1     (2.3%) </strong><br>    
					Vine: <strong>1     (2.3%)  </strong><br>
					Forb: <strong>22    (50.0%)      </strong><br>
					Grass: <strong>6    (13.6%) </strong><br>
					Sedge: <strong>7    (15.9%) </strong><br>
					Fern: <strong>0     (0.0%) </strong><br>
					Other: <strong>0     (0.0%)      </strong><br>  
				</div>
				<div class="span3">
					<h4>&#187; Duration Data:</h4>
					Annual: <strong>22 (50.0%)</strong><br>
					Perennial: <strong>22 (50.0%)</strong><br>
					Biennial: <strong>0 (0.0%)</strong><br>			
				</div>	
			</div>
			<br>
			<div class="row-fluid">
				<div class="span12">	
					<table class="table table-hover">
<tr>
<td><strong>Scientific Name</strong></td>
<!-- <td><strong>Family</strong></td> -->
<td><strong>Acronym</strong></td>
<td><strong>Native?</strong></td>
<td><strong>C</strong></td>
<td><strong>W</strong></td>
<td><strong>Wetland Status</strong></td>
<td><strong>Physiognomy</strong></td>
<td><strong>Duration</strong></td>
<td><strong>Common Name</strong></td>
</tr>                    
<tr>
<td>Acorus calamus</td>
<td>ACOCAL</td>
<td>Yes</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td>Alisma subcordatum</td>
<td>ALISUB</td>
<td>Yes</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr>
<td>Acorus calamus</td>
<td>ACOCAL</td>
<td>Yes</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td>Alisma subcordatum</td>
<td>ALISUB</td>
<td>Yes</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr>
<td>Acorus calamus</td>
<td>ACOCAL</td>
<td>Yes</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td>Alisma subcordatum</td>
<td>ALISUB</td>
<td>Yes</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr>
<td>Acorus calamus</td>
<td>ACOCAL</td>
<td>Yes</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td>Alisma subcordatum</td>
<td>ALISUB</td>
<td>Yes</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr>
<td>Acorus calamus</td>
<td>ACOCAL</td>
<td>Yes</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td>Alisma subcordatum</td>
<td>ALISUB</td>
<td>Yes</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr>
<td>Acorus calamus</td>
<td>ACOCAL</td>
<td>Yes</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td>Alisma subcordatum</td>
<td>ALISUB</td>
<td>Yes</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>
<tr>
<td>Acorus calamus</td>
<td>ACOCAL</td>
<td>Yes</td>
<td>7</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>SWEET FLAG</td>
</tr>
<tr>
<td>Alisma subcordatum</td>
<td>ALISUB</td>
<td>Yes</td>
<td>4</td>
<td>-5</td>
<td>OBL</td>
<td>Forb</td>
<td>Perennial</td>
<td>COMMON WATER PLANTAIN </td>
</tr>

</table>
<!--                  
ALISUB     4 Alisma subcordatum                          -5 OBL      Nt P-Forb   COMMON WATER PLANTAIN          
ANEVIR     5 Anemone virginiana                           5 UPL      Nt P-Forb   TALL ANEMONE                   
ASCINC     4 Asclepias incarnata                         -5 OBL      Nt P-Forb   SWAMP MILKWEED                 
ASTLAT     4 Aster lateriflorus                          -2 FACW-    Nt P-Forb   SIDE-FLOWERING ASTER           
ASTUMB     9 Aster umbellatus                            -3 FACW     Nt P-Forb   FLAT-TOP ASTER                 
BROLAT     5 Bromus latiglumis                           -2 FACW-    Nt P-Grass  EAR-LEAVED BROME               
BROPUB     5 Bromus pubescens                             2 FACU+    Nt P-Grass  WOODLAND BROME                 
CXGRAY     7 Carex grayi                                 -4 FACW+    Nt P-Sedge  COMMON BUR SEDGE               
CXPELL     4 Carex pellita                               -5 OBL      Nt P-Sedge  BROAD-LEAVED WOOLLY SEDGE      
CXSHOR    10 Carex shortiana                              0 [FAC]    Nt P-Sedge  SHORT'S SEDGE                  
CXSQUA    10 Carex squarrosa                             -5 OBL      Nt P-Sedge  NARROW-LEAVED CATTAIL SEDGE    
CXVULP     2 Carex vulpinoidea                           -5 OBL      Nt P-Sedge  BROWN FOX SEDGE                
CICMAC     6 Cicuta maculata                             -5 OBL      Nt P-Forb   WATER HEMLOCK                  
CIRLUC     1 Circaea lutetiana canadensis                 3 FACU     Nt P-Forb   ENCHANTER'S NIGHTSHADE         
COROBL     6 Cornus obliqua                              -4 FACW+    Nt Shrub    BLUE-FRUITED DOGWOOD           
CRYCAN     2 Cryptotaenia canadensis                      0 FAC      Nt P-Forb   HONEWORT                       
DACGLO     0 DACTYLIS GLOMERATA                           3 FACU     Ad P-Grass  ORCHARD GRASS                  
EUPPER     4 Eupatorium perfoliatum                      -4 FACW+    Nt P-Forb   COMMON BONESET                 
FESELA     0 FESTUCA ELATIOR                              2 FACU+    Ad P-Grass  TALL FESCUE                    
GALOBT     5 Galium obtusum                              -4 FACW+    Nt P-Forb   WILD MADDER                    
GENFLA     9 Gentiana flavida                             3 FACU     Nt P-Forb   YELLOWISH GENTIAN              
GLYSTR     4 Glyceria striata                            -3 [FACW]   Nt P-Grass  FOWL MANNA GRASS               
HERMAX     5 Heracleum maximum                            5 UPL      Nt P-Forb   COW PARSNIP                    
HYSPAT     5 Hystrix patula                               5 UPL      Nt P-Grass  BOTTLEBRUSH GRASS              
JUNDUD     4 Juncus dudleyi                               0 [FAC]    Nt P-Forb   DUDLEY'S RUSH                  
LOBSIP     6 Lobelia siphilitica                         -4 FACW+    Nt P-Forb   GREAT BLUE LOBELIA             
LONPRO     7 Lonicera prolifera                           5 UPL      Nt W-Vine   YELLOW HONEYSUCKLE             
OXYRIG     7 Oxypolis rigidior                           -5 OBL      Nt P-Forb   COWBANE                        
PANIMP     2 Panicum implicatum                           1 FAC-     Nt P-Grass  OLD-FIELD PANIC GRASS          
PHAARU     0 PHALARIS ARUNDINACEA                        -4 FACW+    Ad P-Grass  REED CANARY GRASS              
PHLPRA     0 PHLEUM PRATENSE                              3 FACU     Ad P-Grass  TIMOTHY                        
PHYVIS     7 Physostegia virginiana speciosa             -3 [FACW]   Nt P-Forb   SHOWY OBEDIENT PLANT           
POACOM     0 POA COMPRESSA                                2 FACU+    Ad P-Grass  CANADA BLUE GRASS              
POAPAS     9 Poa palustris                               -4 FACW+    Nt P-Grass  MARSH BLUE GRASS               
POAPRA     0 POA PRATENSIS                                1 FAC-     Ad P-Grass  KENTUCKY BLUE GRASS            
RUMALT     2 Rumex altissimus                            -2 FACW-    Nt P-Forb   PALE DOCK                      
RUMCRI     0 RUMEX CRISPUS                               -1 FAC+     Ad P-Forb   CURLY DOCK                     
SAG ?      & Sagittaria sp.                              -5 OBL      Nt P-Forb   ARROWHEAD         
SCIATR     4 Scirpus atrovirens                          -5 OBL      Nt P-Sedge  DARK GREEN RUSH                
SCIPEN     4 Scirpus pendulus                            -5 OBL      Nt P-Sedge  RED BULRUSH                    
SIUSUA     7 Sium suave                                  -5 OBL      Nt P-Forb   TALL WATER PARSNIP             
SOLALT     1 Solidago altissima                           3 FACU     Nt P-Forb   TALL GOLDENROD                 
VERSCU    10 Veronica scutellata                         -5 [OBL]    Nt P-Forb   MARSH SPEEDWELL  
	-->					
						
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
