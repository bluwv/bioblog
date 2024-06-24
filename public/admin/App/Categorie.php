<?php

require_once '/Users/adrienpierre/Sites/bioblog/public/admin/App/Database.php';

class Categorie {
	private $pdo;

	public function __construct()
	{
		$this->pdo = Database::getInstance()->getConnection();
	}

	public function getCategories()
	{
		try {
			$query = "SELECT c.id, c.name
			FROM categories c";

			$statement = $this->pdo->prepare( $query );
			$statement->execute();
			return $statement->fetchAll();
		} catch(PDOException $exception) {
			echo 'Query error: ' . $exception->getMessage();
		}
	}

	public function addCategorie( $name ) // $_POST['category_name']
	{
		try {
			$query = "INSERT INTO categories (name)
			VALUE (:name)";

			$statement = $this->pdo->prepare( $query );
			$statement->bindValue( ':name', $name );
			$statement->execute();

			// header("Refresh:0");
			header("Location: http://bioblog.localhost/admin/categories.php");
		} catch(PDOException $exception) {
			echo 'Query error: ' . $exception->getMessage();
		}
	}

	public function updateCategorie( $post ) // $_POST
	{
		try {
			$post = $_POST;

			$query = "UPDATE categories c
			SET c.name = :name
			WHERE c.id = " . $post['category_id'];

			$statement = $this->pdo->prepare( $query );
			$statement->bindValue( ':name', $post['category_name'] );
			$statement->execute();

			// header("Refresh:0");
			header("Location: http://bioblog.localhost/admin/categories.php");
		} catch(PDOException $exception) {
			echo 'Query error: ' . $exception->getMessage();
		}
	}

	public function deleteCategorie( $id ) // $_POST['category_id']
	{
		try {
			$query="DELETE FROM categories_posts
			WHERE categorie_id = " . $id;

			$statement = $this->pdo->prepare( $query );
			$statement->execute();

			$query="DELETE FROM categories
			WHERE id = " . $id;

			$statement = $this->pdo->prepare( $query );
			$statement->execute();

			// header("Refresh:0");
			header("Location: http://bioblog.localhost/admin/categories.php");
		} catch(PDOException $exception) {
			echo 'Query error: ' . $exception->getMessage();
		}
	}
}
