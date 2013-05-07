<?php

/*
 * page generator
 */
function generate_page($tag) {
	$page = array();

	switch ($tag) {
		case 'home':
			$page['tag'] = $tag;
			$page['template'] = 'master.tpl';
			break;
		default:
			$page['tag'] = 'error';
			$page['template'] = 'error.tpl';
			$page['error'] = generate_error($errno=404, $msg='PAGE_NOT_FOUND');
			break;
	}

	return $page;
}

function generate_error($errno=-1, $msg='UNKNOWN_ERROR') {
	$error = array();

	$error['errno'] = $errno;
	$error['msg'] = $msg;

	return $error;
}

/*
 * smarty plugins
 */
function lorem_ipsum($params, $smarty) {
	$generator = new LoremIpsumGenerator();
	$result = '';

	$style=(isset($params['style']) ? $params['style'] : 'paragraph');
	$count=(isset($params['count']) ? $params['count'] : 5);
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

?>
