<?php
class Metrics {

	protected $db_link;
	
	public $assessment; // Assessment object
	
	/*
	 * constructor
	 * takes as input an Assessment object
	 */
	protected function __construct( $assessment ) {
		$this->assessment = $assessment;
	}
	
	/*
	 * function to get link to mysql database
	 */
	protected function get_db_link() {
		require('../config/db_config.php');
		$this->db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}
}
?>
