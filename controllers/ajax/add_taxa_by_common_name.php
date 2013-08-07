<?php
if( $_SESSION['valid'] ) {
	
	$common_name = mysqli_real_escape_string($db_link, $_POST['species']);	
	$assessment = unserialize($_SESSION['assessment']);
	
	if ($assessment->add_taxa_by_column_value('common_name', $common_name)) {
		$_SESSION['assessment'] = serialize($assessment);
		echo 'success';
	}
}
?>