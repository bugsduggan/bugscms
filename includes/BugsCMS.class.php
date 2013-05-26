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
		
	private $pages = array();
	private $default = null;

	private $smarty = null;
	private $db = null;

	public function __construct($default='home') {
		$this->default = $default;
		$this->smarty = $this->init_smarty();
		$this->db = $this->init_db();
	}

	public function register_page($page_tag, $page_function) {
		$this->pages[$page_tag] = $page_function;
	}

	/* this right here is the main fella */
	public function display() {
		/* grab GET data */
		$action = (isset($_GET['action']) ? $_GET['action'] : '');
		$page = (isset($_GET['page']) ? $_GET['page'] : $this->default);
		$action = htmlspecialchars($action);
		$page = htmlspecialchars($page);

		/* process action */
		switch ($action) {
			case 'login':
				$this->login();
				break;
			case 'logout':
				$this->logout();
				break;
			case 'update_page':
				$this->update_page();
				break;
			default:
				// do nothing
				break;
		}

		/* setup navbar */
		$this->smarty->assign('logged_in', isset($_SESSION['BUGS_UID']));

		/* process page */
		try {
			if (array_key_exists($page, $this->pages)) {
				$this->pages[$page]($this->smarty);
			} else {
				$error = array();
				$error['message'] = 'Invalid page requested';
				$error['page'] = $page;
				$this->display_error($error);
			}
		} catch (Exception $e) {
			switch (get_class($e)) {
				case 'SmartyException':
					$error = array();
					$error['message'] = $e->getMessage();
					$error['page'] = $page;
					$this->display_error($error);
					break;
				case 'BugsDBException':
					$error = array();
					$error['message'] = $e->getMessage();
					$error['page'] = $page;
					if (isset($_GET['id']))
						$error['id'] = $_GET['id'];
					$this->display_error($error);
					break;
				default:
					throw($e);
					break;
			}
		}
	}

	public function get_article($id) {
		return $this->db->get_article($id);
	}

	public function get_new_article() {
		$id = $this->db->get_top_article()->get_id() + 1;
		$user = $this->db->get_user($_SESSION['BUGS_UID']);
		return new Article($id, 'Title', '<p>Put your content here</p>', $user, true);
	}

	public function get_top_article() {
		return $this->db->get_top_article();
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

	private function display_error($error) {
		$this->smarty->assign('page', 'error');
		$this->smarty->assign('error', $error);
		$this->smarty->display('error.tpl');	
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

	private function update_page() {
		$id = $_POST['id'];
		$title = $_POST['title'];
		$body = $_POST['body'];
		$author = $this->db->get_user($_SESSION['BUGS_UID']);
		$article = new Article($id, $title, $body, $author, true);
		$this->db->update_article($article);
		header('Location:index.php?page=home');
	}

}

?>
