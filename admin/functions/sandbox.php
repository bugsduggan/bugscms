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

	if ($success)
		header('Location:../index.php?page=article&id='.$id);
	else
		header('Location:index.php');	
}

?>
