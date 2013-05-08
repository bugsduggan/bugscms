<?php

require_once('../includes/Smarty.class.php');

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

define('DB_NAME', $config['db_name']);

if ($config['debug'] == 'true') {
	ini_set('display_errors', 'On');
	$smarty->assign('debug', true);
}

$page = (isset($_GET['page']) ? $_GET['page'] : 'admin');
$action = (isset($_GET['action']) ? $_GET['action'] : '');

if (!isset($_SESSION['BUGS_UID']))
	header('Location:../index.php?page=login');
if ($page == 'home')
	header('Location:../index.php');

if ($action == 'logout') {
	logout();
} else {
	$smarty->assign('page', $page);
	$smarty->display('admin-master.tpl');
}

function logout() {
	session_destroy();
	header('Location:../index.php');
}

?>
