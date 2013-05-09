<?php

require_once('includes/BugsDB.class.php');
require_once('includes/Smarty.class.php');

date_default_timezone_set('UTC');

define('CONFIG', 'bugscms.conf');

/*
 * setup smarty
 */
$smarty = new Smarty();

$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');
$smarty->setCacheDir('cache');
$smarty->setConfigDir('configs');

$smarty->error_reporting = E_ALL & ~E_NOTICE;

$smarty->configLoad(CONFIG, 'globals');

/*
 * setup db
 */
$db = new BugsDB($smarty->getConfigVars('db_name'));

if (!$db->exists())
	$db->create_db('admin', 'password', 'email');

/*
 * load page
 */
$page_loaded = false;

$page = (isset($_GET['page']) ? $_GET['page'] : 'home');

// catch-all error
if (!$page_loaded) {
	$page = 'error';
	$smarty->display('error.tpl');
}

?>
