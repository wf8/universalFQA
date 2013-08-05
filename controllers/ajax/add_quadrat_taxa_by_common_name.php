<?php
if( $_SESSION['valid'] ) {
	
	$common_name = mysql_real_escape_string($_POST['species']);	
	$quadrat = unserialize($_SESSION['quadrat']);
	
	if ($quadrat->add_taxa_by_column_value('common_name', $common_name)) {
		$_SESSION['quadrat'] = serialize($quadrat);
		echo 'success';
	}
}
?>