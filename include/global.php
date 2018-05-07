<?php
    require_once 'config.php';
	require_once 'classes/UserTools.class.php';
	require_once 'classes/DB.class.php';



$db = new database(HOST,USER,PASS,DB);
session_start();
$userTools = new UserTools();


if(isset($_SESSION['logged_in'])) {
	$user = unserialize($_SESSION['login']);
	$_SESSION['login'] = serialize($userTools->get($login->id));
}

 ?>