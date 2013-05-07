<?php

require_once('includes/Smarty.class.php');

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

if ($page == 'home') {
	$top_article = array(
		'headline' => 'Top Headline',
		'body' => 'Lorem ipsum dolor sit amet',
		'link' => 'index.php',
		'link_text' => 'Click me!'
	);
	$story1 = array(
		'headline' => 'Headline 1',
		'body' => 'Lorem ipsum dolor sit amet',
		'link' => 'index.php',
		'link_text' => 'Click me!'
	);
	$story2 = array(
		'headline' => 'Headline 2',
		'body' => 'Lorem ipsum dolor sit amet',
		'link' => 'index.php',
		'link_text' => 'Click me!'
	);
	$story3 = array(
		'headline' => 'Headline 3',
		'body' => 'Lorem ipsum dolor sit amet',
		'link' => 'index.php',
		'link_text' => 'Click me!'
	);
	$smarty->assign('top_article', $top_article);
	$smarty->assign('story1', $story1);
	$smarty->assign('story2', $story2);
	$smarty->assign('story3', $story3);
}

$smarty->assign('page', $page);
$smarty->display($page.'.tpl');

?>
