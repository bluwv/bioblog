<?php

// Variables config db
$dbHost = 'localhost';
$dbName = 'bioblog';
$user = 'root';
$pass = 'root';

// Options connexion db
$dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
$options = array(
	PDO::ATTR_PERSISTENT => true,
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // FETCH_ASSOC pour tableau ou FETCH_OBJ pour annotation sous forme d'objet
);

// Tentative de connexion db
try {
	$pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
	throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
