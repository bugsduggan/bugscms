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
$action = (isset($_GET['action']) ? $_GET['action'] : '');

if (!file_exists(DB_NAME))
	$page = 'install';

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

} else if ($page == 'gigs') {

	$db = new SQLite3(DB_NAME);

	$gig_data = array();

	$query = "SELECT * FROM (SELECT * FROM gigs WHERE date > date('now') ORDER BY date DESC LIMIT 10) ORDER BY date ASC";
	$result = $db->query($query);

	$row = $result->fetchArray(SQLITE3_ASSOC);
	while ($row) {
	  $gig = array(
	  	'id' => $row['id'],
  		'location' => $row['location'],
  		'date' => $row['date'],
  		'map_link' => $row['map_link'],
  		'buy_link' => $row['buy_link']
  	);
  	array_push($gig_data, $gig);
		$row = $result->fetchArray(SQLITE3_ASSOC);
	}

	$db->close();

	if (count($gig_data) > 0)
		$smarty->assign('gig_data', $gig_data);

} else if ($page == 'about') {
	
	$about = "
<p class=\"lead\">We are an acappella choir of enthusiastic singers who are mainly aged 12 to 25. We are led by Caroline Price who believes strongly that there is a singer in everyone, and an important part of the way we work is that older singers share their expertise with younger ones. Visitors have always remarked on how closely people of different ages work together.</p>

<p>The choir was formed fourteen years ago after hearing the American choir Northern Harmony. We started with just a dozen people, but today there are usually around fifty singers at our weekly rehearsals. We also run highly popular ’Singing Days‘ (workshops to encourage others to sing) and hold two 'residentials' every year, following each with a concert tour. During these, the choir members learn an entirely new repertoire in the stunning grounds of Dunfield House, Wales, after which we tour the West Midlands, always culminating in a final performance at Elmfield School, Stourbridge — the home of Stream of Sound!</p>

<p>We first started singing hymns of the early American settlers (known as shape note hymns) with their strong harmonies and fuguing sections. From there we moved onto vibrant African church and folk songs. We discovered the haunting harmonies of Bulgarian and Eastern European traditions and then the excitement of the ancient three-part songs from the Caucasian Republic of Georgia.</p>

<p>Having explored the world a little, we then started looking for our own traditions and were soon involved in exploring the pre-Victorian West Gallery hymns as well as the wealth of folk songs from these islands. Nowadays we also include Gospel, Jazz Standards, Blues, and Renaissance Madrigals... in fact, anything else that is fun to sing in harmony!</p>

<p>Although we do use written music, we also learn by ear and we always perform from memory. We've sung in all sorts of places from festivals with audiences of hundreds, to tiny churches with small congregations and all have been great fun!</p>

<p>We believe in keeping these singing traditions alive, passing our experience down to the younger generations, so that they may enjoy it as much as we have.</p>";
	$smarty->assign('about', $about);

}

if ($page == 'install' && $action == 'doinstall') {

	$db = new SQLite3(DB_NAME);

	$statements = array(
		"CREATE TABLE gigs (id INTEGER PRIMARY KEY, location TEXT NOT NULL, date TEXT NOT NULL, map_link TEXT, buy_link TEXT'')"
	);

	foreach ($statements as $stm) {
		$db->exec($stm);
	}

	$db->close();

	header('Location:index.php');
} else {

	$smarty->assign('page', $page);
	$smarty->display($page.'.tpl');

}

?>
