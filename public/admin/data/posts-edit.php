<?php

require_once 'includes/has_session.php';
require_once '../../config/database.php';

$page = "posts-edit";

$post_id = $_GET['id'] ?? ''; // equivalent de : $_GET['id'] ? $_GET['id'] : '';

if ( $_POST ) {
	$post = $_POST;

	$post_status = (isset($post['status']) && $post['status'] == 'on') ? 1 : 0;

	// INSERT INTO
	if ( isset( $post['publish'] ) ) {
		$query = "INSERT INTO posts (title, content, status, user_id, created_at, updated_at)
		VALUE (:title, :content, :status, :user_id, NOW(), NOW())";

		$statement = $pdo->prepare( $query );
		$statement->bindValue( ':title', $post['title'] );
		$statement->bindValue( ':content', $post['content'] );
		$statement->bindValue( ':status', $post_status );
		$statement->bindValue( ':user_id', $_SESSION['current_user']['id'] );
		$statement->execute();

		$new_id = $pdo->lastInsertId();

		// foreach ($post['categorie'] as $categorie_id) {
			$query = "INSERT INTO categories_posts (post_id, categorie_id)
			VALUE (:post_id, :categorie_id)";

			$statement = $pdo->prepare( $query );
			$statement->bindValue( ':post_id', $new_id );
			$statement->bindValue( ':categorie_id', $post['categorie'] );
			$statement->execute();
		// }

		header('Location: posts-edit.php?id=' . $new_id);
	}

	// UPDATE
	if ( isset( $post['update'] ) && ! empty( $post_id ) ) {
		$query = "UPDATE posts p
		SET p.title = :title, p.content = :content, p.status = :status, p.updated_at = NOW()
		WHERE p.id = " . $post_id;

		$statement = $pdo->prepare( $query );
		$statement->bindValue( ':title', $post['title'] );
		$statement->bindValue( ':content', $post['content'] );
		$statement->bindValue( ':status', $post_status );
		$statement->execute();

		if ( isset( $post['categorie'] ) ) {
			$query = "UPDATE categories_posts
			SET categorie_id = :categorie_id
			WHERE post_id = " . $post_id;

			$statement = $pdo->prepare( $query );
			$statement->bindValue( ':categorie_id', $post['categorie'] );
			$statement->execute();
		}
	}

	// DELETE
	if ( isset( $post['delete'] ) && ! empty( $post_id ) ) {
		$query="DELETE FROM posts
		WHERE id = " . $post_id;

		$statement = $pdo->prepare( $query );
		$statement->execute();

		header('Location: posts-list.php');
	}
}

if ( isset( $post_id ) && ! empty ( $post_id ) ) {
	$query = "SELECT p.id as post_id, p.title, p.content, p.status, p.thumbnail, p.user_id, p.created_at, p.updated_at, c.id as categorie_id, c.name
	FROM posts p
	LEFT JOIN categories_posts cp ON cp.post_id = p.id
	LEFT JOIN categories c ON c.id = cp.categorie_id
	WHERE p.id = " . $post_id;

	$statement = $pdo->prepare( $query );
	$statement->execute();
	$post = $statement->fetch();
}

$query = "SELECT c.id, c.name
FROM categories c
LEFT JOIN categories_posts cp ON cp.post_id = c.id";

$statement = $pdo->prepare( $query );
$statement->execute();
$categories = $statement->fetchAll();
