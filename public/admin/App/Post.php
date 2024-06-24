<?php

require_once '/Users/adrienpierre/Sites/bioblog/public/admin/App/Database.php';

class Post {
	private $pdo;
	private $post_id;

	public function __construct()
	{
		$this->pdo = Database::getInstance()->getConnection();

		$this->post_id = $_GET['id'] ?? '';
	}

	public function getPosts()
	{
		try {
			$query = "SELECT p.id, p.title, p.status, p.created_at, u.username
			FROM posts p
			LEFT JOIN users u ON p.user_id = u.id";

			$statement = $this->pdo->prepare( $query );
			$statement->execute();
			return $statement->fetchAll();
		} catch(PDOException $exception) {
			echo 'Query error: ' . $exception->getMessage();
		}
	}

	public function getPost()
	{
		try {
			if ( isset( $this->post_id ) && ! empty ( $this->post_id ) ) {
				$query = "SELECT p.id as post_id, p.title, p.content, p.status, p.thumbnail, p.user_id, p.created_at, p.updated_at, c.id as categorie_id, c.name
				FROM posts p
				LEFT JOIN categories_posts cp ON cp.post_id = p.id
				LEFT JOIN categories c ON c.id = cp.categorie_id
				WHERE p.id = " . $this->post_id;

				$statement = $this->pdo->prepare( $query );
				$statement->execute();
				return $statement->fetch();
			}
		} catch(PDOException $exception) {
			echo 'Query error: ' . $exception->getMessage();
		}
	}

	public function addPost( )
	{
		try {

		} catch(PDOException $exception) {
			echo 'Query error: ' . $exception->getMessage();
		}
	}

	public function updatePost( )
	{
		try {

		} catch(PDOException $exception) {
			echo 'Query error: ' . $exception->getMessage();
		}
	}

	public function deletePost( )
	{
		try {

		} catch(PDOException $exception) {
			echo 'Query error: ' . $exception->getMessage();
		}
	}
}
