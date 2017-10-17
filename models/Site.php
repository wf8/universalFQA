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
	
	public $ecoregions = array();
	
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
				$this->ecoregions = $this->get_site_ecoregions($id, $this->db_link);
			}
		}
	}
	
	public function get_site_ecoregions($site_id, $db_link=NULL) {
		$db_link_internal = $db_link;
		if ($db_link == NULL) {
			$this->get_db_link();
			$db_link_internal = $this->db_link;
		}
		$ecoregions = array();
		$sql = "SELECT * FROM site_ecoregions WHERE site_id='$site_id'";
		$query_results = mysqli_query($db_link_internal, $sql);
		if (mysqli_num_rows($query_results) !== 0) {
			while ($site_ecoregion_row = mysqli_fetch_assoc($query_results)) {
				$ecoregion_id = $site_ecoregion_row['ecoregion_id'];
				$ecoregion = OmernikEcoregion::get_ecoregion_by_id($ecoregion_id);
				$ecoregions[$ecoregion_id] = $ecoregion;
			}
		}
		if ($db_link == NULL) {
			mysqli_close($db_link_internal);
		}
		return $ecoregions;
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
	public function save_site_changes($id, $name, $notes, $city, $county, $state, $country, $ecoregion_ids) {
		$this->get_db_link();
		$sql = "UPDATE site SET name='$name', notes='$notes', city='$city', county='$county', state='$state', country='$country' WHERE id='$id'";
		mysqli_query($this->db_link, $sql);
		if (!empty($ecoregion_ids)) {
			$sql = "SELECT * FROM site_ecoregions WHERE site_id='$id'";
			$result = mysqli_query($this->db_link, $sql);
			if (mysqli_num_rows($result) !== 0) {
				$sql = "DELETE FROM site_ecoregions WHERE site_id='$id'";
				mysqli_query($this->db_link, $sql);
			}
			foreach ($ecoregion_ids as $ecoregion_id) {
				if ($ecoregion_id != -1) {
					$sql = "INSERT site_ecoregions SET site_id='$id', ecoregion_id='$ecoregion_id'";
					mysqli_query($this->db_link, $sql);
				}
			}
		}
		mysqli_close($this->db_link);
	}

	/*
	 * function to add a new site
	 * returns id of new site on success
	 */
	public function save_new_site($user_id, $name, $notes, $city, $county, $state, $country, $ecoregion_ids) {
		$this->get_db_link();
		// check to see if this user already has a site with this name
		$sql = "SELECT * FROM site WHERE user_id='$user_id' AND name='$name'";
		$result = mysqli_query($this->db_link, $sql);
		if (mysqli_num_rows($result) !== 0) {
			echo 'Error: You already have already created a site with that name. New site not saved.';
		} else {
			$sql = "INSERT INTO site (user_id, name, notes, city, county, state, country) VALUES ('$user_id', '$name', '$notes', '$city', '$county', '$state', '$country')";
			mysqli_query($this->db_link, $sql);
			$site_id = mysqli_insert_id($this->db_link);
			foreach ($ecoregion_ids as $ecoregion_id) {
				if ($ecoregion_id != -1) {
					$sql = "INSERT site_ecoregions SET site_id='$site_id', ecoregion_id='$ecoregion_id'";
					mysqli_query($this->db_link, $sql);
				}
			}
			mysqli_close($this->db_link);
			echo $site_id;
		}
	}
	
	/*
	 * function to add a new site when the user has no others
	 * returns id of new site on success
	 */
	public function save_first_site($user_id, $name, $notes, $city, $county, $state, $country) {
		$this->get_db_link();
		// check to see if this user already has a site with this name
		$sql = "SELECT * FROM site WHERE user_id='$user_id' AND name='$name'";
		$result = mysqli_query($this->db_link, $sql);
		if (mysqli_num_rows($result) !== 0) {
			echo 'Error: You have already created a site with that name. New site not saved.';
		} else {
			$sql = "INSERT INTO site (user_id, name, notes, city, county, state, country) VALUES ('$user_id', '$name', '$notes', '$city', '$county', '$state', '$country')";
			mysqli_query($this->db_link, $sql);
			$site_id = mysqli_insert_id($this->db_link);
			mysqli_close($this->db_link);			
			echo $site_id;
		}
	}	
}

?>