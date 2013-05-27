<?php

class Event {

	private $id = null;
	private $location = null;
	private $date = null;
	private $comment = null;
	private $status = null;

	public function __construct($id, $location, $date, $comment, $status) {
		$this->id = $id;
		$this->location = $location;
		$this->date = $date;
		$this->comment = $comment;
		$this->status = $status;
	}

	public function get_id() {
		return $this->id;
	}

	public function get_location() {
		return $this->location;
	}

	public function get_date() {
		return $this->date;
	}

	public function get_comment() {
		return $this->comment;
	}

	public function get_status() {
		return $this->status();
	}

	public function get_map_link() {
		return "http://maps.googleapis.com/maps/api/staticmap?size=512x512&maptype=roadmap\&markers=size:mid%7Ccolor:red%7C".$this->get_location()."&zoom=13&sensor=false";
	}

}

?>
