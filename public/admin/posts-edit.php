<?php

require_once 'includes/has_session.php';
require_once '../../config/database.php';

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

		$query = "UPDATE categories_posts
		SET categorie_id = :categorie_id
		WHERE post_id = " . $post_id;

		$statement = $pdo->prepare( $query );
		$statement->bindValue( ':categorie_id', $post['categorie'] );
		$statement->execute();
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
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bioblog</title>
	<link rel="stylesheet" href="../assets/css/app.css">
</head>

<body class="admin post --edit">

	<?php include_once 'includes/header.php'; ?>

	<main>
		<section class="admin-header">
			Ajouter un nouvel article
		</section>

		<section class="admin-content">
			<form action="" method="POST">
				<div>
					<div class="form-row">
						<label class="title" for="title">Titre de l’article</label>
						<input id="title" type="text" name="title" placeholder="Titre de l'article" value="<?php echo (isset($post['title'])) ? $post['title'] : ''; ?>">
					</div>

					<div class="form-row">
						<label class="title" for="content">Contenu de l’article</label>
						<textarea id="content" name="content" placeholder="Contenu de l’article"><?php echo $post['content'] ?? ''; ?></textarea>
					</div>

					<div class="form-row --button">
						<?php if ( isset( $post_id ) && ! empty ( $post_id ) ) : ?>
							<button type="submit" class="button-primary button-small button" name="update">Modifier</button>
							<button type="submit" class="link-delete link" name="delete">Supprimer</button>
						<?php else : ?>
							<button type="submit" class="button-primary button-small button" name="publish">Publier</button>
						<?php endif; ?>
					</div>
				</div>

				<div>
					<div class="form-row --checkbox">
						<h3 class="title">Statut de l’article</h3>
						<!-- <select name="status" id="status">
							<option value="0" <?php echo ( isset( $post['status'] ) && $post['status'] == 0 ) ? 'selected' : ''; ?>>Brouillon</option>
							<option value="1" <?php echo ( isset( $post['status'] ) && $post['status'] == 1 ) ? 'selected' : ''; ?>>Publié</option>
						</select> -->

						<div>
							<div>
								<input id="status" type="checkbox" name="status" <?php echo ( isset( $post['status'] ) && $post['status'] == 1 ) ? 'checked' : ''; ?>>
								<label for="status">Publié</label>
							</div>
						</div>
					</div>

					<div class="form-row --checkbox">
						<h3 class="title">Catégorie de l’article</h3>

						<div>
							<?php foreach ($categories as $categorie) : ?>
								<div>
									<input id="categorie-<?php echo $categorie['id']; ?>" type="radio" name="categorie" value="<?php echo $categorie['id']; ?>" <?php echo ( isset( $post['categorie_id'] ) && $post['categorie_id'] == $categorie['id'] ) ? 'checked' : ''; ?>>
									<label for="categorie-<?php echo $categorie['id']; ?>"><?php echo $categorie['name']; ?></label>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</form>

			<div class="form-row">
				<?php if ( isset( $post['thumbnail'] ) && ! empty( $post['thumbnail'] ) ) : ?>
					<form action="data/file_remove.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
						<img src="../uploads/<?php echo $post['thumbnail']; ?>" alt="">
						<button type="submit" class="button-primary button-small button">Retirer l’image</button>
					</form>
				<?php else : ?>
					<form action="data/file_upload.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
						<label for="thumbnail">Image de l’article</label>
						<input id="thumbnail" type="file" name="fileToUpload">
						<button type="submit" class="button-primary button-small button">Ajouter une image</button>
					</form>
				<?php endif; ?>
			</div>
		</section>

	</main>

	<aside class="modal">
		<div>
			<h2>Êtes vous sur de vouloir supprimer ?</h2>
			<p>Attention, cette action est définitive et irréversible.</p>
			<button class="button-cancel button">Annuler</button>
			<button class="button-delete button">Supprimer</button>
		</div>
	</aside>

	<?php // include_once 'includes/footer.php'; ?>
	<script src="https://cdn.tiny.cloud/1/xswlm84astace0qr6v2hdut445do9w67ky2rx4pai8d1xhbu/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			tinymce.init({
				selector: 'textarea',
				plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
				toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
			});
		});
	</script>
</body>
</html>
