<?php
if( $_SESSION['valid'] ) {
	
	$taxa_ids = $_POST['taxa'];
	$quadrat = unserialize($_SESSION['quadrat']);
	
	foreach($taxa_ids as $taxon_id) {
		$quadrat->remove_taxon($taxon_id);
	}
	$_SESSION['quadrat'] = serialize($quadrat);
}
?>