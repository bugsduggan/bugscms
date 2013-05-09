<?php

require_once('includes/User.class.php');

class BugsDBException extends Exception { }

class BugsDB {

	/* private variables */
	private $db_name = null; // the database file

	/* constructor */
	public function __construct($db_name) {
		$this->db_name = $db_name;
	}

	/*
	 * public functions
	 */

	/* returns true if the db file exists */
	public function exists() {
		return file_exists($this->db_name);
	}

	/* creates the database and adds the admin user */
	public function create_db($username, $password, $email, $overwrite=false) {
		// check if exists
		if ($this->exists()) {
			if ($overwrite) // it exists, kill it
				unlink($this->db_name);
			else
				throw new BugsDBException('Cannot write to file: '.$this->db_name);
		}

		// create table statements
		$statement = array(
			"CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT NOT NULL, password TEXT NOT NULL, email TEXT NOT NULL, status INTEGER NOT NULL)"
		);

		// loop through and exec
		foreach ($statement as $stm)
			$this->exec($stm);

		// create admin user
		$user = $this->add_user($username, $password, $email, true);

		// return the admin user
		return $user;
	}

	/* adds a user the the database and returns the user object */
	public function add_user($username, $password, $email, $admin=false) {
		// find the next id
		$id = $this->next_id('users');

		// encrypt the password
		$password = sha1($password);

		// create a user object
		$user = new User($id, $username, $password, $email, $admin);
		
		// update the database and return
		return $this->update_user($user);
	}

	/* updates or creates an entry in the users table */
	public function update_user($user) {
		// prepare variables
		$id = $user->get_id();
		$username = $user->get_username();
		$password = $user->get_password();
		$email = $user->get_email();
		if ($user->is_admin())
			$status = 1;
		else
			$status = 0;

		// prepare statement
		$stm = "INSERT OR REPLACE INTO users VALUES ($id, '$username', '$password', '$email', $status)";	

		// exec and return
		$this->exec($stm);
		return $this->get_user($user->get_id());
	}

	/* gets a user from the database */
	public function get_user($id) {
		// execute the query
		$query = "SELECT * FROM users WHERE id=$id";
		$result = $this->query_single($query);

		// error handling
		if (count($result) == 0)
			throw new BugsDBException('User not found');

		// prepare variables
		$id = $result['id'];
		$username = $result['username'];
		$password = $result['password'];
		$email = $result['email'];
		if ($result['status'] == 1)
			$admin = true;
		else
			$admin = false;

		// create and return object
		return new User($id, $username, $password, $email, $admin);
	}

	/*
	 * private functions
	 */

	/* gets the next available id from a given table */
	private function next_id($table) {
		$query = "SELECT id FROM $table ORDER BY id DESC LIMIT 1";
		return 1 + $this->query_single($query, false);
	}

	/* execs a resultless statement */
	private function exec($stm) {
		$db = new SQLite3($this->db_name);
		if (!$db->exec($stm))
			throw new BugsDBException('Failed to exec statement: \''.$stm.'\'');
	}

	/* returns a single result query */
	private function query_single($query, $entire_row=true) {
		$db = new SQLite3($this->db_name);
		$result = $db->querySingle($query, $entire_row);
		$db->close();
		return $result;
	}

}
