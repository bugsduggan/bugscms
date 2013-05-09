<?php

class Article {

	public $id = null;
	public $title = null;
	public $subtitle = null;
	public $body = null;
	public $author = null;
	public $date_created = null;
	public $status = null;

	public function __construct($id, $title, $subtitle, $body, $author, $date_created, $status) {
		$this->id = $id;
		$this->title = $title;
		$this->subtitle = $title;
		$this->body = $title;
		$this->author = $author;
		$this->date_created = $date_created;
		$this->status = $status;
	}

}

?>
