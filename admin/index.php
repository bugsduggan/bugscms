<?php

require_once('../includes/BugsCMS.class.php');

$cms = new BugsCMS('admin');

if (!isset($_SESSION['BUGS_UID']))
	header('Location:../index.php?page=login');

function display_about($smarty) {
	header('Location:../index.php?page=about');
}

function display_admin($smarty) {
	global $cms;
	$smarty->assign('page', 'admin');

	$articles = $cms->get_articles();
	$published = 0;
	$unpublished = 0;
	foreach ($articles as $a) {
		if ($a->get_status() == ARTICLE_ACTIVE)
			$published++;
		if ($a->get_status() == ARTICLE_INACTIVE)
			$unpublished++;
	}
	$smarty->assign('published', $published);
	$smarty->assign('unpublished', $unpublished);
	$smarty->assign('total', $published + $unpublished);

	$events = $cms->get_events();
	$smarty->assign('upcoming', count($events));
	if (count($events) > 0)
		$smarty->assign('next_event', $events[0]);

	$smarty->display('admin.tpl');
}

/* single edit */
function display_edit_article($smarty) {
	global $cms;
	$smarty->assign('page', 'edit');
	if (isset($_GET['id']))
		$article = $cms->get_article($_GET['id']);
	else
		$article = $cms->get_new_article();
	$smarty->assign('article', $article);
	$smarty->display('edit_article.tpl');
}

function display_edit_event($smarty) {
	global $cms;
	$smarty->assign('page', 'edit');
	if (isset($_GET['id']))
		$event = $cms->get_event($_GET['id']);
	else
		$event = $cms->get_new_event();
	$smarty->assign('event', $event);
	$smarty->display('edit_event.tpl');
}

function display_edit_profile($smarty) {
	$smarty->assign('page', 'edit');
	$smarty->display('edit_profile.tpl');
}

function display_events($smarty) {
	header('Location:../index.php?page=events');
}

function display_events_dash($smarty) {
	global $cms;
	$smarty->assign('page', 'events admin');
	$events = $cms->get_events();
	$smarty->assign('events', $events);
	$smarty->display('events_dash.tpl');
}

/* full list */
function display_articles($smarty) {
	global $cms;
	$smarty->assign('page', 'pages');
	$smarty->assign('articles', $cms->get_articles());
	$smarty->display('articles.tpl');
}

function display_article($smarty) {
	if (isset($_GET['id']))
		header('Location:../index.php?id='.$_GET['id']);
	else
		header('Location:../index.php');
}

function display_preview($smarty) {
	global $cms;
	$smarty->assign('page', 'preview');
	$article = $cms->get_article($_GET['id']);
	$smarty->assign('article', $article);
	$smarty->display('article.tpl');
}

$cms->register_page('about', 'display_about');
$cms->register_page('admin', 'display_admin');
$cms->register_page('article', 'display_article');
$cms->register_page('articles', 'display_articles');
$cms->register_page('edit_article', 'display_edit_article');
$cms->register_page('edit_event', 'display_edit_event');
$cms->register_page('edit_profile', 'display_edit_profile');
$cms->register_page('events', 'display_events');
$cms->register_page('events_dash', 'display_events_dash');
$cms->register_page('home', 'display_article');
$cms->register_page('preview', 'display_preview');

$cms->display();

?>
