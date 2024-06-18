<?php

require_once 'includes/has_session.php';
require_once '../../config/database.php';

$page = "posts-list";

$query = "SELECT p.id, p.title, p.status, p.created_at, u.username
FROM posts p
LEFT JOIN users u ON p.user_id = u.id";

$statement = $pdo->prepare( $query );
$statement->execute();
$posts = $statement->fetchAll();

// $pdo = null;
