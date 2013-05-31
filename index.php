<?php

require_once('includes/BugsCMS.class.php');

$cms = new BugsCms();

function display_about($smarty) {
	global $cms;
	$smarty->assign('page', 'about');
	$article = $cms->get_about_article();
	$smarty->assign('article', $article);
	$smarty->assign('show_permalink', false);
	$smarty->display('article.tpl');
}

function display_admin($smarty) {
	header('Location:admin');
}

function display_articles($smarty) {
	header('Location:admin/index.php?page=articles');
}

function display_edit_article($smarty) {
	if (isset($_GET['id']))
		header('Location:admin/index.php?page=edit_article&id='.$_GET['id']);
	else
		header('Location:admin/index.php?page=edit_article');
}

function display_events($smarty) {
	global $cms;
	$smarty->assign('page', 'events');
	$events = $cms->get_events();
	$smarty->assign('events', $events);
	$smarty->assign('map_locations', $cms->get_map_locations());
	$smarty->display('events.tpl');
}

function display_events_dash($smarty) {
	header('Location:admin/index.php?page=events_dash');
}

function display_users_dash($smarty) {
	header('Location:admin/index.php?page=users_dash');
}

function display_article($smarty) {
	global $cms;

	if (isset($_GET['id'])) {
		if ($_GET['id'] == $cms->get_top_article()->get_id())
			header('Location:index.php'); // index.php?id=<home_article>
		$smarty->assign('page', 'article');
		$article = $cms->get_article($_GET['id']);
	} else {
		$smarty->assign('page', 'home');
		$article = $cms->get_top_article();
	}
	if ($article->get_status() == ARTICLE_ABOUT)
		header('Location:index.php?page=about');
	$smarty->assign('article', $article);

	// build pager data
	$smarty->assign('show_permalink', true);
	if ($cms->has_next($article))
		$smarty->assign('next', $cms->next($article));
	if ($cms->has_prev($article))
		$smarty->assign('prev', $cms->prev($article));

	$smarty->display('article.tpl');
}

function display_login($smarty) {
	$smarty->assign('page', 'login');
	$smarty->display('login.tpl');
}

function display_register($smarty) {
	$smarty->assign('page', 'register');
	$smarty->display('register.tpl');
}

$cms->register_page('about', 'display_about');
$cms->register_page('admin', 'display_admin');
$cms->register_page('article', 'display_article');
$cms->register_page('articles', 'display_articles');
$cms->register_page('edit_article', 'display_edit_article');
$cms->register_page('events', 'display_events');
$cms->register_page('events_dash', 'display_events_dash');
$cms->register_page('users_dash', 'display_users_dash');
$cms->register_page('home', 'display_article');
$cms->register_page('login', 'display_login');
if ($cms->show_login())
	$cms->register_page('register', 'display_register');

$cms->display();

?>
