<?php

require_once(__DIR__.'/BugsDB.class.php');
require_once(__DIR__.'/LoremIpsum.class.php');
require_once(__DIR__.'/Smarty.class.php');

include_once(__DIR__.'/../functions/plugins.php');

session_start();

date_default_timezone_set('UTC');

define('CONFIG', 'bugscms.conf');

class BugsCMSException extends Exception { }

/**
 * This is the main class that does the work
 */

class BugsCMS {

	private $smarty = null;
	private $db = null;

	public function __construct() {
		$this->smarty = $this->init_smarty();
		$this->db = $this->init_db();
	}

	/* this right here is the main fella */
	public function display() {
		/* grab GET data */
		$action = (isset($_GET['action']) ? $_GET['action'] : '');
		$page = (isset($_GET['page']) ? $_GET['page'] : 'home');
		$action = htmlspecialchars($action);
		$page = htmlspecialchars($page);

		try {
			if ($action != '')
				$this->process_action($action);

			// special cases
			if ($page == 'admin')
				header('Location:admin');
			if ($page == 'error')
				throw new BugsCmsException('Error page requested');

			$this->smarty->assign('logged_in', isset($_SESSION['BUGS_UID']));
			$this->smarty->assign('page', $page);
			$this->prepare_page($page);

			$this->smarty->display($page.'.tpl');
		} catch (Exception $e) {
			switch(get_class($e)) {
				case 'BugsCMSException':
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
					$this->smarty->assign('error', $error);
					$this->smarty->assign('page', $page);
					$this->smarty->display('error.tpl');
					break;
				default:
					throw($e);
			}
		}
	}

	/* creates the smarty instance */
	private function init_smarty() {
		$s = new Smarty();

		$s->setTemplateDir(__DIR__.'/../templates');
		$s->setCompileDir(__DIR__.'/../templates_c');
		$s->setCacheDir(__DIR__.'/../cache');
		$s->setConfigDir(__DIR__.'/../configs');

		$s->error_reporting = E_ALL & ~E_NOTICE;
		$s->configLoad(CONFIG, 'globals');

		$s->registerPlugin("function", "lorem_ipsum", "lorem_ipsum");

		return $s;
	}

	/* creates the BugsDB instance */
	private function init_db() {
		$db = new BugsDB(__DIR__.'/../'.$this->smarty->getConfigVars('db_name'));
		if (!$db->exists())
			$db->create_db('admin', 'password', 'email');
		return $db;
	}

	private function process_action($action) {
		switch ($action) {
			case 'login':
				$this->login();
				break;
			case 'logout':
				$this->logout();
				break;
			default:
				throw new BugsCMSException('Invalid action request');
				break;
		}
	}

	private function prepare_page($page) {
		if ($page == 'master' || $page == 'blank')
			throw new BugsCmsException('Invalid page request');
		if ($page == 'home')
			$this->prepare_home();
	}

	private function prepare_home() {
	}

	private function login() {
		$success = true;

		if (!isset($_POST['username']))
			$success = false;
		if (!isset($_POST['password']))
			$success = false;

		$username = $_POST['username'];
		$password = sha1($_POST['password']);

		if ($success) {
			$success = false;
			$user = $this->db->get_user_by_username($username);
			if ($password == $user->get_password()) {
				$success = true;
				$this->auth($user);
			}
		}

		if ($success)
			header('Location:admin');
		else
			header('Location:index.php?page=login');
	}

	private function auth($user) {
		session_regenerate_id();
		$_SESSION['BUGS_UID'] = $user->get_id();
	}

	private function logout() {
		session_destroy();
		header('Location:index.php');
	}

}

?>
