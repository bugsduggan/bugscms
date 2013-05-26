<?php

require_once('../includes/BugsCMS.class.php');

$cms = new BugsCMS('admin');

if (!isset($_SESSION['BUGS_UID']))
	header('Location:../index.php?page=login');

function display_admin($smarty) {
	global $cms;
	$smarty->assign('page', 'admin');
	$article = $cms->get_top_article();
	$smarty->assign('article', $article);
	$smarty->display('admin.tpl');
}

function display_home($smarty) {
	header('Location:../index.php');
}

$cms->register_page('admin', 'display_admin');
$cms->register_page('home', 'display_home');

$cms->display();

?>
