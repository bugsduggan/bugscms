<?php

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

	$query = "SELECT * FROM news WHERE status = ".$config['status_active']." ORDER BY id DESC LIMIT 4";
	$result = $db->query($query);

	$row = $result->fetchArray(SQLITE3_ASSOC);
  $top = array(
  	'id' => $row['id'],
 		'title' => $row['title'],
 		'body' => $row['body'],
 		'link' => $row['link'],
 		'link_text' => $row['link_text']
 	);

	$row = $result->fetchArray(SQLITE3_ASSOC);
  $left = array(
  	'id' => $row['id'],
 		'title' => $row['title'],
 		'body' => $row['body'],
 		'link' => $row['link'],
 		'link_text' => $row['link_text']
 	);

	$row = $result->fetchArray(SQLITE3_ASSOC);
  $center = array(
  	'id' => $row['id'],
 		'title' => $row['title'],
 		'body' => $row['body'],
 		'link' => $row['link'],
 		'link_text' => $row['link_text']
 	);

	$row = $result->fetchArray(SQLITE3_ASSOC);
  $right = array(
  	'id' => $row['id'],
 		'title' => $row['title'],
 		'body' => $row['body'],
 		'link' => $row['link'],
 		'link_text' => $row['link_text']
 	);

	$news_data = array();
	if ($top['id'] && $left['id'] && $center['id'] && $right['id']) {
		$news_data = array(
			'top' => $top,
			'left' => $left,
			'center' => $center,
			'right' => $right
		);
	}

	$db->close();

	if (count($news_data) == 4)
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

	$query = "SELECT * FROM news WHERE status = ".$config['status_about'];
	$result = $db->querySingle($query, true);

	if ($result) {
		$about = array(
			'id' => $result['id'],
			'title' => $result['title'],
			'body' => $result['body'],
			'link' => $result['link'],
			'link_text' => $result['link_text']
		);
		$smarty->assign('about', $about);
	}

}

if ($page == 'install' && $action == 'doinstall' && !file_exists(DB_NAME)) {

	$db = new SQLite3(DB_NAME);

	$statements = array(
		"CREATE TABLE news (id INTEGER PRIMARY KEY, title TEXT NOT NULL, body TEXT NOT NULL, link TEXT NOT NULL, link_text TEXT NOT NULL, status INTEGER NOT NULL)",
		"CREATE TABLE gigs (id INTEGER PRIMARY KEY, location TEXT NOT NULL, date TEXT NOT NULL, map_link TEXT, buy_link TEXT'')"
	);

	foreach ($statements as $stm) {
		$db->exec($stm);
	}

	$db->close();

	header('Location:index.php');

} else {

	$smarty->assign('page', $page);
	$smarty->display($page.'.tpl');

}

?>
