<?php 

class OmernikEcoregion {
	public $id;
	public $omernik_level;
	public $ecoregion_code;
	public $ecoregion_number;
	public $ecoregion_name;
	public $display_name;

	public static function get_omernik_ecoregions() {
	  $ecoregions = array();
		$db_link = OmernikEcoregion::get_db_link();
		$sql = "SELECT * FROM omernik_ecoregions ORDER BY id";
		$query_results = mysqli_query($db_link, $sql);
		while ($ecoregion = mysqli_fetch_assoc($query_results)) {
			$omernik_ecoregion = new OmernikEcoregion();
			$omernik_ecoregion->id = $ecoregion['id'];
			$omernik_ecoregion->omernik_level = $ecoregion['omernik_level'];
			$omernik_ecoregion->ecoregion_code = $ecoregion['ecoregion_code'];
			$omernik_ecoregion->ecoregion_number = $ecoregion['ecoregion_number'];
			$omernik_ecoregion->ecoregion_name = $ecoregion['ecoregion_name'];
			$omernik_ecoregion->display_name = $ecoregion['display_name'];
			$ecoregions[$omernik_ecoregion->id] = $omernik_ecoregion;
		}
		mysqli_close($db_link);
		return $ecoregions;
	}
	
	public static function get_ecoregion_by_id($id) {
		$db_link = OmernikEcoregion::get_db_link();
		$sql = "SELECT * FROM omernik_ecoregions where id = '$id'";
		$query_results = mysqli_query($db_link, $sql);
		$ecoregion = mysqli_fetch_array($query_results);
		$omernik_ecoregion = new OmernikEcoregion();
		$omernik_ecoregion->id = $ecoregion['id'];
		$omernik_ecoregion->omernik_level = $ecoregion['omernik_level'];
		$omernik_ecoregion->ecoregion_code = $ecoregion['ecoregion_code'];
		$omernik_ecoregion->ecoregion_number = $ecoregion['ecoregion_number'];
		$omernik_ecoregion->ecoregion_name = $ecoregion['ecoregion_name'];
		$omernik_ecoregion->display_name = $ecoregion['display_name'];
		mysqli_close($db_link);
		return $omernik_ecoregion;
	}

	private static function get_db_link() {
			require('../config/db_config.php');
			$db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			return $db_link;
	}
}
