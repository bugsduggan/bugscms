<?php

/*
 * setup & includes
 */
require_once('includes/LoremIpsum.class.php');
require_once('includes/Smarty.class.php');

session_start();

require_once('functions.php');

date_default_timezone_set('UTC');
	
/*
 * consts
 */
define('CONFIG', 'setup.conf');

/*
 * smarty
 */ 
$smarty = new Smarty();

$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');
$smarty->setCacheDir('cache');
$smarty->setConfigDir('configs');

/*
 * load config
 */
$smarty->configLoad(CONFIG);
$config = $smarty->getConfigVars();

/*
 * check for debug
 */
if ($config['debug']) {
	ini_set('display_errors', 'On');
	$smarty->assign('debug', true);
}

/*
 * generate page_tag
 */
$page_tag = (isset($_GET['page']) ? $_GET['page'] : 'home');

/*
 * init db
 */
if (!file_exists($config['db_name']))
	$page_tag = 'install';

/*
 * handle actions
 */
$action_tag = (isset($_GET['action']) ? $_GET['action'] : 'null');
switch($action_tag) {
	case 'install':
		install_db();
		break;
	case 'login':
		login();
		break;
}

/*
 * plugins
 */
$smarty->registerPlugin("function", "lorem_ipsum", "lorem_ipsum");

/* 
 * display page
 */
$page = generate_page($page_tag);
$smarty->assign('show_admin_buttons', is_logged_in() && is_admin());
$smarty->assign('page', $page);
$smarty->display($page['template']);

?>
