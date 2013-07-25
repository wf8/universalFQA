<?php
if( $_SESSION['valid'] ) {
	
	$common_name = mysql_real_escape_string($_POST['species']);	
	$assessment = unserialize($_SESSION['assessment']);
	
	if ($assessment->add_taxa_by_column_value('common_name', $common_name)) {
		$_SESSION['assessment'] = serialize($assessment);
		echo 'success';
	}
}
?>