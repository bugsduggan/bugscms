<?php

require_once('../includes/Smarty.class.php');

include('functions/pageloader.php');
include('functions/sandbox.php');

session_start();

date_default_timezone_set('UTC');

define('CONFIG', 'setup.conf');

$smarty = new Smarty();

$smarty->setTemplateDir('../templates');
$smarty->setCompileDir('../templates_c');
$smarty->setCacheDir('../cache');
$smarty->setConfigDir('../configs');

$smarty->configLoad(CONFIG);
$config = $smarty->getConfigVars();

define('DB_NAME', '../'.$config['db_name']);

if ($config['debug'] == 'true') {
	ini_set('display_errors', 'On');
	$smarty->assign('debug', true);
}

$page = (isset($_GET['page']) ? $_GET['page'] : 'home');
$action = (isset($_GET['action']) ? $_GET['action'] : '');

if (!file_exists(DB_NAME))
	header('Location:../index.php');
if (!isset($_SESSION['BUGS_UID']))
	header('Location:../index.php?page=login');
if ($page == 'public')
	header('Location:../index.php');

prepare_page($smarty, $page);
if ($config['footer'] != '')
	$smarty->assign('footer', $config['footer']);

if ($action == 'save_page') {
	save_page();
} else if ($action == 'save_gig') {
	save_gig();
} else if ($action == 'set_about') {
	set_about();	
} else if ($action == 'logout') {
	logout();
} else {
	show_page($smarty, $page);
}

function logout() {
	session_destroy();
	header('Location:../index.php');
}

?>
