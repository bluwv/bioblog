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
$query = "SELECT c.id, c.name
FROM categories c";

$stmt = $pdo->prepare( $query );
$stmt->execute();
$categories = $stmt->fetchAll();

/**
 * Check si le post est existant via le paramètre ID de l'url
 * Si oui load cet article
 * Si pas créer un nous article
 */
if ( isset( $_GET['id'] ) ) {
	$post_id = $_GET['id'];

	// Requête SQL post
	$query = "SELECT p.post_title, p.post_date, p.post_content, p.post_thumbnail, c.id as c_id, u.user_login as author
	FROM posts p
	LEFT JOIN categorie_post cp ON p.id = cp.id_post
	LEFT JOIN categories c ON cp.id_categorie = c.id
	LEFT JOIN users u ON p.post_author = u.id
	WHERE p.id = :post_id";

	$stmt = $pdo->prepare( $query );
	$stmt->bindValue(":post_id", $post_id);
	$stmt->execute();
	$post = $stmt->fetch();

	if ( ! $post ) {
		header('Location: index.php?page=posts-edit');
	}
}

/**
 * Check si les valeurs sont existantes via des conditions ternaires.
 * Si oui, affiche les datas. Si non, affiche du vide.
 */
$thumbnail = ( isset( $post->post_thumbnail ) ) ?  '../uploads/' . $post->post_thumbnail : "";
$title = ( isset( $post->post_title ) ) ? $post->post_title : "";
$content = ( isset( $post->post_content ) ) ? $post->post_content : "";
$date = ( isset( $post->post_date ) ) ? date_format( date_create( $post->post_date ), "d/m/Y H:i:s" ) : date("d/m/Y H:i");
$author = ( isset( $post->author ) ) ? $post->author : $_SESSION['current_session']['user_login'];

/**
 * L'utilisateur fait l'action d'envoyer le form et ses données
 * On va check si l'utilisateur veut ajouter, modifier ou supprimer les datas.
 */
if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
	// Test des input
	$title = test_input( $_POST['post_title'] );
	$content = test_input( $_POST['post_content'] );
	$author = $_SESSION["current_session"]["user_id"];
	$date = date('Y-m-d H:i:s');
	$status = isset( $_POST['publish'] ) ? "publish" : "draft";
	$thumbnail = $_FILES["fileToUpload"]["name"];
	$post_categorie = $_POST['post_categorie'];

	// die($_POST);

	// On supprime le post existant
	if ( isset( $_POST['delete'] ) ) {

		$post_id =  $_GET['id'];

		$query = "DELETE FROM `posts`
		WHERE id = :post_id";

		$stmt = $pdo->prepare( $query );
		$stmt->bindValue(":post_id", $post_id);
		$stmt->execute();

		$message = "Record deleted successfully.";
		header('Location: index.php?page=posts-list');

	} else if ( isset( $_POST['publish'] ) ) {

		if ( isset( $_GET['id'] ) ) {

			$post_id =  $_GET['id'];

			$query = "UPDATE posts p, categorie_post cp
			SET
				p.post_title = :post_title,
				p.post_content = :post_content,
				p.post_status = :post_status,
				p.post_thumbnail = :post_thumbnail,
				cp.id_categorie = :id_categorie
			WHERE p.id = cp.id_post AND p.id = :post_id
			";
			$stmt = $pdo->prepare( $query );
			$stmt->bindValue(":post_title", $title);
			$stmt->bindValue(":post_content", $content);
			$stmt->bindValue(":post_status", $status);
			$stmt->bindValue(":post_thumbnail", $thumbnail);
			$stmt->bindValue(":post_id", $post_id);
			$stmt->bindValue(":id_categorie", $post_categorie);
			$stmt->execute();

			$message = "Record published successfully.";

		} else {

			$query = "INSERT INTO posts (post_title, post_content, post_author, post_status, post_date, post_thumbnail)
			VALUES (:post_title, :post_content, :post_author, :post_status, :post_date, :post_thumbnail)";
			$stmt = $pdo->prepare( $query );
			$stmt->bindValue(":post_title", $title);
			$stmt->bindValue(":post_content", $content);
			$stmt->bindValue(":post_author", $author);
			$stmt->bindValue(":post_status", $status);
			$stmt->bindValue(":post_date", $date);
			$stmt->bindValue(":post_thumbnail", $thumbnail);
			$stmt->execute();

			$query = "INSERT INTO categorie_post (id_post, id_categorie)
			VALUES(LAST_INSERT_ID(), :id_categorie)";
			$stmt = $pdo->prepare( $query );
			$stmt->bindValue(":id_categorie", $post_categorie);
			$stmt->execute();

			$message = "New record created and published successfully.";

		}

	} else if ( isset( $_POST['submit'] ) ) {

		// try {
		if ( isset( $_GET['id'] ) ) {

			$post_id =  $_GET['id'];

			$query = "UPDATE posts p, categorie_post cp
			SET
				p.post_title = :post_title,
				p.post_content = :post_content,
				p.post_status = :post_status,
				p.post_thumbnail = :post_thumbnail,
				cp.id_categorie = :id_categorie
			WHERE p.id = cp.id_post AND p.id = :post_id
			";
			$stmt = $pdo->prepare( $query );
			$stmt->bindValue(":post_title", $title);
			$stmt->bindValue(":post_content", $content);
			$stmt->bindValue(":post_status", $status);
			$stmt->bindValue(":post_thumbnail", $thumbnail);
			$stmt->bindValue(":post_id", $post_id);
			$stmt->bindValue(":id_categorie", $post_categorie);
			$stmt->execute();

			$message = "Record updated successfully.";

		} else {

			$query = "INSERT INTO posts (post_title, post_content, post_author, post_status, post_date, post_thumbnail)
			VALUES (:post_title, :post_content, :post_author, :post_status, :post_date, :post_thumbnail)";
			$stmt = $pdo->prepare( $query );
			$stmt->bindValue(":post_title", $title);
			$stmt->bindValue(":post_content", $content);
			$stmt->bindValue(":post_author", $author);
			$stmt->bindValue(":post_status", $status);
			$stmt->bindValue(":post_date", $date);
			$stmt->bindValue(":post_thumbnail", $thumbnail);
			$stmt->execute();

			$query = "INSERT INTO categorie_post (id_post, id_categorie)
			VALUES(LAST_INSERT_ID(), :id_categorie)";
			$stmt = $pdo->prepare( $query );
			$stmt->bindValue(":id_categorie", $post_categorie);
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

		<form action="index.php?page=posts-edit<?php echo ( isset( $_GET["id"] ) ) ? '&id='.$_GET["id"] : ''; ?>" method="POST" enctype="multipart/form-data">
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
					<?php foreach ( $categories as $categorie ) :
						$selected = ( isset($post->c_id) && $categorie->id == $post->c_id ) ? ' selected' : '';
						?>
						<option value="<?php echo strtolower( $categorie->id ); ?>"<?php echo $selected; ?>><?php echo $categorie->name; ?></option>
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
