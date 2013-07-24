<?php
if( !$_SESSION['valid'] ) 
	require_once('../views/login.php');
else {
	require_once('../views/nav.php');
	// get all the fqa databases
	$fqa = new FQADatabase;
	$fqa_databases = $fqa->get_all();
	// get this user's custom fqa databases
	$custom_fqa = new CustomFQADatabase;
	$custom_fqa_databases = $custom_fqa->get_all_for_user($_SESSION['user_id']);
	// display view
	require_once('../views/view_databases.php');
}
?>