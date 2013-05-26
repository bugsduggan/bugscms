<?php

require_once('../includes/BugsCMS.class.php');

if (!isset($_SESSION['BUGS_UID']))
	header('Location:../index.php?page=login');

$cms = new BugsCMS();
$cms->display();

?>
