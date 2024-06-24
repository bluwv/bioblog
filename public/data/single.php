<?php

require_once 'includes/functions.php';
require_once '../config/database.php';

$page = 'single';

/**
 * On check que l'url possède bien un ?id= en argument GET
 * et si l'ID est bien existant dans la base de donnée
 * alors on affiche le template autrement on redirige vers la homepage
 */

$post_id = $vars['id'] ?? null; // $_GET['id']

$query = "SELECT id
FROM posts p
WHERE p.id = :post_id";
$statement = $pdo->prepare( $query );
$statement->bindValue( ':post_id', $post_id );
$statement->execute();
$post_exist = $statement->fetch();


$query = "SELECT *
FROM posts p
WHERE p.id NOT IN (SELECT id FROM posts WHERE id = :post_id)
LIMIT 5";
$statement = $pdo->prepare( $query );
$statement->bindValue( ':post_id', $post_id );
$statement->execute();
$post_linked = $statement->fetchAll();

// $query = "SELECT *
// FROM posts p
// LEFT JOIN categories_posts cp ON p.id = cp.post_id
// LEFT JOIN categories c ON cp.categorie_id = c.id
// WHERE p.id = :post_id AND p.id NOT IN (SELECT id FROM posts WHERE id = :post_id)";
// $statement = $pdo->prepare( $query );
// $statement->bindValue( ':post_id', $post_id );
// $statement->execute();
// $posts_linked = $statement->fetchAll();
// var_dump($posts_linked);

// var_dump(empty($posts_linked));

if (!$post_exist) {
	// header('Location: index.php');
}

/**
 * Si ID alors commencer à récupérer le contenu et remplir le template
 */

$query = "SELECT title, content, thumbnail, created_at, username
FROM posts p
LEFT JOIN users u ON p.user_id = u.id
WHERE p.id = :post_id";
$statement = $pdo->prepare( $query );
$statement->bindValue( ':post_id', $post_id );
$statement->execute();
$post = $statement->fetch();
