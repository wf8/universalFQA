<?php
// retrieve our data from POST
$email = mysqli_real_escape_string($db_link,$_POST['email']);
$first_name = mysqli_real_escape_string($db_link,$_POST['first_name']);
$last_name = mysqli_real_escape_string($db_link,$_POST['last_name']);
$pass1 = $_POST['password1'];
$pass2 = $_POST['password2'];
$user = new User;
$user->register($email, $first_name, $last_name, $pass1, $pass2);
?>