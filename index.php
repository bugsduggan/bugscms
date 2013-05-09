<?php

require_once('includes/BugsDB.class.php');
require_once('includes/Smarty.class.php');

date_default_timezone_set('UTC');

/*
 * setup smarty
 */
$smarty = new Smarty();

$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');
$smarty->setCacheDir('cache');
$smarty->setConfigDir('configs');

$smarty->error_reporting = E_ALL & ~E_NOTICE;

/*
 * setup db
 */
$db = new BugsDB('data.db');

if (!$db->exists())
	$db->create_db('admin', 'password', 'email');

/*
 * load page
 */
$page = (isset($_GET['page']) ? $_GET['page'] : 'home');

if ($page == 'home') {
	try {
		$user = $db->get_user(1);
		$smarty->assign('user', $user);
	} catch (Exception $e) {
		$page = 'error.tpl';
	}
}

try {
	$smarty->display($page.'.tpl');
} catch (Exception $e) {
	$smarty->display('error.tpl');
}

?>
