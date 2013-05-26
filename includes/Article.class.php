<?php

class Article {

	private $id = null;
	private $title = null;
	private $body = null;
	private $author = null;
	private $active = null;

	public function __construct($id, $title, $body, $author, $active) {
		$this->id = $id;
		$this->title = $title;
		$this->body = $body;
		$this->author = $author;
		$this->active = $active;
	}

	public function get_id() {
		return $this->id;
	}

	public function get_title() {
		return $this->title;
	}

	public function get_body() {
		return $this->body;
	}

	public function get_author() {
		return $this->author;
	}

	public function is_active() {
		return $this->active;
	}

}

?>
