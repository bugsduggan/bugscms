<?php

require_once(__DIR__.'/Article.class.php');
require_once(__DIR__.'/Event.class.php');
require_once(__DIR__.'/User.class.php');

require_once(__DIR__.'/LoremIpsum.class.php');

class BugsDBException extends Exception { }

define('ARTICLE_DELETED', 0);
define('ARTICLE_INACTIVE', 1);
define('ARTICLE_ACTIVE', 2);
define('ARTICLE_ABOUT', 3);

function event_cmp($evt1, $evt2) {
	$d1 = strtotime($evt1->get_date());
	$d2 = strtotime($evt2->get_date());
	if ($d1 < $d2)
		return -1;
	else if ($d1 > $d2)
		return 1;
	else
		return 0;
}

class BugsDB {

	/* private variables */
	private $db_name = null; // the database file

	/* constructor */
	public function __construct($db_name) {
		$this->db_name = $db_name;
	}

	/*
	 * public functions
	 */

	/* returns true if the db file exists */
	public function exists() {
		return file_exists($this->db_name);
	}

	/* creates the database and adds the admin user */
	public function create_db($username, $password, $email, $overwrite=false) {
		// check if exists
		if ($this->exists()) {
			if ($overwrite) // it exists, kill it
				unlink($this->db_name);
			else
				throw new BugsDBException('Cannot write to file: '.$this->db_name);
		}

		// create table statements
		$statement = array(
			"CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT NOT NULL, password TEXT NOT NULL, email TEXT NOT NULL, status INTEGER NOT NULL)",
			"CREATE TABLE articles (id INTEGER PRIMARY KEY, title TEXT NOT NULL, body TEXT NOT NULL, author INTEGER NOT NULL, status INTEGER NOT NULL, FOREIGN KEY (author) REFERENCES users (id))",
			"CREATE TABLE events (id INTEGER PRIMARY KEY, location TEXT NOT NULL, date TEXT NOT NULL, comment TEXT, status INTEGER NOT NULL)"
		);

		// loop through and exec
		foreach ($statement as $stm)
			$this->exec($stm);

		// create admin user
		$user = $this->add_user($username, $password, $email, true);

		// create lorem article
		$lorem = new LoremIpsumGenerator();
		$body = '';
		for ($i = 0; $i < 5; $i++) {
			$body = $body.$lorem->getContent(50, 'html', false);
		}
		$this->add_article('About us', $body, $user, ARTICLE_ABOUT);

		for ($j = 1; $j <= 5; $j++) {
			$body = '';
			for ($i = 0; $i < 5; $i++) {
				$body = $body.$lorem->getContent(50, 'html', ($i == 0));
			}
			$this->add_article('Lorem ipsum '.$j, $body, $user, ARTICLE_ACTIVE);
		}

		// return the admin user
		return $user;
	}

	/* adds a user the the database and returns the user object */
	public function add_user($username, $password, $email, $admin=false) {
		// find the next id
		$id = $this->next_id('users');

		// encrypt the password
		$password = sha1($password);

		// create a user object
		$user = new User($id, $username, $password, $email, $admin);
		
		// update the database and return
		return $this->update_user($user);
	}

	/* updates or creates an entry in the users table */
	public function update_user($user) {
		// prepare variables
		$id = $user->get_id();
		$username = $user->get_username();
		$password = $user->get_password();
		$email = $user->get_email();
		if ($user->is_admin())
			$status = 1;
		else
			$status = 0;

		// prepare statement
		$stm = "INSERT OR REPLACE INTO users VALUES ($id, '$username', '$password', '$email', $status)";	

		// exec and return
		$this->exec($stm);
		return $this->get_user($user->get_id());
	}

	/* gets a user from the database */
	public function get_user($id) {
		// execute the query
		$query = "SELECT * FROM users WHERE id=$id";
		$result = $this->query_single($query);

		// error handling
		if (count($result) == 0)
			throw new BugsDBException('User not found');

		// prepare variables
		$id = $result['id'];
		$username = $result['username'];
		$password = $result['password'];
		$email = $result['email'];
		if ($result['status'] == 1)
			$admin = true;
		else
			$admin = false;

		// create and return object
		return new User($id, $username, $password, $email, $admin);
	}

	public function add_article($title, $body, $author, $status=ARTICLE_INACTIVE) {
		$id = $this->next_id('articles');
		$article = new Article($id, $title, $body, $author, $status);
		return $this->update_article($article);
	}

	public function update_article($article) {
		$id = $article->get_id();
		$title = SQLite3::escapeString($article->get_title());
		$body = SQLite3::escapeString($article->get_body());
		$author = $article->get_author()->get_id();
		$status = $article->get_status();

		$stm = "INSERT OR REPLACE INTO articles VALUES ($id, '$title', '$body', $author, $status)";

		$this->exec($stm);
		return $article;
	}

