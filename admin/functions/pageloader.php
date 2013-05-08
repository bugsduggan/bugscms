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

?>
