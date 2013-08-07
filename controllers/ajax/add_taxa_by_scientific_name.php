<?php
if( $_SESSION['valid'] ) {
	
	$scientific_name = mysqli_real_escape_string($db_link, $_POST['species']);
	$assessment = unserialize($_SESSION['assessment']);
	
	if ($assessment->add_taxa_by_column_value('scientific_name', $scientific_name)) {
		$_SESSION['assessment'] = serialize($assessment);
		echo 'success';
	}
}
?>