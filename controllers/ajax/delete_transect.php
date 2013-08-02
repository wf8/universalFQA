<?php
$id = mysql_real_escape_string($_POST["id"]);
$assessment = new TransectAssessment;
$assessment->delete($id);
?>