<?php

class User {

	private $id = null;
	private $username = null;
	private $password = null;
	private $email = null;
	private $admin = null;

	public function __construct($id, $username, $password, $email, $admin) {
		$this->id = $id;
		$this->username = $username;
		$this->password = $password;
		$this->email = $email;
		$this->admin = $admin;
	}

	public function get_id() {
		return $this->id;
	}

	public function get_username() {
		return $this->username;
	}

	public function get_password() {
		return $this->password;
	}

	public function set_password($password) {
		$this->password = $password;
	}

	public function get_email() {
		return $this->email;
	}

	public function is_admin() {
		return $this->admin;
	}

}

?>
