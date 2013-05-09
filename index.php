<?php

require_once('includes/BugsDB.class.php');

date_default_timezone_set('UTC');

$db = new BugsDB('data.db');

if (!$db->exists())
	$db->create_db('admin', 'password', 'tom@tomleaman.co.uk');

$user = $db->get_user(1);
$article = $db->add_article('title', 'subtitle', 'body', 1, '2013-11-11', 1);

?>

<!DOCYTYPE html>
<html lang="en">
	<head>
		<title>Debug</title>
	</head>
	<body>
		<p><?php echo $user->username; ?></p>
		<p><?php echo $article->title; ?></p>
		<p><?php echo $article->author->username; ?></p>
	</body>
</html>
