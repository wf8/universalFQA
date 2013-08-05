<?php
if( $_SESSION['valid'] ) {
	
	$scientific_name = mysql_real_escape_string($_POST['species']);
	$quadrat = unserialize($_SESSION['quadrat']);
	
	if ($quadrat->add_taxa_by_column_value('scientific_name', $scientific_name)) {
		$_SESSION['quadrat'] = serialize($quadrat);
		echo 'success';
	}
}
?>