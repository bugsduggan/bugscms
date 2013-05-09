<?php

require_once('includes/Article.class.php');
require_once('includes/User.class.php');

class BugsDBException extends Exception { }

class BugsDB {

	private $db_name = null;

	public function __construct($db_name) {
		$this->db_name = $db_name;
	}

	public function exists() {
		return file_exists($this->db_name);
	}

	public function create_db($username, $password, $email, $overwrite=false) {
		if ($this->exists()) {
			if (!$overwrite)
				throw new BugsDBException($this->db_name.' already exists');
			else
				unlink($this->db_name);
		}

		$statements = array(
			"CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT NOT NULL, password TEXT NOT NULL, email TEXT NOT NULL)",
			"CREATE TABLE articles (id INTEGER PRIMARY KEY, title TEXT NOT NULL, subtitle TEXT, body TEXT NOT NULL, author_id INTEGER NOT NULL, date_created TEXT NOT NULL, status INTEGER, FOREIGN KEY (author_id) REFERENCES users (id))"
		);

		foreach ($statements as $stm)
			$this->exec($stm);

		$this->add_user($username, $password, $email);
		return $this->get_user(1);
	}

	public function add_user($username, $password, $email) {
		$id = 1 + $this->query_single("SELECT id FROM users ORDER BY id DESC LIMIT 1", false);
		$user = new User($id, $username, sha1($password), $email);
		$this->update_user($user);
		return $user;
	}

	public function get_user($id) {
		$query = "SELECT * FROM users WHERE id=$id";
		$result = $this->query_single($query);	
		return new User($result['id'], $result['username'], $result['password'], $result['email']);
	}

	public function update_user($user) {
		$stm = "INSERT OR REPLACE INTO users VALUES ($user->id, '$user->username', '$user->password', '$user->email')";
		$this->exec($stm);
		return $this->get_user($user->id);
	}

	public function add_article($title, $subtitle, $body, $author_id, $date_created, $status) {
		$id = 1 + $this->query_single("SELECT id FROM articles ORDER BY id DESC LIMIT 1", false);
		$author = $this->get_user($author_id);
		$article = new Article($id, $title, $subtitle, $body, $author, $date_created, $status);
		$this->update_article($article);
		return $article;
	}

	public function get_article($id) {
		$query = "SELECT * FROM articles WHERE id=$id";
		$result = $this->query_single($query);
		$author = $this->get_user($result['author_id']);
		return new Article($result['id'], $result['title'], $result['subtitle'], $result['body'], $author, $result['date_created'], $result['status']);
	}

	public function update_article($article) {
		$stm = "INSERT OR REPLACE INTO articles (id, title, subtitle, body, author_id, date_created, status) VALUES ($article->id, '$article->title', '$article->subtitle', '$article->body', ".$article->author->id.", '$article->date_created', $article->status)";
		$this->exec($stm);
		return $this->get_article($article->id);
	}

	private function exec($stm) {
		$db = new SQLite3($this->db_name);

		if(!$db->exec($stm))
			throw new BugsDBException('SQLite error on statement: "'.$stm.'"');

		$db->close();
	}

	private function query_single($query, $entire_row=true) {
		$db = new SQLite3($this->db_name);

		$result = $db->querySingle($query, $entire_row);

		$db->close();

		return $result;
	}

}

?>
