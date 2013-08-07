<?php
$quadrat_name = mysqli_real_escape_string($db_link, $_POST["quadrat_name"]);
$assessment = unserialize($_SESSION['assessment']);
foreach ($assessment->quadrats as $quad) {
	if ($quad->name == $quadrat_name) {
		if ($quad->active)
			$quad->active = 0;
		else
			$quad->active = 1;
	}
}
$_SESSION['assessment'] = serialize($assessment);
?>