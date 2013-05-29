<?php

require_once(__DIR__.'/BugsDB.class.php');
require_once(__DIR__.'/LoremIpsum.class.php');
require_once(__DIR__.'/Smarty.class.php');

include_once(__DIR__.'/../functions/plugins.php');

session_start();

date_default_timezone_set('Europe/London');

define('CONFIG', 'bugscms.conf');
define('DEFAULT_ARTICLE_STATUS', ARTICLE_INACTIVE);

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

		/* setup navbar */
		$this->smarty->assign('logged_in', isset($_SESSION['BUGS_UID']));
		if (isset($_SESSION['BUGS_UID']))
			$this->smarty->assign('user', $this->db->get_user($_SESSION['BUGS_UID']));

		/* process action */
		switch ($action) {
			case 'login':
				$this->login();
				break;
			case 'logout':
				$this->logout();
				break;
			case 'update_event':
				$this->update_event();
				break;
			case 'update_page':
				$this->update_page();
				break;
			case 'update_profile':
				$this->update_profile();
				break;
			case 'publish':
				$this->publish();
				break;
			case 'unpublish':
				$this->unpublish();
				break;
			case 'set_about':
				$this->set_about();
				break;
			case 'delete_article':
				$this->delete_article();
				break;
			case 'delete_event':
				$this->delete_event();
				break;
			default:
				if ($action != '') {
					$this->display_error('Invalid action request', $page);
					return;
				}
				break;
		}

		/* process page */
		try {
			if (array_key_exists($page, $this->pages)) {
				$this->pages[$page]($this->smarty);
			} else {
				$this->display_error('Invalid page requested', $page);
			}
		} catch (Exception $e) {
			switch (get_class($e)) {
				default:
					$this->display_error($e->getMessage(), $page);
					break;
			}
		}
	}

	public function get_article($id) {
		$article = $this->db->get_article($id);
		if ($article->get_status() == ARTICLE_DELETED)
			throw new BugsCMSException('404 Page not found');
		if ($article->get_status() == ARTICLE_INACTIVE &&
			!isset($_SESSION['BUGS_UID']))
			throw new BugsCMSException('404 Page not found');
		return $article;
	}

	public function get_about_article() {
		return $this->db->get_about_article();
	}

	public function get_new_article() {
		$id = $this->db->get_next_article_id();
		$user = $this->db->get_user($_SESSION['BUGS_UID']);
		return new Article($id, 'Title', htmlspecialchars('<p>Put your content here</p>'), $user, DEFAULT_ARTICLE_STATUS);
	}

	public function get_top_article() {
		return $this->db->get_top_article();
	}

	public function get_articles() {
		return $this->db->get_articles();
	}

	public function has_next($article) {
		return $this->db->has_next_article($article->get_id());	
	}

	public function next($article) {
		return $this->db->next_article($article->get_id());
	}

	public function has_prev($article) {
		return $this->db->has_prev_article($article->get_id());
	}

	public function prev($article) {
		return $this->db->prev_article($article->get_id());
	}

	public function get_events() {
		$events = array();
		foreach($this->db->get_events() as $event) {
			if ($event->get_status() > 0)
				array_push($events, $event);
		}
		return $events;
	}

	public function get_event($id) {
		$event = $this->db->get_event($id);
		if ($event->get_status() == 0)
			throw new BugsCMSException('Event expired');
		return $event;
	}

	public function get_new_event() {
		$id = $this->db->get_next_event_id();
		$date = "2013-31-08 05:00";
		return new Event($id, htmlspecialchars('Location'), $date, '', 1);
	}

	public function get_map_locations() {
		$events = $this->get_events();
		$location = "";
		foreach ($events as $event) {
			$location = $location."%7C".urlencode(htmlspecialchars_decode($event->get_location(), ENT_QUOTES));
		}
		return $location;
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
		$s->registerPlugin("function", "escape_quotes", "escape_quotes");

		return $s;
	}

	/* creates the BugsDB instance */
	private function init_db() {
		$db = new BugsDB(__DIR__.'/../'.$this->smarty->getConfigVars('db_name'));
		if (!$db->exists())
			$db->create_db('admin', 'password', 'email');
		return $db;
	}

	private function display_error($message, $page) {
		$error = array();
		$error['message'] = $message;
		$error['page'] = $page;
		if (isset($_GET['id']))
			$error['id'] = $_GET['id'];
		if (isset($_GET['action']))
			$error['action'] = $_GET['action'];

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
		header('Location:index.php?page=home');
	}

	private function update_event() {
		$id = $_POST['id'];
		$location = $_POST['location'];
		$date = $_POST['date'];
		$comment = $_POST['comment'];
		$status = $_POST['status'];
		$event = new Event($id, $location, $date, $comment, $status);
		$this->db->update_event($event);
		header('Location:index.php?page=events');
	}

	private function update_page() {
		$id = $_POST['id'];
		$title = htmlspecialchars($_POST['title']);
		$body = htmlspecialchars($_POST['body']);
		$author = $this->db->get_user($_SESSION['BUGS_UID']);
		$status = $_POST['status'];
		$article = new Article($id, $title, $body, $author, $status);
		$this->db->update_article($article);
		header('Location:index.php?page=article&id='.$id);
	}

	private function update_profile() {
		$id = $_POST['id'];
		$user = $this->db->get_user($id);
		$success = true;

		$email = $_POST['email'];
		$user->set_email($email);

		if (isset($_POST['new']) && $_POST['new'] != '') {
			$current = sha1($_POST['current']);
			$new = sha1($_POST['new']);
			$check = sha1($_POST['check']);
		
			if ($user->get_password() != $current)
				$success = false;
			if ($new != $check)
				$success = false;

			$user->set_password($new);
		}
		$this->db->update_user($user);

		if ($success)
			header('Location:index.php?page=admin');
		else
			header('Location:index.php?page=edit_profile');
	}

	private function publish() {
		if (!isset($_GET['id']))
			$this->display_error('No id specified', 'publish');
		$article = $this->db->get_article($_GET['id']);
		$article->set_status(ARTICLE_ACTIVE);
		$this->db->update_article($article);
		header('Location:../index.php?page=article&id='.$article->get_id());
	}

	private function unpublish() {
		if (!isset($_GET['id']))
			$this->display_error('No id specified', 'unpublish');
		$article = $this->db->get_article($_GET['id']);
		$article->set_status(ARTICLE_INACTIVE);
		$this->db->update_article($article);
		header('Location:index.php?page=articles');
	}

	private function set_about() {
		if (!isset($_GET['id']))
			$this->display_error('No id specified', 'set_about');
		// unset the old about
		$article = $this->db->get_about_article();
		$article->set_status(ARTICLE_INACTIVE);
		$this->db->update_article($article);

		$article = $this->db->get_article($_GET['id']);
		$article->set_status(ARTICLE_ABOUT);
		$this->db->update_article($article);
		header('Location:index.php?page=about');
	}

	private function delete_article() {
		if (!isset($_GET['id']))
			$this->display_error('No id specified', 'delete');
		$article = $this->db->get_article($_GET['id']);
		$article->set_status(ARTICLE_DELETED);
		$this->db->update_article($article);
		header('Location:index.php?page=articles');
	}

	private function delete_event() {
		if (!isset($_GET['id']))
			$this->display_error('No id specified', 'delete');
		$event = $this->db->get_event($_GET['id']);
		$event->set_status(0);
		$this->db->update_event($event);
		header('Location:index.php?page=events_dash');
	}

}

?>
