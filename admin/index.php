<?php

require_once('../includes/BugsDB.class.php');

session_start();

if (!isset($_SESSION['BUGS_UID']))
	header('Location:../index.php?page=login');

?>
