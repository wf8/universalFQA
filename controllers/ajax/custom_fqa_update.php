<?php
// get parameters
$id = mysqli_real_escape_string($db_link, $_POST["id"]);
$name = mysqli_real_escape_string($db_link, $_POST["name"]);
$description = mysqli_real_escape_string($db_link, $_POST["description"]);
$fqa = new CustomFQADatabase;
$fqa->update($id, $name, $description);
?>