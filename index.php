<?php

require_once('includes/LoremIpsum.class.php');
require_once('includes/Smarty.class.php');

include('functions/sandbox.php');
include('functions/pageloader.php');

session_start();

date_default_timezone_set('UTC');

define('CONFIG', 'setup.conf');

$smarty = new Smarty();

$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');
$smarty->setCacheDir('cache');
$smarty->setConfigDir('configs');

$smarty->configLoad(CONFIG);
$config = $smarty->getConfigVars();

define('DB_NAME', $config['db_name']);

if ($config['debug'] == 'true') {
	ini_set('display_errors', 'On');
	$smarty->assign('debug', true);
}

$page = (isset($_GET['page']) ? $_GET['page'] : 'home');
$action = (isset($_GET['action']) ? $_GET['action'] : '');

if (!file_exists(DB_NAME))
	$page = 'install';
if ($page == 'admin')
	header('Location:admin');

prepare_page($smarty, $page);
if ($config['footer'] != '')
	$smarty->assign('footer', $config['footer']);

if ($page == 'install' && $action == 'doinstall' && !file_exists(DB_NAME)) {
	create_db();
} else if ($action == 'login') {
	login();	
} else if ($action == 'logout') {
	logout();
} else {
	show_page($smarty, $page);
}

?>
