<?php
require_once 'includes/has_session.php';
require_once 'App/Post.php';
require_once 'App/Categorie.php';

$page = "posts-edit";

$post = new Post;
$categories = new Categorie;
$post_data = $post->getPost();
ob_start(); ?>

<section class="admin-header">
	Ajouter un nouvel article
</section>

<section class="admin-content">
	<form action="" method="POST">
		<div>
			<div class="form-row">
				<label class="title" for="title">Titre de l’article</label>
				<input id="title" type="text" name="title" placeholder="Titre de l'article" value="<?php echo (isset($post_data['title'])) ? $post_data['title'] : ''; ?>">
			</div>

			<div class="form-row">
				<label class="title" for="content">Contenu de l’article</label>
				<textarea id="content" name="content" placeholder="Contenu de l’article"><?php echo $post_data['content'] ?? ''; ?></textarea>
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
					<option value="0" <?php echo ( isset( $post_data['status'] ) && $post_data['status'] == 0 ) ? 'selected' : ''; ?>>Brouillon</option>
					<option value="1" <?php echo ( isset( $post_data['status'] ) && $post_data['status'] == 1 ) ? 'selected' : ''; ?>>Publié</option>
				</select> -->

				<div>
					<div>
						<input id="status" type="checkbox" name="status" <?php echo ( isset( $post_data['status'] ) && $post_data['status'] == 1 ) ? 'checked' : ''; ?>>
						<label for="status">Publié</label>
					</div>
				</div>
			</div>

			<div class="form-row --checkbox">
				<h3 class="title">Catégorie de l’article</h3>

				<div>
					<?php foreach ( $categories->getCategories() as $categorie ) : ?>
						<div>
							<input id="categorie-<?php echo $categorie['id']; ?>" type="radio" name="categorie" value="<?php echo $categorie['id']; ?>" <?php echo ( isset( $post_data['categorie_id'] ) && $post_data['categorie_id'] == $categorie['id'] ) ? 'checked' : ''; ?>>
							<label for="categorie-<?php echo $categorie['id']; ?>"><?php echo $categorie['name']; ?></label>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</form>

	<div class="form-row">
		<?php if ( isset( $post_data['thumbnail'] ) && ! empty( $post_data['thumbnail'] ) ) : ?>
			<form action="data/file_remove.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
				<img src="../uploads/<?php echo $post_data['thumbnail']; ?>" alt="">
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

<?php
$content = ob_get_clean();
require 'views/layout/admin.php';
?>
