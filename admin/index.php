<?php

session_start();

if (!isset($_SESSION['BUGS_UID']))
	header('Location:../index.php');

echo 'admin page';

?>
