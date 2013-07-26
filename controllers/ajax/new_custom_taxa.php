<?php
// get parameters
$custom_fqa_id = mysql_real_escape_string($_POST["custom_fqa_id"]);
$original_fqa_id = mysql_real_escape_string($_POST["original_fqa_id"]);
$scientific_name = mysql_real_escape_string(ucfirst(trim($_POST["scientific_name"])));
$family = mysql_real_escape_string(ucfirst(trim($_POST["family"])));
$acronym = mysql_real_escape_string(strtoupper(trim($_POST["acronym"])));
$native = mysql_real_escape_string(strtolower(trim($_POST["native"])));
$c_o_c = mysql_real_escape_string(trim($_POST["c_o_c"]));
$c_o_w = mysql_real_escape_string(trim($_POST["c_o_w"]));
$physiognomy = mysql_real_escape_string(strtolower(trim($_POST["physiognomy"])));
$duration = mysql_real_escape_string(strtolower(trim($_POST["duration"])));
$common_name = mysql_real_escape_string(strtolower(trim($_POST["common_name"])));
	
$custom_taxa = new CustomTaxa;
$custom_taxa->insert_new($custom_fqa_id, $original_fqa_id, $scientific_name, $family, $common_name, $acronym, $c_o_c, $c_o_w, $native, $physiognomy, $duration);	
?>