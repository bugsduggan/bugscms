<?php

require_once('includes/BugsCMS.class.php');

$cms = new BugsCms();

function display_about($smarty) {
	global $cms;
	$smarty->assign('page', 'about');
	$article = $cms->get_about_article();
	$smarty->assign('article', $article);
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

function display_article($smarty) {
	global $cms;
	if (isset($_GET['id'])) {
		$smarty->assign('page', 'article');
		$article = $cms->get_article($_GET['id']);
	} else {
		$smarty->assign('page', 'home');
		$article = $cms->get_top_article();
	}
	if ($article->get_status() == 2) {
		header('Location:index.php?page=about');
	}
	$smarty->assign('article', $article);
	$smarty->display('article.tpl');
}

function display_login($smarty) {
	$smarty->assign('page', 'login');
	$smarty->display('login.tpl');
}

$cms->register_page('about', 'display_about');
$cms->register_page('admin', 'display_admin');
$cms->register_page('article', 'display_article');
$cms->register_page('articles', 'display_articles');
$cms->register_page('edit_article', 'display_edit_article');
$cms->register_page('home', 'display_article');
$cms->register_page('login', 'display_login');

$cms->display();

?>
