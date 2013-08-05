<?php
if( $_SESSION['valid'] ) {
	
	$scientific_name = mysql_real_escape_string($_POST['species']);
	$percent_cover = mysql_real_escape_string($_POST['percent_cover']);
	$quadrat = unserialize($_SESSION['quadrat']);
	
	if ($quadrat->add_taxa_by_column_value('scientific_name', $scientific_name, $percent_cover)) {
		$_SESSION['quadrat'] = serialize($quadrat);
		echo 'success';
	}
}
?>