<?php

require_once('../includes/BugsCMS.class.php');

$cms = new BugsCMS('admin');

if (!isset($_SESSION['BUGS_UID']))
	header('Location:../index.php?page=login');

function display_admin($smarty) {
	$smarty->assign('page', 'admin');
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

/* full list */
function display_articles($smarty) {
	global $cms;
	$smarty->assign('page', 'pages');
	$smarty->assign('articles', $cms->get_articles());
	$smarty->display('articles.tpl');
}

function display_home($smarty) {
	header('Location:../index.php');
}

$cms->register_page('admin', 'display_admin');
$cms->register_page('articles', 'display_articles');
$cms->register_page('edit_article', 'display_edit_article');
$cms->register_page('home', 'display_home');

$cms->display();

?>
