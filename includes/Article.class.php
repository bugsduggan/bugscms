<?php

class Article {

	private $id = null;
	private $title = null;
	private $body = null;
	private $status = null;
	private $creation_date = null;
	private $author = null;
	private $edit_date = null;
	private $editor = null;

	public function __construct($id, $title, $body, $status, $creation_date, $author, $edit_date, $editor) {
		$this->id = $id;
		$this->title = $title;
		$this->body = $body;
		$this->status = $status;
		$this->creation_date = $creation_date;
		$this->author = $author;
		$this->edit_date = $edit_date;
		$this->editor = $editor;
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

	public function get_status() {
		return $this->status;
	}

	public function set_status($status) {
		$this->status = $status;
	}

	public function get_creation_date() {
		return $this->creation_date;
	}

	public function get_author() {
		return $this->author;
	}

	public function get_edit_date() {
		return $this->edit_date;
	}

	public function set_edit_date($edit_date) {
		$this->edit_date = $edit_date;
	}

	public function get_editor() {
		return $this->editor;
	}

	public function set_editor() {
		$this->editor = $editor;
	}

}

?>
