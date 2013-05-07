<?php

/*
 * content generator
 */
function generate_page($tag) {
	$page = array();

	switch ($tag) {
		case 'home':
			$page['tag'] = $tag;
			$page['template'] = 'master.tpl';
			break;
		case 'install':
			$page['tag'] = $tag;
			$page['template'] = 'install.tpl';
			$page['form_action'] = 'install';
			break;
		case 'error':
			$page['tag'] = $tag;
			$page['template'] = 'error.tpl';
			$page['error'] = generate_error((isset($_GET['errno']) ? $_GET['errno'] : -1),
																			(isset($_GET['errmsg']) ? $_GET['errmsg'] : 'UNKNOWN_ERROR'));
			break;
		default:
			$page['tag'] = 'error';
			$page['template'] = 'error.tpl';
			$page['error'] = generate_error(404, 'PAGE_NOT_FOUND');
			break;
	}

	$page['navbar'] = generate_navbar();
	if (is_logged_in()) $page['user'] = get_user();
	return $page;
}

function generate_navbar() {
	global $config;
	$navbar = array();

	$navbar['default'] = array('link' => 'index.php', 'text' => $config['site_name']);
	$navbar['item'] = array(array('active' => 'true', 'link' => 'index.php', 'text' => 'home'));
	$navbar['login_action'] = 'login';
	$navbar['logout_action'] = 'logout';

	return $navbar;
}

function generate_error($errno=-1, $errmsg='UNKNOWN_ERROR', $errlink_text='Home', $errlink='index.php') {
	$error = array();

	$error['errno'] = $errno;
	$error['errmsg'] = $errmsg;
	$error['errlink'] = $errlink;
	$error['errlink_text'] = $errlink_text;

	return $error;
}

/*
 * user & admin functions
 */
function login() {
	global $config;

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	if (auth($username, $password))
		header('Location:index.php?page=admin');
	else
		header('Location:index.php');
}

function auth($username, $password) {
	global $config;
	$success = false;

	$db = new SQLite3($config['db_name']);
	$result = $db->querySingle(
		"SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."'",
		true);
	if ($result['username'] == $username && $result['password'] == $password) {
		session_regenerate_id();
		$_SESSION['BUGS_UID'] = $result['uid'];
		$success = true;
	}

	$db->close();
	return $success;
}

function logout() {
	session_destroy();
	header('Location:index.php');
}

function is_logged_in() {
	return (isset($_SESSION['BUGS_UID']) ? true : false);
}

function is_admin() {
	return true;
}

function get_user() {
	$user = array();

	if (is_logged_in()) {
		$uid = $_SESSION['BUGS_UID'];

		$user['uid'] = $uid;
	}

	return $user;
}

/*
 * install functions
 */
function install_db() {
	global $config;

	$username = $_POST['username'];
	$password = sha1($_POST['password']);
	$email = $_POST['email'];

	$db = new SQLite3($config['db_name']);
	$db->exec("CREATE TABLE users (uid INTEGER PRIMARY KEY, username TEXT NOT NULL, password TEXT NOT NULL, email TEXT NOT NULL)");
	$db->exec("INSERT INTO users VALUES(1, '".$username."', '".$password."', '".$email."')");

	$db->close();
	if (auth($username, $password))
		header('Location:index.php?page=admin');
	else
		header('Location:index.php');
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
