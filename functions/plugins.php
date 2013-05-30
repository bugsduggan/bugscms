<?php

/**
 * This is a bunch of functions to be registered with smarty
 */

function lorem_ipsum($params, $smarty) {
	$generator = new LoremIpsumGenerator();
	$result = '';

	$style=(isset($params['style']) ? $params['style'] : 'paragraph');
	$count=(isset($params['count']) ? $params['count'] : 5);
	$lorem=(isset($params['lorem']) ? $params['lorem'] : true);
	$p_size=(isset($params['p_size']) ? $params['p_size'] : 50);

	if ($style == 'single') {
		$result = ucfirst($generator->getContent($wordCount=$count, $format='plain', $loremipsum=$lorem));
	} else {
		for ($i = 0; $i < $count; $i++) {
			$result = $result.'<p>'.ucfirst($generator->getContent($wordCount=$p_size, $format='plain', $loremipsum=($i == 0 ? true : false))).'</p>';
		}	
	}

	return $result;
}

function escape_quotes($params, $smarty) {
	$input = $params['string'];
	$result = str_replace('&#039;', '\\\'', $input);
	$result = str_replace('&quot;', "\\\"", $result);
	return $result;
}

?>
