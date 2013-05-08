<?php

function show_page($smarty, $page) {
	$smarty->assign('page', $page);
	if ($page != 'home')
		$smarty->display('admin-'.$page.'.tpl');
	else
		$smarty->display('admin-master.tpl');
}

function prepare_page($smarty, $page) {
	if ($page == 'pages')
		prepare_pages($smarty);
	if ($page == 'edit')
		prepare_edit($smarty);
	if ($page == 'gigs')
		prepare_gigs($smarty);
}

function prepare_pages($smarty) {
	global $config;
	$db = new SQLite3(DB_NAME);

	// about page
	$about_id = $db->querySingle("SELECT id FROM about");
	$query = "SELECT * FROM news WHERE id = ".$about_id;
	$result = $db->querySingle($query, true);

	$about = array(
		'id' => $result['id'],
		'title' => $result['title'],
		'body' => $result['body']
	);

	// rest of the pages
	$query = "SELECT * FROM news WHERE status = ".$config['status_active'];
	$result = $db->query($query);

	$pages = array();
	while (($row = $result->fetchArray(SQLITE3_ASSOC)) != null) {
		$page = array(
			'id' => $row['id'],
			'title' => $row['title'],
			'body' => $row['body'],
		);
		array_push($pages, $page);
	}

	// assign stuff
	$db->close();
	if ($about)
		$smarty->assign('about', $about);
	if (count($pages) > 0)
		$smarty->assign('pages', $pages);
}

function prepare_edit($smarty) {
	if (isset($_GET['id'])) {
		// id is set, we're editing
		$db = new SQLite3(DB_NAME);

		$page_id = $_GET['id'];
		$query = "SELECT * FROM news WHERE id=".$page_id;
		$result = $db->querySingle($query, true);
		
		$article = array(
			'id' => $result['id'],
			'title' => $result['title'],
			'body' => $result['body'],
			'status' => $result['status']
		);

		$smarty->assign('article', $article);
		$db->close();
	}
}

function prepare_gigs($smarty) {
	$db = new SQLite3(DB_NAME);

	$query = "SELECT * FROM gigs WHERE date > date('now') ORDER BY date ASC";
	$result = $db->query($query);

	$gigs = array();
	while (($row = $result->fetchArray(SQLITE3_ASSOC)) != null) {
		$gig = array(
			'id' => $row['id'],
			'location' => $row['location'],
			'date' => $row['date'],
			'map_link' => $row['map_link'],
			'buy_link' => $row['buy_link']
		);
		array_push($gigs, $gig);
	}

	$db->close();
	if (count($gigs) > 0)
		$smarty->assign('gigs', $gigs);
}

?>
