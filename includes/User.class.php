<?php

class User {

	public $id = null;
	public $username = null;
	public $password = null;
	public $email = null;

	public function __construct($id, $username, $password, $email) {
		$this->id = $id;
		$this->username = $username;
		$this->password = $password;
		$this->email = $email;
	}

}

?>
