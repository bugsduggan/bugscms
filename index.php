<?php

require_once('includes/LoremIpsum.class.php');
require_once('includes/Smarty.class.php');

/*
 * setup
 */

define('CONFIG', 'setup.conf');

$smarty = new Smarty();

/* setup smarty */
$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');
$smarty->setCacheDir('cache');
$smarty->setConfigDir('configs');

/* load config */
$smarty->configLoad(CONFIG);
$config = $smarty->getConfigVars();

/*
 * plugins
 */
function lorem_ipsum($params, $smarty) {
	$generator = new LoremIpsumGenerator();
	$result = '';

	$style=(isset($params['style']) ? $params['style'] : 'paragraph');
	$count=($params['count'] ? $params['count'] : 5);
	$lorem=(isset($params['lorem']) ? $params['lorem'] : false);
	$p_size=(isset($params['p_size']) ? $params['p_size'] : 50);

	if ($style == 'single') {
		$result = $generator->getContent($wordCount=$count, $format='plain', $loremipsum=$lorem);
	} else {
		for ($i = 0; $i < $count; $i++) {
			$result = $result.$generator->getContent($wordCount=$p_size, $format='html', $loremipsum=($i == 0 ? true : false));
		}	
	}

	return $result;
}
$smarty->registerPlugin("function", "lorem_ipsum", "lorem_ipsum");

/* 
 * display template
 */
$smarty->display('master.tpl');

?>
