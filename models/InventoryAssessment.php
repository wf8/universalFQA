<?php
class InventoryAssessment extends Assessment {

	protected $db_table = 'inventory';
	
	public function __construct() {
		Assessment::__construct();
	}
	
	public function get_all_for_user($user_id) {
		return Assessment::get_all_for_user($user_id);
	}
	
	public function get_all_public() {
		return Assessment::get_all_public();
	}
	
}
?>