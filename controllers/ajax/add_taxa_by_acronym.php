<?php
if( $_SESSION['valid'] ) {
	
	$acronym = mysqli_real_escape_string($db_link, $_POST['species']);
	$assessment = unserialize($_SESSION['assessment']);
	
	if ($assessment->add_taxa_by_column_value('acronym', $acronym)) {
		$_SESSION['assessment'] = serialize($assessment);
		echo 'success';
	}
}
?>