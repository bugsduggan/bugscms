<?php

require_once('../includes/BugsCMS.class.php');

if (!isset($_SESSION['BUGS_UID']))
	header('Location:../index.php?page=login');

function display_admin($smarty) {
	$smarty->assign('page', 'admin');
	$smarty->display('admin.tpl');
}

function display_home($smarty) {
	header('Location:../index.php');
}

$cms = new BugsCMS('admin');

$cms->register_page('admin', 'display_admin');
$cms->register_page('home', 'display_home');

$cms->display();

?>
