<?php

require_once('includes/BugsDB.class.php');
require_once('includes/Smarty.class.php');

class BugsCmsException extends Exception { }

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
$action = (isset($_GET['action']) ? $_GET['action'] : '');
$page = (isset($_GET['page']) ? $_GET['page'] : 'home');

try {
	
	if ($action != '')
		process_action($action);

	$smarty->assign('page', $page);
	prepare_page($smarty, $page);

	$smarty->display($page.'.tpl');

} catch (Exception $e) {
	switch(get_class($e)) {
		case 'BugsCmsException':
		case 'BugsDBException':
		case 'SmartyCompilerException':
		case 'SmartyException':
			$error = array(
				'message' => $e->getMessage(),
				'page_requested' => $page
			);
			if (isset($_GET['action']))
				$error['action'] = $_GET['action'];
			if (isset($_GET['id']))
				$error['id'] = $_GET['id'];

			$page = 'error';
			$smarty->assign('error', $error);
			$smarty->assign('page', $page);
			$smarty->display('error.tpl');
			break;
		default:
			throw($e);
	}
}

function process_action($action) {
	throw new BugsCmsException('Invalid action request');
}

function prepare_page($smarty, $page) {
	if ($page == 'master' || $page == 'blank')
		throw new BugsCmsException('Invalid page request');
	if ($page == 'home')
		prepare_home($smarty);
}

function prepare_home($smarty) {
	global $db;
	$smarty->assign('user', $db->get_user(isset($_GET['id']) ? $_GET['id'] : 1));
}

?>
