<?php

if ( ! isset( $_SESSION['current_session'] ) ) {
	header('Location: index.php?page=login');
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);

	return $data;
}

if ( isset( $_GET['id'] ) ) {
	// Requête SQL catégories
	$query = "SELECT post_title, post_date, post_content, user_login as author
	FROM posts
	LEFT JOIN users ON posts.post_author = users.id
	WHERE posts.id = " . $_GET['id'];
	$stmt = $pdo->prepare( $query );
	$stmt->execute();
	$post = $stmt->fetch();

	if ( ! $post ) {
		header('Location: index.php?page=posts-edit');
	}
}

$title = ( isset( $post->post_title ) ) ? $post->post_title : "";
$content = ( isset( $post->post_content ) ) ? $post->post_content : "";

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
	$title = test_input( $_POST['post_title'] );
	$content = test_input( $_POST['post_content'] );
	$author = $_SESSION["current_session"]["user_id"];
	$date = date('Y-m-d H:i:s');
	$status = isset( $_POST['publish'] ) ? "publish" : "draft";

	if ( isset( $_POST['delete'] ) ) {

		$query = "DELETE FROM `posts`
		WHERE id = ?";
		$stmt = $pdo->prepare( $query );
		$stmt->execute( array( $_GET['id'] ) );

		$message = "Record deleted successfully.";
		header('Location: index.php?page=posts-list');

	} else if ( isset( $_POST['publish'], $_POST['post_title'], $_POST['post_content'] ) ) {

		if ( isset( $_GET['id'] ) ) {

			$post_id =  $_GET['id'];

			$query = "UPDATE `posts`
			SET `post_title` = :post_title, `post_content` = :post_content, `post_status` = :post_status
			WHERE `id` = :post_id";
			$stmt = $pdo->prepare( $query );
			$stmt->bindValue(":post_title", $title);
			$stmt->bindValue(":post_content", $content);
			$stmt->bindValue(":post_status", $status);
			$stmt->bindValue(":post_id", $post_id);
			$stmt->execute();

			$message = "Record published successfully.";

		} else {

			$query = "INSERT INTO `posts` (post_title, post_content, post_author, post_status, post_date)
			VALUES ('$title', '$content', '$author', '$status', '$date')";
			$stmt = $pdo->prepare( $query );
			$stmt->execute();

			$message = "New record created and published successfully.";

		}

	} else if ( isset( $_POST['submit'], $_POST['post_title'], $_POST['post_content'] ) ) {

		// try {
		if ( isset( $_GET['id'] ) ) {

			$post_id =  $_GET['id'];

			$query = "UPDATE `posts`
			SET `post_title` = :post_title, `post_content` = :post_content, `post_status` = :post_status
			WHERE `id` = :post_id";
			$stmt = $pdo->prepare( $query );
			$stmt->bindValue(":post_title", $title);
			$stmt->bindValue(":post_content", $content);
			$stmt->bindValue(":post_status", $status);
			$stmt->bindValue(":post_id", $post_id);
			$stmt->execute();

			$message = "Record updated successfully.";

		} else {

			$query = "INSERT INTO `posts` (post_title, post_content, post_author, post_status, post_date)
			VALUES ('$title', '$content', '$author', '$status', '$date')";
			$stmt = $pdo->prepare( $query );
			$stmt->execute();

			$message = "New record created successfully.";

		}
		// } catch ( \PDOException $e ) {
		// 	echo $e->getMessage();
		// }

	}
}

?>

<div class="edit">
	<article>
		<form action="" method="POST">
			<div class="form-row">
				<label for="post_thumbnail">Mon thumbnail</label>
				<input id="post_thumbnail" class="" type="file" name="post_thumbnail" >
			</div>

			<div class="form-row">
				<label for="post_title">Mon titre</label>
				<input id="post_title" class="" type="text" name="post_title" placeholder="Mon super titre" value="<?php echo $title; ?>">
			</div>

			<div class="form-row">
				<label for="post_content">Mon contenu</label>
				<textarea id="post_content" class="" name="post_content" placeholder="Mon super contenu"><?php echo $content; ?></textarea>
			</div>

			<div class="form-row">
				<button type="submit" name="submit" value="draft">Sauver</button>
				<button type="submit" name="publish" value="publish">Publier</button>
				<button type="submit" name="delete">Supprimer</button>
			</div>

			<?php if ( ! empty( $message ) ) : ?>
				<div class="form-row">
					<p class="error"><?php echo $message; ?></p>
				</div>
			<?php endif; ?>
		</form>
	</article>
</div>
