<?php

session_start();

if ( isset( $_SESSION['last_activity'] ) && ( time() - $_SESSION['last_activity'] > 60*60*24 ) ) {
	session_unset();
	session_destroy();
	header("Location: http://bioblog.localhost/admin");
}

$_SESSION['last_activity'] = time();

if ( ! isset($_SESSION["current_user"]) ) {
	header('Location: http://bioblog.localhost/admin');
}
