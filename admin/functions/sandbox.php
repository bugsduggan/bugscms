<?php

function save_page() {
	$success = true;

	$db = new SQLite3(DB_NAME);

	if (!isset($_POST['id']))
		$id = 1 + $db->querySingle("SELECT id FROM news ORDER BY id DESC LIMIT 1");
	else
		$id = $_POST['id'];

	if (!isset($_POST['title']))
		$success = false;
	if (!isset($_POST['body']))
		$success = false;
	if (!isset($_POST['status']))
		$success = false;

	$title = SQLite3::escapeString($_POST['title']);
	$body = SQLite3::escapeString($_POST['body']);
	$status = $_POST['status'];

	$stm = "INSERT OR REPLACE INTO news (id, title, body, status) VALUES (".$id.", '".$title."', '".$body."', ".$status.")";
	$db->exec($stm);
	$db->close();

	if ($success)
		header('Location:../index.php?page=article&id='.$id);
	else
		header('Location:index.php');	
}

function save_event() {
  $success = true;

	$db = new SQLite3(DB_NAME);

	if (!isset($_POST['id']))
		$id = 1 + $db->querySingle("SELECT id FROM events ORDER BY id DESC LIMIT 1");
	else
		$id = $_POST['id'];

	if (!isset($_POST['name']))
		$success = false;
	if (!isset($_POST['location']))
		$success = false;	
	if (!isset($_POST['date']))
		$success = false;
	if (!isset($_POST['map_link']))
		$success = false;
	if (!isset($_POST['info_link']))
		$success = false;

	$name = SQLite3::escapeString($_POST['name']);
	$location = SQLite3::escapeString($_POST['location']);
	$date = SQLite3::escapeString($_POST['date']);
	$map_link = SQLite3::escapeString($_POST['map_link']);
	$info_link = SQLite3::escapeString($_POST['info_link']);

	$stm = "INSERT OR REPLACE INTO events (id, name, location, date, map_link, info_link) VALUES (".$id.", '".$name."', '".$location."', '".$date."', '".$map_link."', '".$info_link."')";
	$db->exec($stm);
	$db->close();

	if ($success)
		header('Location:../index.php?page=events');
	else
		header('Location:index.php');
}

function set_about() {
	$success = true;

	if (!isset($_GET['id']))
		$success = false;

	$id = $_GET['id'];
	$db = new SQLite3(DB_NAME);
	$about_id = $db->querySingle("SELECT id FROM about");

	// change the old about page to a regular article
	$db->exec("UPDATE news SET status=1 WHERE id=".$about_id);
	// update the about_id
	$about_id = $id;
	$db->exec("UPDATE about SET id=".$about_id);
	// set new about's status
	$db->exec("UPDATE news SET status=0 WHERE id=".$about_id);

	if ($success)
		header('Location:../index.php?page=about');
	else
		header('Location:index.php');
}

?>
