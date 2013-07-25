<?php
$id = mysql_real_escape_string($_POST["id"]);
$assessment = new InventoryAssessment;
$assessment->delete($id);
?>