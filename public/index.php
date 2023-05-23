<?php

// Affichage des erreurs
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Définition d'une constante
define( 'ROOT', dirname( __DIR__ ) );

// Appel de la classe et setup de la session
require ROOT . '/config/config.php';
require ROOT . '/app/App.php';
App::load();

if ( isset( $_GET['page'] ) ) {
	$page = $_GET['page'];
} else {
	$page = 'home';
}

// Initialisation du templating
ob_start();
if ( $page === 'home' ) {
	require ROOT . '/public/pages/home.php';
} else if ( $page === 'post' ) {
	require ROOT . '/public/pages/post.php';
}
$content = ob_get_clean();
require ROOT . '/public/templates/default.php';
