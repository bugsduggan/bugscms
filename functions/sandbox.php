<?php

function create_db($populate_db) {

	$success = true;

	if (!isset($_POST['username'])) {
		$success = false;
	}
	if (!isset($_POST['password'])) {
		$success = false;
	}
	if (!isset($_POST['email'])) {
		$success = false;
	}

	$username = SQLite3::escapeString($_POST['username']);
	$password = SQLite3::escapeString(sha1($_POST['password']));
	$email = SQLite3::escapeString($_POST['email']);

	if ($success) { // still good to go
		$db = new SQLite3(DB_NAME);
		$about_id = 1; // the first page defined as about

		$statements = array(
			"CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT NOT NULL, password TEXT NOT NULL, email TEXT NOT NULL)",
			"CREATE TABLE news (id INTEGER PRIMARY KEY, title TEXT NOT NULL, body TEXT NOT NULL, status INTEGER NOT NULL)",
			"CREATE TABLE gigs (id INTEGER PRIMARY KEY, location TEXT NOT NULL, date TEXT NOT NULL, map_link TEXT, buy_link TEXT)",
			"CREATE TABLE about (id INTEGER, FOREIGN KEY (id) REFERENCES news (id))"
		);

		// set the article id
		foreach ($statements as $stm) {
			$db->exec($stm);
			$db->exec("INSERT INTO about VALUES (".$about_id.")");
		}

		// add admin user
		$db->exec("INSERT INTO users (username, password, email) VALUES ('".$username."', '".$password."', '".$email."')");

		// populate the db
		$generator = new LoremIpsumGenerator();

		for ($i = 1; $i <= 4; $i++) {
			$title = $generator->getContent(5, 'plain', true).' '.$i;
			$body = $generator->getContent(50, 'html', false);
			$body = $body.$generator->getContent(50, 'html', false);
			$body = $body.$generator->getContent(50, 'html', false);
			$db->exec("INSERT INTO news (title, body, status) VALUES ('".$title."', '".$body."', 1)");
		}

		// ensure about page's status is disabled
		$db->exec("UPDATE news SET status=0 WHERE id=".$about_id);

		$db->close();
	}

	if ($success) {
		auth_user(1);
		header('Location:admin/');
	} else
		header('Location:index.php?page=install');

}

function login() {

	$success = false;
	
	if (!isset($_POST['username'])) {
		// fail
	}
	if (!isset($_POST['password'])) {
		// fail
	}

	$username = SQLite3::escapeString($_POST['username']);
	$password = SQLite3::escapeString(sha1($_POST['password']));

	$db = new SQLite3(DB_NAME);
	$query = "SELECT * FROM users WHERE username = '".$username."'";
	$result = $db->querySingle($query, true);

	if ($username == $result['username'] && $password == $result['password']) {
		$success = true;
		auth_user($result['id']);
	}

	$db->close();

	if ($success)
		header('Location:admin/index.php');
	else
		header('Location:index.php?page=login');

}

function auth_user($id) {
	session_regenerate_id();
	$_SESSION['BUGS_UID'] = $id;
}

function logout() {
	session_destroy();
	header('Location:index.php');
}

?>
