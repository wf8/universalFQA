<?php
$id = mysql_real_escape_string($_POST["id"]);
$fqa = new CustomFQADatabase;
$fqa->delete($id);
?>