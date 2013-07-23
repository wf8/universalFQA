<?php
class TransectAssessment extends Assessment {

	protected $db_table = 'transect';
	
	public function __construct( $id = null ) {
		Assessment::__construct( $id );
		if ($id !== null) {
			// load the transect quadrats
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