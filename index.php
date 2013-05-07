<?php

/*
 * setup & includes
 */
require_once('includes/LoremIpsum.class.php');
require_once('includes/Smarty.class.php');

require_once('functions.php');

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
$page = generate_page($page_tag);

/*
 * plugins
 */
$smarty->registerPlugin("function", "lorem_ipsum", "lorem_ipsum");

/* 
 * display template
 */
$smarty->assign('page', $page);
$smarty->display($page['template']);

?>
