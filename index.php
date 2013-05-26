<?php

require_once('includes/BugsCMS.class.php');

$cms = new BugsCms();

function display_admin($smarty) {
	header('Location:admin');
}

function display_home($smarty) {
	global $cms;
	$smarty->assign('page', 'home');
	$article = $cms->get_top_article();
	$smarty->assign('article', $article);
	$smarty->display('home.tpl');
}

function display_login($smarty) {
	$smarty->assign('page', 'login');
	$smarty->display('login.tpl');
}

$cms->register_page('admin', 'display_admin');
$cms->register_page('home', 'display_home');
$cms->register_page('login', 'display_login');

$cms->display();

?>
