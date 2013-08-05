<?php
class Taxa {

	protected $db_link;

	public $id;
	public $fqa_id;
	public $scientific_name;
	public $family;
	public $common_name;
 	public $acronym;
 	public $c_o_c;
 	public $c_o_w;
 	public $native;
 	public $physiognomy;
 	public $duration;
 	public $percent_cover;

	/*
	 * constructor
	 */
	public function __construct( $id = null ) {
		if ($id !== null) {
			$this->id = $id;
			// load all data for this assessment
			$this->get_db_link();
			$sql = "SELECT *, site.* FROM taxa WHERE $this->id='$id'";
			$results = mysqli_query($this->db_link, $sql);
			if (mysqli_num_rows($results) == 0) {
				$this->id = null;
			} else {
				$result = mysqli_fetch_assoc($results);
				$this->id = $result['id'];
				$this->fqa_id = $result['fqa_id'];
				$this->scientific_name = $result['scientific_name'];
				if ($result['native'] == 1)
					$this->native = 'native';
				else
					$this->native = 'non-native';
				$this->family = $result['family'];
				$this->common_name = $result['common_name'];
				$this->acronym = $result['acronym'];
				$this->c_o_c = $result['c_o_c'];
				$this->c_o_w = $result['c_o_w'];
				$this->physiognomy = $result['physiognomy'];
				$this->duration = $result['duration'];	
			}	
		}	
	}
	
	/*
	 * function to get link to mysql database
	 */
	private function get_db_link() {
			require('../config/db_config.php');
			$this->db_link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
			if (mysqli_connect_errno($this->db_link)) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
	}
}