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
	
// get original fqa details
$original_fqa_id = mysql_real_escape_string($_GET["id"]);
$sql = "SELECT * FROM fqa WHERE id='$original_fqa_id'";
$fqa_databases = mysql_query($sql);
// if fqa not found redirect user
if (mysql_num_rows($fqa_databases) == 0) {
	header( "Location: databases.php" );
	exit;
} 
$original_fqa = mysql_fetch_assoc($fqa_databases);
$region = $original_fqa['region_name'];
$year = $original_fqa['publication_year'];
$description = $original_fqa['description'];

// insert new customized fqa db
$date = date('Y-m-d');
$user_id = $_SESSION['user_id'];
$sql = "INSERT INTO customized_fqa (fqa_id, region_name, description, publication_year, created, user_id) VALUES ('$original_fqa_id', '$region', '$description', '$year', '$date', '$user_id')";
mysql_query($sql);	
$customized_fqa_id = mysql_insert_id();

// get taxa from original fqa db
$sql = "SELECT * FROM taxa WHERE fqa_id='$original_fqa_id'";
$fqa_taxa = mysql_query($sql);
while ($fqa_taxon = mysql_fetch_assoc($fqa_taxa)) {

	$scientific_name = $fqa_taxon['scientific_name'];
	$family = $fqa_taxon['family'];
	$common_name = $fqa_taxon['common_name'];
	$acronym = $fqa_taxon['acronym'];
	$c_o_c = $fqa_taxon['c_o_c'];
	$c_o_w = $fqa_taxon['c_o_w'];
	$native = $fqa_taxon['native'];
	$physiognomy = $fqa_taxon['physiognomy'];
	$duration = $fqa_taxon['duration'];
 
	// insert taxa into customized_taxa
	// avoid mysql int = null = 0 problem
	if ($c_o_w == null)
		$sql = "INSERT INTO customized_taxa (customized_fqa_id, fqa_id, scientific_name, family, common_name, acronym, c_o_c, native, physiognomy, duration) VALUES ('$customized_fqa_id', '$original_fqa_id', '$scientific_name', '$family', '$common_name', '$acronym', '$c_o_c', '$native', '$physiognomy', '$duration')";
	else
		$sql = "INSERT INTO customized_taxa (customized_fqa_id, fqa_id, scientific_name, family, common_name, acronym, c_o_c, c_o_w, native, physiognomy, duration) VALUES ('$customized_fqa_id', '$original_fqa_id', '$scientific_name', '$family', '$common_name', '$acronym', '$c_o_c', '$c_o_w', '$native', '$physiognomy', '$duration')";
	mysql_query($sql);
}
	
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
					<button class="btn btn-info" onclick="javascript:done_creating_custom_db();">Done Making Changes</button>
					<button class="btn btn-info" onclick="javascript:window.location = 'cancel_customize_database.php?id=<?php echo $customized_fqa_id; ?>';return false;">Cancel</button>
					<br>
				</div>
			</div>
			<br>
			<div class="row-fluid">
				<div class="span6">
					<h4>&#187; Customized Database Details:</h4>
					<label class="small-text">Customized Database Name: <font class="red">*</font></label>
					<input class="field" type="text" id="customized_fqa_name" value="" maxlength="256" required onChange="custom_fqa_update(<?php echo $customized_fqa_id; ?>)" />
					<label class="small-text">Customized Database Description: <font class="red">*</font></label>
					<input class="field" type="text" id="customized_fqa_description" value="" maxlength="256" required onChange="custom_fqa_update(<?php echo $customized_fqa_id; ?>)" />
				</div>
				<div class="span6">
					<h4>&#187; Original Database Details:</h4>
					Region: <?php echo $region; ?><br>
					Year Published: <?php echo $year; ?><br>
					Description: <?php echo $description; ?>
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
							<td><strong>Physiognomy</strong></td>
							<td><strong>Duration</strong></td>
							<td><strong>Common Name</strong></td>
							<td><strong>Options</strong></td>
						</tr> 
						<tr>
							<td><input class="input-medium" id="percentCover" type="text" value=""></td>
							<td><input class="input-small" id="percentCover" type="text" value=""></td>
							<td><input class="input-mini" id="percentCover" type="text" value=""></td>
							<td><input class="input-mini" id="percentCover" type="text" value=""></td>
							<td><input class="input-mini" id="percentCover" type="text" value=""></td>
							<td><input class="input-mini" id="percentCover" type="text" value=""></td>
							<td><input class="input-mini" id="percentCover" type="text" value=""></td>
							<td><input class="input-small" id="percentCover" type="text" value=""></td>
							<td><input class="input-medium" id="percentCover" type="text" value=""></td>
							<td><a href="javascript">Add</a></td>
						</tr>                   
