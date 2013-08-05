<?php
if( $_SESSION['valid'] ) {
	
	$acronym = mysql_real_escape_string($_POST['species']);
	$quadrat = unserialize($_SESSION['quadrat']);
	
	if ($quadrat->add_taxa_by_column_value('acronym', $acronym)) {
		$_SESSION['quadrat'] = serialize($quadrat);
		echo 'success';
	}
}
?>