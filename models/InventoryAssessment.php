<?php
class InventoryAssessment extends Assessment {

	protected $db_table = 'inventory';
	
	public function __construct( $id = null ) {
		Assessment::__construct( $id );
		if ($id !== null) {
			// load the inventory taxa
		}
	}
	
	public function get_all_for_user($user_id) {
		return Assessment::get_all_for_user($user_id);
	}
	
	public function get_all_public() {
		return Assessment::get_all_public();
	}
	
}
?>