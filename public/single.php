<?php

require_once '../config/database.php';

// TODO: Check que le id est existant dans la base de donnée

$post_id = $_GET['id'];

$query = "SELECT title, content, thumbnail, created_at, username
FROM posts p
LEFT JOIN users u ON p.user_id = u.id
WHERE p.id = :post_id";
$statement = $pdo->prepare( $query );
$statement->bindValue( ':post_id', $post_id );
$statement->execute();
$post = $statement->fetch();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bioblog</title>
</head>
<body>

	<?php include_once 'includes/header.php'; ?>

	<main>
		<section>
			<!-- <img src="assets/images/<?php echo $post["thumbnail"]; ?>" alt=""> -->
			<h1><?php echo $post['title']; ?></h1>
			<?php echo $post['content']; ?>
		</section>

		<aside>
			<div>
				<ul>
					<li>
						<?php $created_at = date("d/m/Y", strtotime($post['created_at'])); ?>
						<p>Publié le: <span><?php echo $created_at; ?></span></p>
					</li>
					<li>
						<p>Auteur : <span><?php echo $post['username']; ?></span></p>
					</li>
				</ul>
			</div>

			<div>
				<a href="">Catégorie 1</a>
				<a href="">Catégorie 2</a>
				<a href="">Catégorie 3</a>
			</div>

			<div>
				<h2>Articles liés</h2>

				<article>
					<h3>Titre de l'article</h3>
					<p>Contenu de l'article</p>
				</article>

				<article>
					<h3>Titre de l'article</h3>
					<p>Contenu de l'article</p>
				</article>
			</div>
		</aside>
	</main>

	<?php include_once 'includes/footer.php'; ?>

</body>
</html>
