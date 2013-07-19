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

// get parameters
$id = mysql_real_escape_string($_GET["id"]);
// get fqa details
$sql = "SELECT * FROM fqa WHERE id='$id'";
$fqa_databases = mysql_query($sql);
// if fqa not found redirect user
if (mysql_num_rows($fqa_databases) == 0) {
	header( "Location: databases.php" );
	exit;
} 
$fqa_database = mysql_fetch_assoc($fqa_databases);
$region = $fqa_database['region_name'];
$year = $fqa_database['publication_year'];
$description = $fqa_database['description'];

// get fqa taxa
$sql = "SELECT * FROM taxa WHERE fqa_id='$id'";
$fqa_taxa = mysql_query($sql);
$total_taxa = 0;
$native_taxa = 0;
$total_c = 0;
$native_c = 0;
$mean_total_c = 0;
$mean_native_c = 0;
while ($fqa_taxon = mysql_fetch_assoc($fqa_taxa)) {
	$total_taxa++;
	$total_c = $total_c + $fqa_taxon['c_o_c'];
	echo $fqa_taxon['native'];
	if ($fqa_taxon['native'] == true) {
		$native_taxa++;
		$native_c = $total_c + $fqa_taxon['c_o_c'];
	}
}
// reset pointer
mysql_data_seek($fqa_taxa, 0);
// calculate other fqa details
if ($total_taxa !== 0)
	$mean_total_c = round(( $total_c / $total_taxa ), 1);
if ($native_taxa !== 0)
	$mean_native_c = round(( $native_c / $native_taxa ), 1);
$percent_native = round(( $native_taxa / $total_taxa ) * 100, 1);
$percent_nonnative = 100 - $percent_native;
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
					<h1>Public FQA Database</h1>
					<button class="btn btn-info" onclick="javascript:window.location = 'utils/customize_database.php?id=<?php echo $id; ?>';return false;">Customize This Database</button>
					<button class="btn btn-info" onClick="asdf_changes();">Download</button> 
					<button class="btn btn-info" onclick="javascript:window.location = 'databases.php';return false;">Done</button>
					<br>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<h2><?php echo $region; ?>, <?php echo $year; ?></h2>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<h4>&#187; Details:</h4>
					Region: <?php echo $region; ?><br>
					Year Published: <?php echo $year; ?><br>
					Description: <?php echo $description; ?>
				</div>	
				<div class="span6">
					<h4>&#187; Database Metrics:</h4>
					Total Species: <strong><?php echo $total_taxa; ?></strong><br>
					Native Species: <strong><?php echo $native_taxa; ?> (<?php echo $percent_native; ?>%)</strong><br>
					Non-native Species: <strong><?php echo $total_taxa - $native_taxa; ?> (<?php echo $percent_nonnative; ?>%)</strong><br>
					Total Mean C: <strong><?php echo $mean_total_c; ?></strong><br>
					Native Mean C: <strong><?php echo $mean_native_c; ?></strong><br>
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
						</tr>  
<?php
while ($fqa_taxon = mysql_fetch_assoc($fqa_taxa)) {
	echo "<tr>";
	echo "<td>".$fqa_taxon['scientific_name']."</td>";
	if ($fqa_taxon['family'] == null)
		$family = "n/a";
	else
		$family = $fqa_taxon['family'];
	echo "<td>".$family."</td>";
	if ($fqa_taxon['acronym'] == null)
		$acronym = "n/a";
	else
		$acronym = $fqa_taxon['acronym'];
	echo "<td>".$acronym."</td>";
	echo "<td>".$fqa_taxon['native']."</td>";
	echo "<td>".$fqa_taxon['c_o_c']."</td>";
	if ($fqa_taxon['c_o_w'] == null) {
		$c_o_w = "n/a";
		$wet = "n/a";
	} else {
		$c_o_w = $fqa_taxon['c_o_w'];
		if ($c_o_w == -5)	
			$wet = "OBL";
		else if ($c_o_w == -4)
			$wet = "FACW+";
		else if ($c_o_w == -3)
			$wet = "FACW";
		else if ($c_o_w == -2)
			$wet = "FACW-";
		else if ($c_o_w == -1)
			$wet = "FAC+";
		else if ($c_o_w == 0)
			$wet = "FAC";
		else if ($c_o_w == 1)
			$wet = "FAC-";
		else if ($c_o_w == 2)
			$wet = "FACU+";
		else if ($c_o_w == 3)
			$wet = "FACU";
		else if ($c_o_w == 4)
			$wet = "FACU-";
		else if ($c_o_w == 5)
			$wet = "UPL";
	}	
	echo "<td>".$c_o_w."</td>";
	echo "<td>".$wet."</td>";
	if ($fqa_taxon['physiognomy'] == null)
		$physiognomy = "n/a";
	else
		$physiognomy = $fqa_taxon['physiognomy'];
	echo "<td>".$physiognomy."</td>";
	if ($fqa_taxon['duration'] == null)
		$duration = "n/a";
	else
		$duration = $fqa_taxon['duration'];
	echo "<td>".$duration."</td>";
	if ($fqa_taxon['common_name'] == null)
		$common_name = "n/a";
	else
		$common_name = $fqa_taxon['common_name'];
	echo "<td>".$common_name."</td>";
	echo "</tr>";
}
?>               
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
