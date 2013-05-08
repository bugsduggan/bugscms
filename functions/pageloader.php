<?php

function show_page($smarty, $page) {
	$smarty->assign('logged_in', isset($_SESSION['BUGS_UID']));
	$smarty->assign('page', $page);
	if ($page == 'about')
		$smarty->display('article.tpl');
	else
		$smarty->display($page.'.tpl');
}

function prepare_page($smarty, $page) {
	if ($page == 'home')
		prepare_home($smarty);
	else if ($page == 'events')
		prepare_events($smarty);
	else if ($page == 'about')
		prepare_about($smarty);
	else if ($page == 'article')
		prepare_article($smarty);
}

function prepare_home($smarty) {
	global $config;
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
}

function prepare_events($smarty) {
	$db = new SQLite3(DB_NAME);

	$events = array();

	$query = "SELECT * FROM (SELECT * FROM events WHERE date > date('now') ORDER BY date DESC LIMIT 10) ORDER BY date ASC";
	$result = $db->query($query);

	$row = $result->fetchArray(SQLITE3_ASSOC);
	while ($row) {
	  $event = array(
	  	'id' => $row['id'],
			'name' => $row['name'],
  		'location' => $row['location'],
  		'date' => $row['date'],
  		'map_link' => $row['map_link'],
  		'info_link' => $row['info_link']
  	);
  	array_push($events, $event);
		$row = $result->fetchArray(SQLITE3_ASSOC);
	}

	$db->close();

	if (count($events) > 0)
		$smarty->assign('events', $events);
}

function prepare_about($smarty) {
	$db = new SQLite3(DB_NAME);

	$query = "SELECT * FROM news WHERE id = (SELECT * FROM about)";
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

function prepare_article($smarty) {
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

?>
