<?php
class Site {
	
	public $id;
	public $user_id;
	public $name;
	public $location;
	public $city;
	public $county;
	public $state;
	public $country;
	public $notes;
	
	protected $db_link;
	
	/*
	 * constructor
	 */
	public function __construct( $id = null ) {
		if ($id !== null) {
			$this->id = $id;
			// load all data for this site
			$this->get_db_link();
			$sql = "SELECT * FROM site WHERE id='$id'";
			$results = mysqli_query($this->db_link, $sql);
			if (mysqli_num_rows($results) == 0) {
				$this->id = null;
			} else {
				$result = mysqli_fetch_assoc($results);
				$this->user_id = $result['user_id'];
				$this->name = $result['name'];
				$this->location = $result['location'];
				$this->city = $result['city'];
				$this->county = $result['county'];
				$this->state = $result['state'];
				$this->country = $result['country'];
				$this->notes = $result['notes'];
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
	
	/*
	 * function to update site data
	 */
	public function save_site_changes($id, $name, $notes, $city, $county, $state, $country) {
		$this->get_db_link();
		$sql = "UPDATE site SET name='$name', notes='$notes', city='$city', county='$county', state='$state', country='$country' WHERE id='$id'";
		mysqli_query($this->db_link, $sql);
	}

	/*
	 * function to add a new site
	 * returns id of new site on success
	 */
	public function save_new_site($user_id, $name, $notes, $city, $county, $state, $country) {
		$this->get_db_link();
		// check to see if this user already has a site with this name
		$sql = "SELECT * FROM site WHERE user_id='$user_id' AND name='$name'";
		$result = mysqli_query($this->db_link, $sql);
		if (mysqli_num_rows($result) !== 0) {
			echo 'Error: You already have already created a site with that name. New site not saved.';
		} else {
			$sql = "INSERT INTO site (user_id, name, notes, city, county, state, country) VALUES ('$user_id', '$name', '$notes', '$city', '$county', '$state', '$country')";
			mysqli_query($this->db_link, $sql);
			echo mysqli_insert_id($this->db_link);
		}
	}
}
?>