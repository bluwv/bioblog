<?php

require_once '/Users/adrienpierre/Sites/bioblog/public/admin/App/Database.php';

class User {
	private $pdo;

	public function __construct()
	{
		$this->pdo = Database::getInstance()->getConnection();
	}

	public function getUsers()
	{
		try {
			$query = "SELECT u.id, u.username, u.mail
			FROM users u";

			$statement = $this->pdo->prepare( $query );
			$statement->execute();
			return $statement->fetchAll();
		} catch(PDOException $exception) {
			echo 'Query error: ' . $exception->getMessage();
		}
	}
}
