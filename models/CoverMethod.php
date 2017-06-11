<?php

class CoverMethodValue {
	public $id;
	public $display_name;
	public $midpoint_value;
}		

class CoverMethod {
	public $id;
	public $name;
	public $values = array();
		
	public function __construct() {
	}
	
	public function get_name() {
	  $name = !empty($this->name) ? $this->name : '';
		return $name;
	}

	public function get_values() {
	  $values = (!empty($this->values)) ? $this->values : array();
		return $values;
	}
	
	// Used in validation logic for bulk species upload
	public function get_cover_method_value_for_percent_cover($percent_cover) {
		$cover_method_value = NULL;
		$db_link = CoverMethod::get_db_link();
		$values = $this->load_values($db_link);
		if (empty($values)) {
			// This cover method does not have range values defined - just go with % Cover
			$cover_method_value = new CoverMethodValue();
			$cover_method_value->id = -1;
			$cover_method_value->display_name = $this->get_name();
			$cover_method_value->midpoint_value = $percent_cover;
		} else {
			// Assign to the configured range value
			foreach ($values as $value) {
				if ($percent_cover == $value->midpoint_value) {
					$cover_method_value = $value;
				}
			}
		}
		mysqli_close($db_link);
		return $cover_method_value;
	}
	
	public static function get_cover_methods() {
	  $cover_methods = array();
		$db_link = CoverMethod::get_db_link();
		$sql = "SELECT id, name FROM cover_methods";
		$results = mysqli_query($db_link, $sql);
		while ($cover_method_result = mysqli_fetch_assoc($results)) {
			$cover_method = new CoverMethod();
			$cover_method->id = $cover_method_result['id'];
			$name = $cover_method_result['name'];
			$cover_method->name = $name;
			$cover_method->load_values($db_link);
			$cover_methods[$name] = $cover_method;
		}
		mysqli_close($db_link);
		return $cover_methods;
	}

	public static function get_cover_method($cover_method_id) {
		$cover_method_return = NULL;
		$db_link = CoverMethod::get_db_link();
		$sql = "SELECT id, name FROM cover_methods WHERE id='$cover_method_id'";
		$results = mysqli_query($db_link, $sql);
		while ($cover_method_result = mysqli_fetch_assoc($results)) {
			$cover_method = new CoverMethod();
			$cover_method->id = $cover_method_result['id'];
			$name = $cover_method_result['name'];
			$cover_method->name = $name;
			$cover_method->load_values($db_link);
			$cover_method_return = $cover_method;
		}
		mysqli_close($db_link);
		return $cover_method_return;
	}

	public static function get_cover_method_value($cover_method_id, $cover_method_value_id) {
		$cover_method_value_return = NULL;
	  $cover_method = CoverMethod::get_cover_method($cover_method_id);
		foreach ($cover_method->values as $cover_method_value) {
			if ($cover_method_value_id == $cover_method_value->id) {
				$cover_method_value_return = $cover_method_value;
			}
		}
		if ($cover_method_value_return == NULL) {
			// This cover method does not have range values defined - just go with % Cover
			$cover_method_value_return = new CoverMethodValue();
			$cover_method_value_return->display_name = $cover_method->get_name();
		}
		return $cover_method_value_return;
	}

	private static function get_db_link() {
			require('../config/db_config.php');
			$db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
			if (mysqli_connect_errno($db_link)) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			return $db_link;
	}

	private function load_values($db_link) {
		if (empty($this->values)) {
			$id = $this->id;
			$sql = "SELECT * FROM cover_method_values WHERE cover_method_id='$id'";
			$results = mysqli_query($db_link, $sql);
			while ($cover_method_values = mysqli_fetch_assoc($results)) {
				$value = new CoverMethodValue();
				$value->id = $cover_method_values['id'];
				$value->display_name = $cover_method_values['display_name'];
				$value->midpoint_value = $cover_method_values['midpoint_value'];
				$this->values[$value->id] = $value;
			}
		}
		return $this->values;
	}
}
