<?php

require_once('includes/Smarty.class.php');

/*
 * setup
 */

define('DEFAULT_CONFIG', 'setup.conf');

$smarty = new Smarty();

/* setup smarty */
$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');
$smarty->setCacheDir('cache');
$smarty->setConfigDir('configs');

/* load config */
$smarty->configLoad(DEFAULT_CONFIG);
$config = $smarty->getConfigVars();

/* 
 * display template
 */
$smarty->display('master.tpl');

?>
