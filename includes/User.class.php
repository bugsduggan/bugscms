<?php

class User {

	private $id = null;
	private $username = null;
	private $password = null;
	private $email = null;
	private $admin = null;
	private $avatar = null;

	public function __construct($id, $username, $password, $email, $admin, $avatar) {
		$this->id = $id;
		$this->username = $username;
		$this->password = $password;
		$this->email = $email;
		$this->admin = $admin;
		$this->avatar = $avatar;
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

	public function set_email($email) {
		$this->email = $email;
	}

	public function is_admin() {
		return $this->admin;
	}

	public function set_admin($admin) {
		$this->admin = $admin;
	}

	public function get_avatar() {
		return $this->avatar;
	}

	public function set_avatar($avatar) {
		$this->avatar = $avatar;
	}

}

?>
