<?php

if ( ! isset( $_SESSION['current_session'] ) ) {
	header('Location: index.php?page=login');
}

if ( isset( $_POST["submit"] ) || isset( $_POST["publish"] ) ) {
	require ROOT . '/upload.php';
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);

	return $data;
}

// Requête SQL catégories
$query = "SELECT c.name
FROM categories c";
$stmt = $pdo->prepare( $query );
$stmt->execute();
$categories = $stmt->fetchAll();

if ( isset( $_GET['id'] ) ) {
	// Requête SQL catégories
	$query = "SELECT post_title, post_date, post_content, post_thumbnail, user_login as author
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

$thumbnail = ( isset( $post->post_thumbnail ) ) ?  '../uploads/' . $post->post_thumbnail : "";
$title = ( isset( $post->post_title ) ) ? $post->post_title : "";
$content = ( isset( $post->post_content ) ) ? $post->post_content : "";
$date = ( isset( $post->post_date ) ) ? date_format( date_create( $post->post_date ), "d/m/Y H:i:s" ) : date("d/m/Y H:i");
$author = ( isset( $post->author ) ) ? $post->author : $_SESSION['current_session']['user_login'];

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
	$title = test_input( $_POST['post_title'] );
	$content = test_input( $_POST['post_content'] );
	$author = $_SESSION["current_session"]["user_id"];
	$date = date('Y-m-d H:i:s');
	$status = isset( $_POST['publish'] ) ? "publish" : "draft";
	$thumbnail = $_FILES["fileToUpload"]["name"];

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
			SET `post_title` = :post_title, `post_content` = :post_content, `post_status` = :post_status, `post_thumbnail` = :post_thumbnail
			WHERE `id` = :post_id";
			$stmt = $pdo->prepare( $query );
			$stmt->bindValue(":post_title", $title);
			$stmt->bindValue(":post_content", $content);
			$stmt->bindValue(":post_status", $status);
			$stmt->bindValue(":post_thumbnail", $thumbnail);
			$stmt->bindValue(":post_id", $post_id);
			$stmt->execute();

			$message = "Record published successfully.";

		} else {

			$query = "INSERT INTO `posts` (post_title, post_content, post_author, post_status, post_date, post_thumbnail)
			VALUES ('$title', '$content', '$author', '$status', '$date', '$thumbnail')";
			$stmt = $pdo->prepare( $query );
			$stmt->execute();

			$message = "New record created and published successfully.";

		}

	} else if ( isset( $_POST['submit'], $_POST['post_title'], $_POST['post_content'] ) ) {

		// try {
		if ( isset( $_GET['id'] ) ) {

			$post_id =  $_GET['id'];

			$query = "UPDATE `posts`
			SET `post_title` = :post_title, `post_content` = :post_content, `post_status` = :post_status, `post_thumbnail` = :post_thumbnail
			WHERE `id` = :post_id";
			$stmt = $pdo->prepare( $query );
			$stmt->bindValue(":post_title", $title);
			$stmt->bindValue(":post_content", $content);
			$stmt->bindValue(":post_status", $status);
			$stmt->bindValue(":post_thumbnail", $thumbnail);
			$stmt->bindValue(":post_id", $post_id);
			$stmt->execute();

			$message = "Record updated successfully.";

		} else {

			$query = "INSERT INTO `posts` (post_title, post_content, post_author, post_status, post_date, post_thumbnail)
			VALUES ('$title', '$content', '$author', '$status', '$date', '$thumbnail')";
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
		<a class="link link-back" href="index.php?page=posts-list">Retour aux articles</a>

		<form action="index.php?page=posts-edit&id=<?php echo $_GET["id"]; ?>" method="POST" enctype="multipart/form-data">
			<div class="form-row form-row--100">
				<label for="post_title">Mon titre</label>
				<input id="post_title" class="" type="text" name="post_title" placeholder="Mon super titre" value="<?php echo $title; ?>">
			</div>

			<div class="form-row form-row--100">
				<label for="post_content">Mon contenu</label>
				<textarea id="post_content" class="" name="post_content" placeholder="Mon super contenu"><?php echo $content; ?></textarea>
			</div>

			<div class="form-row form-row--50">
				<label for="post_thumbnail">Mon thumbnail</label>
				<input id="fileToUpload" type="file" name="fileToUpload">
				<img class="post_thumbnail" src="<?php echo $thumbnail; ?>" alt="">
			</div>

			<div class="form-row form-row--50">
				<label for="post_categorie">Ma catégorie</label>
				<select name="post_categorie" id="post_categorie">
					<?php foreach ( $categories as $categorie ) : ?>
						<option value="<?php echo strtolower( $categorie->name ); ?>"><?php echo $categorie->name; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-row form-row--100 form-row--settings">
				<button class="button button-primary" type="submit" name="submit" value="draft">Sauver</button>
				<button class="button button-secondary" type="submit" name="publish" value="publish">Publier</button>

				<?php if ( isset ( $_GET['id'] ) ) : ?>
					<button class="button button-delete" type="submit" name="delete">Supprimer</button>
				<?php endif; ?>

				<div>
					<ul>
						<li>
							<h3>Date de création</h3>
							<p><?php echo $date; ?></p>
						</li>
						<li>
							<h3>Auteur</h3>
							<p><?php echo $author; ?></p>
						</li>
					</ul>
				</div>
			</div>

			<?php if ( ! empty( $message ) ) : ?>
				<div class="form-row">
					<p class="error"><?php echo $message; ?></p>
				</div>
			<?php endif; ?>
		</form>
	</article>
</div>
