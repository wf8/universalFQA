<?php
// retrieve our data from POST
$name = mysql_real_escape_string($_POST['name']);
$notes = mysql_real_escape_string($_POST['notes']);
$city = mysql_real_escape_string($_POST['city']);
$county = mysql_real_escape_string($_POST['county']);
$state = mysql_real_escape_string($_POST['state']);
$country = mysql_real_escape_string($_POST['country']);
$user_id = $_SESSION['user_id'];
$site = new Site();
$site->save_new_site($user_id, $name, $notes, $city, $county, $state, $country);
?>