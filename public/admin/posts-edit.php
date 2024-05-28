<?php
session_start();

require_once '../../config/database.php';

if ( ! isset($_SESSION["current_user"]) ) {
	header('Location: index.php');
}

$post_id = $_GET['id'] ?? '';

if ( $_POST ) {

	$post = $_POST;

	if ( isset( $post['publish'] ) ) {
		$query = "INSERT INTO posts (title, content, status, user_id, created_at, updated_at)
		VALUE (:title, :content, :status, :user_id, NOW(), NOW())";

		$statement = $pdo->prepare( $query );
		$statement->bindValue( ':title', $post['title'] );
		$statement->bindValue( ':content', $post['content'] );
		$statement->bindValue( ':status', $post['status'] );
		$statement->bindValue( ':user_id', $_SESSION['current_user']['id'] );
		$statement->execute();
	}

	if ( isset( $post['update'] ) && ! empty( $post_id ) ) {
		$query = "UPDATE posts p
		SET p.title = :title, p.content = :content, p.status = :status, p.updated_at = NOW()
		WHERE p.id = " . $post_id;

		$statement = $pdo->prepare( $query );
		$statement->bindValue( ':title', $post['title'] );
		$statement->bindValue( ':content', $post['content'] );
		$statement->bindValue( ':status', $post['status'] );
		$statement->execute();
	}

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
	WHERE p.id = " . $_GET['id'];

	$statement = $pdo->prepare( $query );
	$statement->execute();
	$post = $statement->fetch();
}

// var_dump($post);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bioblog</title>
	<link rel="stylesheet" href="../assets/css/reset.css">
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
						<label for="title">Titre de l’article</label>
						<input id="title" type="text" name="title" placeholder="Titre de l'article" value="<?php echo (isset($post['title'])) ? $post['title'] : ''; ?>">
					</div>

					<div class="form-row">
						<label for="content">Contenu de l’article</label>
						<textarea id="content" name="content" placeholder="Contenu de l’article"><?php echo $post['content'] ?? ''; ?></textarea>
					</div>

					<div class="form-row --button">
						<?php if ( isset( $post_id ) && ! empty ( $post_id ) ) : ?>
							<button class="button-primary button-small button" name="update">Modifier</button>
							<button class="link-delete link" name="delete">Supprimer</button>
						<?php else : ?>
							<button class="button-primary button-small button" name="publish">Publier</button>
						<?php endif; ?>
					</div>
				</div>

				<div>
					<div class="form-row">
						<label for="status">Statut de l’article</label>
						<select name="status" id="status">
							<option value="0" <?php echo ( isset( $post['status'] ) && $post['status'] == 0 ) ? 'selected' : ''; ?>>Brouillon</option>
							<option value="1" <?php echo ( isset( $post['status'] ) && $post['status'] == 1 ) ? 'selected' : ''; ?>>Publié</option>
						</select>
					</div>

					<div class="form-row --checkbox">
						<!-- <h3>Catégorie de l’article</h3> -->
						<div>
							<input id="categorie-2" type="radio" name="categorie" value="2" <?php echo ( isset( $post['categorie_id'] ) && $post['categorie_id'] == 2 ) ? 'checked' : ''; ?>>
							<label for="categorie-2">Astuce</label>
						</div>

						<div>
							<input id="categorie-5" type="radio" name="categorie" value="5" <?php echo ( isset( $post['categorie_id'] ) && $post['categorie_id'] == 5 ) ? 'checked' : ''; ?>>
							<label for="categorie-5">Maquillage</label>
						</div>

						<div>
							<input id="categorie-3" type="radio" name="categorie" value="3" <?php echo ( isset( $post['categorie_id'] ) && $post['categorie_id'] == 3 ) ? 'checked' : ''; ?>>
							<label for="categorie-3">Nature</label>
						</div>

						<div>
							<input id="categorie-4" type="radio" name="categorie" value="4" <?php echo ( isset( $post['categorie_id'] ) && $post['categorie_id'] == 4 ) ? 'checked' : ''; ?>>
							<label for="categorie-4">Océan</label>
						</div>

						<div>
							<input id="categorie-1" type="radio" name="categorie" value="1" <?php echo ( isset( $post['categorie_id'] ) && $post['categorie_id'] == 1 ) ? 'checked' : ''; ?>>
							<label for="categorie-1">Recette</label>
						</div>
					</div>

					<div class="form-row">
						<?php if ( isset( $post['thumbnail'] ) && ! empty( $post['thumbnail'] ) ) : ?>
							<img src="../assets/images/<?php echo $post['thumbnail']; ?>" alt="">
							<button class="button-primary button-small button">Retirer l’image</button>
						<?php else : ?>
							<label for="thumbnail">Image de l’article</label>
							<input id="thumbnail" type="file" name="thumbnail">
							<button class="button-primary button-small button">Ajouter une image</button>
						<?php endif; ?>
					</div>
				</div>
			</form>
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

</body>
</html>