	public function get_next_article_id() {
		$query = "SELECT id FROM articles ORDER BY id DESC LIMIT 1";
		return $this->query_single($query, false) + 1;
	}

	public function has_prev_article($id) {
		$query = "SELECT id FROM articles WHERE status=".ARTICLE_ACTIVE." AND id<$id ORDER BY id DESC LIMIT 1";
		$id = $this->query_single($query, false);
		if (!$id) return false;
		return true;
	}

	public function prev_article($id) {
		$query = "SELECT id FROM articles WHERE status=".ARTICLE_ACTIVE." AND id<$id ORDER BY id DESC LIMIT 1";
		$id = $this->query_single($query, false);
		return $this->get_article($id);
	}

	public function has_next_article($id) {
		$query = "SELECT id FROM articles WHERE status=".ARTICLE_ACTIVE." AND id>$id ORDER BY id ASC LIMIT 1";
		$id = $this->query_single($query, false);
		if (!$id) return false;
		return true;
	}

	public function next_article($id) {
		$query = "SELECT id FROM articles WHERE status=".ARTICLE_ACTIVE." AND id>$id ORDER BY id ASC LIMIT 1";
		$id = $this->query_single($query, false);
		return $this->get_article($id);
	}

	public function get_article($id) {
		$query = "SELECT * FROM articles WHERE id=$id";
		$result = $this->query_single($query);

		if (count($result) == 0)
			throw new BugsDBException('Article not found');

		$id = $result['id'];
		$title = $result['title'];
		$body = htmlspecialchars_decode($result['body']);
		$author = $this->get_user($result['author']);
		$status = $result['status'];

		return new Article($id, $title, $body, $author, $status);
	}

	public function get_top_article() {
		$id = $this->next_id('articles') -1;
		$article = $this->get_article($id);
		while ($article->get_status() != ARTICLE_ACTIVE)
			$article = $this->get_article(--$id);
		return $article;
	}

	public function get_about_article() {
		$about_id = $this->query_single("SELECT id FROM articles WHERE status = ".ARTICLE_ABOUT, false);
		return $this->get_article($about_id);
	}

	public function get_articles() {
		$articles = array();
		for ($i = 1; $i < $this->next_id('articles'); $i++) {
			try {
				$article = $this->get_article($i);
				array_push($articles, $article);
			} catch (BugsDBException $e) { }
		}
		return $articles;
	}

	public function update_event($event) {
		$id = $event->get_id();
		$location = SQLite3::escapeString($event->get_location());
		$date = $event->get_date();
		$comment = SQLite3::escapeString($event->get_comment());
		$comment = str_replace("\r\n", "", $comment);
		$status = $event->get_status();

		$stm = "INSERT OR REPLACE INTO events VALUES ($id, '$location', '$date', '$comment', $status)";

		$this->exec($stm);
		return $event;
	}

	public function get_next_event_id() {
		$query = "SELECT id FROM events ORDER BY id DESC LIMIT 1";
		return $this->query_single($query, false) + 1;
	}

	public function get_event($id) {
		$query = "SELECT * FROM events WHERE id=$id";
		$result = $this->query_single($query);

		if (count($result) == 0)
			throw new BugsDBException('Event not found');

		$id = $result['id'];
		$location = $result['location'];
		$date = $result['date'];
		$comment = htmlspecialchars($result['comment'], ENT_QUOTES);
		$status = $result['status'];

		$now = date('Y-m-d h:i', time() + (2 * 60 * 60));
		if ($now > $date)
			throw new BugsDBException('Event expired');

		return new Event($id, $location, $date, $comment, $status);
	}

	public function get_events() {
		$events = array();
		for ($i = 1; $i < $this->next_id('events'); $i++) {
			try {
				$event = $this->get_event($i);
				array_push($events, $event);
			} catch (BugsDBException $e) { }
		}
		uasort($events, 'event_cmp');
		return $events;
	}

	public function get_user_by_username($username) {
		$id = $this->query_single("SELECT id FROM users WHERE username='$username'", false);
		return $this->get_user($id);
	}

	/*
	 * private functions
	 */

	/* gets the next available id from a given table */
	private function next_id($table) {
		$query = "SELECT id FROM $table ORDER BY id DESC LIMIT 1";
		return 1 + $this->query_single($query, false);
	}

	/* execs a resultless statement */
	private function exec($stm) {
		$db = new SQLite3($this->db_name);
		if (!$db->exec($stm))
			throw new BugsDBException('Failed to exec statement: \''.$stm.'\'');
	}

	/* returns a single result query */
	private function query_single($query, $entire_row=true) {
		$db = new SQLite3($this->db_name);
		$result = $db->querySingle($query, $entire_row);
		$db->close();
		return $result;
	}

}
