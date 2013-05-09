<?php

require_once('includes/BugsDB.class.php');

$db = new BugsDB('data.db');

if (!$db->exists())
	$db->create_db('admin', 'password', 'email');

$user = $db->get_user(1);

echo '<p>'.$user->get_id().'</p>';
echo '<p>'.$user->get_username().'</p>';
echo '<p>'.$user->get_password().'</p>';
echo '<p>'.$user->get_email().'</p>';
echo '<p>'.$user->is_admin().'</p>';

?>
