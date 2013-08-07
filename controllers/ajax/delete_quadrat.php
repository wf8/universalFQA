<?php
if( $_SESSION['valid'] ) {
	$id = mysqli_real_escape_string($db_link, $_POST["id"]);
	$assessment = unserialize($_SESSION['assessment']);
	$i = 0;
	foreach ($assessment->quadrats as $quad) {
		if ($quad->name == $id) {
			unset($assessment->quadrats[$i]);
			$assessment->quadrats = array_values($assessment->quadrats);
			break;
		}
		$i++;
	}
	$_SESSION['assessment'] = serialize($assessment);
}
?>