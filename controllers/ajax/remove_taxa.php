<?php
if( $_SESSION['valid'] ) {
	
	$taxa_ids = $_POST['taxa'];
	$assessment = unserialize($_SESSION['assessment']);
	
	foreach($taxa_ids as $taxon_id) {
		$assessment->remove_taxon($taxon_id);
	}
	$_SESSION['assessment'] = serialize($assessment);
}
?>