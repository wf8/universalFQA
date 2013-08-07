<?php
if( $_SESSION['valid'] ) {
	
	$common_name = mysqli_real_escape_string($db_link, $_POST['species']);	
	$percent_cover = mysqli_real_escape_string($db_link, $_POST['percent_cover']);
	$quadrat = unserialize($_SESSION['quadrat']);
	
	if ($quadrat->add_taxa_by_column_value('common_name', $common_name, $percent_cover)) {
		$_SESSION['quadrat'] = serialize($quadrat);
		echo 'success';
	}
}
?>