<?php
if( $_SESSION['valid'] ) {
	
	$scientific_name = mysql_real_escape_string($_POST['species']);
	$assessment = unserialize($_SESSION['assessment']);
	
	if ($assessment->add_taxa_by_column_value('scientific_name', $scientific_name)) {
		$_SESSION['assessment'] = serialize($assessment);
		echo 'success';
	}
}
?>