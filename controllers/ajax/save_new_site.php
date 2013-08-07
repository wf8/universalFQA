<?php
// retrieve our data from POST
$name = mysqli_real_escape_string($db_link, $_POST['name']);
$notes = mysqli_real_escape_string($db_link, $_POST['notes']);
$city = mysqli_real_escape_string($db_link, $_POST['city']);
$county = mysqli_real_escape_string($db_link, $_POST['county']);
$state = mysqli_real_escape_string($db_link, $_POST['state']);
$country = mysqli_real_escape_string($db_link, $_POST['country']);
$user_id = $_SESSION['user_id'];
$site = new Site();
$site->save_new_site($user_id, $name, $notes, $city, $county, $state, $country);
?>