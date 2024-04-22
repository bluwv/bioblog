<?php

$dbHost = 'localhost';
$dbName = 'bioblog';
$dbUser = 'root';
$dbPassword = 'root';

try {
	$pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // FETCH_ASSOC FETCH_BOTH

	// echo "Connexion réussie !";
} catch(PDOException $e) {
	throw new PDOException("Database connection error: " . $e->getMessage());
}
