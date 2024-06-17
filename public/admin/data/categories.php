<?php

require_once 'includes/has_session.php';
require_once '../../config/database.php';

$page = "categorie";

$query = "SELECT c.id, c.name
FROM categories c";

$statement = $pdo->prepare( $query );
$statement->execute();
$categories = $statement->fetchAll();

// $pdo = null;
