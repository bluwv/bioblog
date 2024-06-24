<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require '../vendor/autoload.php';

use FastRoute\RouteCollector;

const ROOT = "http://bioblog.localhost";

$routes = function (RouteCollector $r) {
	$r->addRoute('GET', '/', 'home');

	$r->addRoute('GET', '/single/{id:\d+}', 'single');

	// $r->addRoute('GET', '/admin', 'login');
	// $r->addRoute('GET', '/register', 'register');
	// $r->addRoute('GET', '/users', 'users');
	// $r->addRoute('GET', '/posts-list', 'postsList');
	// $r->addRoute('GET', '/categories', 'categories');

	// $r->addRoute('GET', '/posts-edit/{id:\d+}', 'postsEdit');
};

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
	$uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = \FastRoute\simpleDispatcher($routes)->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
	case FastRoute\Dispatcher::NOT_FOUND:
		http_response_code(404);
		// include 'home.php';
		break;
	case FastRoute\Dispatcher::FOUND:
		$handler = $routeInfo[1];
		$vars = $routeInfo[2];
		call_user_func($handler, $vars);
		break;
}

function home() {
	require_once 'home.php';
}

function single($vars) {
	include 'single.php';
}
