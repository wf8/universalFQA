<?php
// retrieve our data from POST
$id = mysql_real_escape_string($_POST['id']);
$name = mysql_real_escape_string($_POST['name']);
$notes = mysql_real_escape_string($_POST['notes']);
$city = mysql_real_escape_string($_POST['city']);
$county = mysql_real_escape_string($_POST['county']);
$state = mysql_real_escape_string($_POST['state']);
$country = mysql_real_escape_string($_POST['country']);
$site = new Site();
$site->save_site_changes($id, $name, $notes, $city, $county, $state, $country);
?>