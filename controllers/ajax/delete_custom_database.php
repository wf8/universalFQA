<?php
$id = mysqli_real_escape_string($db_link, $_POST["id"]);
$fqa = new CustomFQADatabase;
$fqa->delete($id);
?>