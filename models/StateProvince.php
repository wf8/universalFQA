<?php 

class StateProvince {
	public $id;
	public $country;
	public $abbreviation;
	public $display_name;
	
	public $country_names = array('US' => 'United States', 'CA' => 'Canada', 'MX' => 'Mexico');
	
	public static function get_states_provinces() {
	  $states = array();
		$db_link = StateProvince::get_db_link();
		$sql = "SELECT * FROM states_provinces ORDER BY id";
		$query_results = mysqli_query($db_link, $sql);
		while ($states_result = mysqli_fetch_assoc($query_results)) {
			$state_prov = new StateProvince();
			$state_prov->id = $states_result['id'];
			$state_prov->country = $states_result['country'];
			$state_prov->abbreviation = $states_result['abbr'];
			$state_prov->display_name = $states_result['name'];
			$states[$state_prov->id] = $state_prov;
		}
		mysqli_close($db_link);
		return $states;
	}
	
	public static function get_state_province_by_id($id) {
		$db_link = StateProvince::get_db_link();
		$sql = "SELECT * FROM states_provinces where id = '$id'";
		$query_results = mysqli_query($db_link, $sql);
		$state = mysqli_fetch_array($query_results);
		$state_prov = new StateProvince();
		$state_prov->id = $state['id'];
		$state_prov->country = $state['country'];
		$state_prov->abbreviation = $state['abbr'];
		$state_prov->display_name = $state['name'];
		mysqli_close($db_link);
		return $state_prov;
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
