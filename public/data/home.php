<?php

/**
 * TODO:
 * Check que la pagination ne soit pas infinie
 * Faire le bon nombre de lien de pagination (footer ol)
 */

require_once 'includes/functions.php';
require_once '../config/database.php';

$page = 'home';

// Nombre de posts à afficher
$num_posts = 6;
$has_categorie_id = $_GET['categorie'] ?? null;

// Récupère le nombre total de posts présent dans la db
if ( $has_categorie_id ) {
	$query = "SELECT count(p.id) as n
	FROM posts p
	LEFT JOIN categories_posts cp ON p.id = cp.post_id
	LEFT JOIN categories c ON cp.categorie_id = c.id
	WHERE c.id = :categorie_id";
} else {
	$query = "SELECT count(p.id) as n
	FROM posts p";
}

$statement = $pdo->prepare( $query );
if ( $has_categorie_id ) {
	$statement->bindValue(':categorie_id', $_GET['categorie']);
}
$statement->execute();
$total_posts = $statement->fetch(); // $total_posts['n']

// Calcul de si la pagination est nécessaire
$pagination = ( ceil( $total_posts['n'] / $num_posts ) + 1 );

// Check si il y a de la pagination active si pas alors je suis en pagination 1 par défaut
$p = ( isset( $_GET['p'] ) ) ? $_GET['p'] : 1;

// Redirige si on est trop haut dans la pagination ou trop bas par la réalité
if ($p == 0 || $p > $pagination) {
	header("Location: /index.php");
	exit;
}

// Utile pour la pagination
// ! bien lui retirer 1 unité pour commencer à 0 (array start at 1 :D)
// FIXME: Check $p == 1 everywhere
if ($p == 1) {
	$offset = 1;
} else {
	$offset = ($num_posts * $p);
}

/**
 * On récupère tous les articles/posts avec une pagination déjà en place
 * et je positionne mon offset à 0 (en retirant 1 de base)
 * Je vérifie également que le filtre n'est pas déjà positionné sur une catégorie spécifique.
 */

if ( $has_categorie_id ) {
	$query = 'SELECT *
	FROM posts p
	LEFT JOIN categories_posts cp ON p.id = cp.post_id
	LEFT JOIN categories c ON cp.categorie_id = c.id
	WHERE c.id = :categorie_id';
	// . 'LIMIT ' . $num_posts . ' OFFSET ' . ($offset - 1);
} else {
	$query = 'SELECT *
	FROM posts p
	LEFT JOIN categories_posts cp ON p.id = cp.post_id
	LEFT JOIN categories c ON cp.categorie_id = c.id
	LIMIT ' . $num_posts . ' OFFSET ' . ($offset - 1);
}

$statement = $pdo->prepare( $query );
if ( $has_categorie_id ) {
	$statement->bindValue(':categorie_id', $_GET['categorie']);
}
$statement->execute();
$posts = $statement->fetchAll();

$query = 'SELECT *
FROM categories c';
$statement = $pdo->prepare( $query );
$statement->execute();
$categories = $statement->fetchAll();

// $pdo = null;
