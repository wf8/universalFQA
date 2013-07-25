<?php
if( $_SESSION['valid'] ) {
	
	$acronym = mysql_real_escape_string($_POST['species']);
	$assessment = unserialize($_SESSION['assessment']);
	
	if ($assessment->add_taxa_by_column_value('acronym', $acronym)) {
		$_SESSION['assessment'] = serialize($assessment);
		echo 'success';
	}
}
?>