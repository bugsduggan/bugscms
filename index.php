<?php

require_once('includes/BugsCMS.class.php');

function display_admin($smarty) {
	header('Location:admin');
}

function display_home($smarty) {
	$smarty->assign('page', 'home');
	$smarty->display('home.tpl');
}

function display_login($smarty) {
	$smarty->assign('page', 'login');
	$smarty->display('login.tpl');
}

$cms = new BugsCms();

$cms->register_page('admin', 'display_admin');
$cms->register_page('home', 'display_home');
$cms->register_page('login', 'display_login');

$cms->display();

?>
