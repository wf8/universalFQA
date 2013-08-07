<?php
$id = mysqli_real_escape_string($db_link, $_POST["id"]);
$assessment = new TransectAssessment;
$assessment->delete($id);
?>