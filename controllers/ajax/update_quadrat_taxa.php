<?php
if( $_SESSION['valid'] ) {
	
	$taxa_id = $_POST['id'];
	$percent_cover = $_POST['percent_cover'];
	$quadrat = unserialize($_SESSION['quadrat']);
	
	foreach($quadrat->taxa as $taxon) {
		if ($taxon->id == $taxa_id)
			$taxon->percent_cover = $percent_cover;
	}
	$_SESSION['quadrat'] = serialize($quadrat);
}
?>