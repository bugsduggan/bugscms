<?php

require_once('includes/LoremIpsum.class.php');
require_once('includes/Smarty.class.php');

session_start();

date_default_timezone_set('UTC');

define('CONFIG', 'setup.conf');

$smarty = new Smarty();

$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');
$smarty->setCacheDir('cache');
$smarty->setConfigDir('configs');

$smarty->configLoad(CONFIG);
$config = $smarty->getConfigVars();

define('DB_NAME', $config['db_name']);

if ($config['debug'] == 'true') {
	ini_set('display_errors', 'On');
	$smarty->assign('debug', true);
}

$page = (isset($_GET['page']) ? $_GET['page'] : 'home');
$action = (isset($_GET['action']) ? $_GET['action'] : '');

if (!file_exists(DB_NAME)) {
	$page = 'install';
}



if ($page == 'home') {

	$db = new SQLite3(DB_NAME);

	$query = "SELECT * FROM about";
	$result = $db->querySingle($query);
	$about_id = $result;

	$query = "SELECT * FROM news WHERE id = ".$about_id;
	$result = $db->querySingle($query, true);

	if ($result) {
		$about = array(
 		 	'id' => $result['id'],
 			'title' => $result['title'],
 			'body' => $result['body'],
 		);

		$smarty->assign('about', $about);
	}

	$query = "SELECT * FROM news WHERE status = ".$config['status_active']." ORDER BY id DESC LIMIT 3";
	$result = $db->query($query);

	$row = $result->fetchArray(SQLITE3_ASSOC);
  $left = array(
  	'id' => $row['id'],
 		'title' => $row['title'],
 		'body' => $row['body'],
 	);

	$row = $result->fetchArray(SQLITE3_ASSOC);
  $center = array(
  	'id' => $row['id'],
 		'title' => $row['title'],
 		'body' => $row['body'],
 	);

	$row = $result->fetchArray(SQLITE3_ASSOC);
  $right = array(
  	'id' => $row['id'],
 		'title' => $row['title'],
 		'body' => $row['body'],
 	);

	$news_data = array();
	if ($left['id'] && $center['id'] && $right['id']) {
		$news_data = array(
			'left' => $left,
			'center' => $center,
			'right' => $right
		);
	}

	$db->close();

	if (count($news_data) == 3)
		$smarty->assign('news_data', $news_data);

} else if ($page == 'gigs') {

	$db = new SQLite3(DB_NAME);

	$gig_data = array();

	$query = "SELECT * FROM (SELECT * FROM gigs WHERE date > date('now') ORDER BY date DESC LIMIT 10) ORDER BY date ASC";
	$result = $db->query($query);

	$row = $result->fetchArray(SQLITE3_ASSOC);
	while ($row) {
	  $gig = array(
	  	'id' => $row['id'],
  		'location' => $row['location'],
  		'date' => $row['date'],
  		'map_link' => $row['map_link'],
  		'buy_link' => $row['buy_link']
  	);
  	array_push($gig_data, $gig);
		$row = $result->fetchArray(SQLITE3_ASSOC);
	}

	$db->close();

	if (count($gig_data) > 0)
		$smarty->assign('gig_data', $gig_data);

} else if ($page == 'about') {

	$db = new SQLite3(DB_NAME);

	$query = "SELECT * FROM about";
	$result = $db->querySingle($query);
	$about_id = $result;

	$query = "SELECT * FROM news WHERE id = ".$about_id;
	$result = $db->querySingle($query, true);

	if ($result) {
		$article = array(
			'id' => $result['id'],
			'title' => $result['title'],
			'body' => $result['body'],
		);
		$smarty->assign('article', $article);
	}

	$page = 'article';

} else if ($page == 'article') {

	$id = (isset($_GET['id']) ? $_GET['id'] : 0);
	
	if ($id > 0) {
		$db = new SQLite3(DB_NAME);
		$query = "SELECT * FROM news WHERE id = ".$id;
		$result = $db->querySingle($query, true);

		if ($result) {
			$article = array(
				'id' => $result['id'],
				'title' => $result['title'],
				'body' => $result['body'],
			);
			$smarty->assign('article', $article);
		}
	}

}

if ($page == 'install' && $action == 'doinstall' && !file_exists(DB_NAME)) {

	$db = new SQLite3(DB_NAME);
	$about_id = 1; // the first page defined as about

	$statements = array(
		"CREATE TABLE news (id INTEGER PRIMARY KEY, title TEXT NOT NULL, body TEXT NOT NULL, status INTEGER NOT NULL)",
		"CREATE TABLE gigs (id INTEGER PRIMARY KEY, location TEXT NOT NULL, date TEXT NOT NULL, map_link TEXT, buy_link TEXT)",
		"CREATE TABLE about (id INTEGER, FOREIGN KEY (id) REFERENCES news (id))"
	);

	foreach ($statements as $stm) {
		$db->exec($stm);
		$db->exec("INSERT INTO about VALUES (".$about_id.")");
	}

	if ($config['populate_db'] == 'true') {
		$generator = new LoremIpsumGenerator();

		for ($i = 1; $i <= 4; $i++) {
			$title = $generator->getContent(5, 'plain', true).' '.$i;
			$body = $generator->getContent(50, 'html', false);
			$body = $body.$generator->getContent(50, 'html', false);
			$body = $body.$generator->getContent(50, 'html', false);
			$db->exec("INSERT INTO news (title, body, status) VALUES ('".$title."', '".$body."', 1)");
		}

		$db->exec("UPDATE news SET status=0 WHERE id=".$about_id);
	}

	$db->close();

	header('Location:index.php');

} else if ($action == 'login') {
	
} else if ($action == 'logout') {

} else {

	$smarty->assign('logged_in', isset($_SESSION['BUGS_UID']));

	$smarty->assign('page', $page);
	$smarty->display($page.'.tpl');

}

?>
