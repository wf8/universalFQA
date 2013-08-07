<?php
// retrieve our data from POST
$id = mysqli_real_escape_string($db_link, $_POST['id']);
$name = mysqli_real_escape_string($db_link, $_POST['name']);
$notes = mysqli_real_escape_string($db_link, $_POST['notes']);
$city = mysqli_real_escape_string($db_link, $_POST['city']);
$county = mysqli_real_escape_string($db_link, $_POST['county']);
$state = mysqli_real_escape_string($db_link, $_POST['state']);
$country = mysqli_real_escape_string($db_link, $_POST['country']);
$site = new Site();
$site->save_site_changes($id, $name, $notes, $city, $county, $state, $country);
?>