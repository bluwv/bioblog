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
	$page = 'login';
}

// Initialisation du templating
ob_start();
if ( $page === 'login' ) {
	require ROOT . '/admin/pages/login.php';
} else if ( $page === 'logout' ) {
	require ROOT . '/admin/pages/logout.php';
} else if ( $page === 'posts-edit' ) {
	require ROOT . '/admin/pages/posts-edit.php';
} else if ( $page === 'posts-list' ) {
	require ROOT . '/admin/pages/posts-list.php';
} else if ( $page === 'categories-list' ) {
	require ROOT . '/admin/pages/categories-list.php';
} else if ( $page === 'users-list' ) {
	require ROOT . '/admin/pages/users-list.php';
}
$content = ob_get_clean();
require ROOT . '/admin/templates/default.php';