<?php
$sql = "SELECT * FROM customized_taxa WHERE customized_fqa_id='$customized_fqa_id' ORDER BY scientific_name";
$taxa = mysql_query($sql);
if (mysql_num_rows($taxa) == 0) {
?>
						<tr>
							<td colspan="4">There are no taxa in this customized FQA database.</td>
						</tr>
<?php
} else {
	$i = 0;
	while ($taxon = mysql_fetch_assoc($taxa)) {
		$i++;
		$taxon_id = $taxon['id'];
		$scientific_name = $taxon['scientific_name'];
		$family = $taxon['family'];
		$acronym = $taxon['acronym'];
		$native = $taxon['native'];
		if ($native == '1')
			$native = 'native';
		if ($native == '0')
			$native = 'non-native';
		$c_o_c = $taxon['c_o_c'];
		$c_o_w = $taxon['c_o_w'];
		$physiognomy = $taxon['physiognomy'];
		$duration = $taxon['duration'];
		$common_name = $taxon['common_name'];
?>
						<tr>
							<td><input class="input-medium" id="scientific_name<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'scientific_name<?php echo $i; ?>', 'scientific_name', <?php echo $taxon_id; ?> );" value="<?php echo $scientific_name; ?>"></td>
							<td><input class="input-small" id="family<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'family<?php echo $i; ?>', 'family', <?php echo $taxon_id; ?> );" value="<?php echo $family; ?>"></td>
							<td><input class="input-mini" id="acronym<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'acronym<?php echo $i; ?>', 'acronym', <?php echo $taxon_id; ?> );" value="<?php echo $acronym; ?>"></td>
							<td><input class="input-mini" id="native<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'native<?php echo $i; ?>', 'native', <?php echo $taxon_id; ?> );" value="<?php echo $native; ?>"></td>
							<td><input class="input-mini" id="c_o_c<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'c_o_c<?php echo $i; ?>', 'c_o_c', <?php echo $taxon_id; ?> );" value="<?php echo $c_o_c; ?>"></td>
							<td><input class="input-mini" id="c_o_w<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'c_o_w<?php echo $i; ?>', 'c_o_w', <?php echo $taxon_id; ?> );" value="<?php echo $c_o_w; ?>"></td>
							<td><input class="input-mini" id="physiognomy<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'physiognomy<?php echo $i; ?>', 'physiognomy', <?php echo $taxon_id; ?> );" value="<?php echo $physiognomy; ?>"></td>
							<td><input class="input-small" id="duration<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'duration<?php echo $i; ?>', 'duration', <?php echo $taxon_id; ?> );" value="<?php echo $duration; ?>"></td>
							<td><input class="input-medium" id="common_name<?php echo $i; ?>" type="text" onChange="custom_taxa_update( 'common_name<?php echo $i; ?>', 'common_name', <?php echo $taxon_id; ?> );" value="<?php echo $common_name; ?>"></td>
							<td><a onclick="javascript:delete_custom_taxa(<?php echo $taxon_id; ?>);" href="#">Delete</a></td>
						</tr>
<?php
	}
}
?>


</table>						
				</div>
			</div>
			<br><br>
			<div class="row-fluid">
				<div class="span12">				
					<h4>Finished?</h4>
					<button class="btn btn-info" onclick="javascript:done_creating_custom_db();">Done Making Changes</button> 
					<button class="btn btn-info" onclick="javascript:window.location = 'cancel_customize_database.php?id=<?php echo $customized_fqa_id; ?>';return false;">Cancel</button><br>
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
