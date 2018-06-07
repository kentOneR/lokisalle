<?php

// INIT FUNCTION 
session_start();

// SECURITY FOR SESSION
$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$_SESSION['token'] = $token;

$ticket = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));

$cookie_name = "ticket";
$cookie_value = null;
setcookie($cookie_name, $cookie_value, time() + (60 * 20)); // 20 min

$_SESSION['ticket'] = $ticket;
$_COOKIE['ticket'] = $ticket;

if (isset($_COOKIE['ticket']) && isset($_SESSION['ticket']) && $_COOKIE['ticket'] == $_SESSION['ticket']){
    $ticket = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
	$ticket = hash('sha512', $ticket);
	$_COOKIE['ticket'] = $ticket;
	$_SESSION['ticket'] = $ticket;
} else {
	// DESTROY SESSION
	$_SESSION = array();
	session_destroy();
	header('location:index.php');
}

// CONNEXION DB
try {
    $pdo = new pdo('mysql:host=localhost; dbname=lokisalle', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch(PDOException $e) {
    die('Erreur de connexion à la DB: '.$e->getMessage());
}

// CONSTANTE
define('URL', 'http://localhost/lokisalle/');


// INCLUDE FUNCTION
require_once('function.inc.php');

?>