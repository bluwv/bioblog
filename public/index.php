<?php

/**
 * TODO:
 * Check que la pagination ne soit pas infinie
 * Faire le bon nombre de lien de pagination (footer ol)
 */

require_once 'includes/functions.php';
require_once '../config/database.php';

// Nombre de posts à afficher
$num_posts = 6;

// Récupère le nombre total de posts présent dans la db
$query = "SELECT count(id) as n
FROM posts";

$statement = $pdo->prepare( $query );
$statement->execute();
$total_posts = $statement->fetch(); // $total_posts['n']

// Calcul de si la pagination est nécessaire
$pagination = ( ceil( $total_posts['n'] / $num_posts ) + 1 );

// Check si il y a de la pagination active si pas alors je suis en pagination 1 par défaut
$p = ( isset( $_GET['p'] ) ) ? $_GET['p'] : 1;

// Redirige si on est trop haut dans la pagination ou trop bas par la réalité
if ($p == 0 || $p > $pagination) {
	header("Location: /index.php");
	exit;
}

// Utile pour la pagination
// ! bien lui retirer 1 unité pour commencer à 0 (array start at 1 :D)
// FIXME: Check $p == 1 everywhere
if ($p == 1) {
	$offset = 1;
} else {
	$offset = ($num_posts * $p);
}

// Récupère tous les articles/posts avec une pagination déjà en place et je positionne mon offset à 0 (en retirant 1 de base)
$categorie_id = $_GET['categorie'];

$query = 'SELECT *
FROM posts p
LEFT JOIN categories_posts cp ON p.id = cp.post_id
LEFT JOIN categories c ON cp.categorie_id = c.id
WHERE c.id = ' . $categorie_id;
// LIMIT ' . $num_posts . ' OFFSET ' . ($offset - 1);
$statement = $pdo->prepare( $query );
// $statement->bindValue();
$statement->execute();
$posts = $statement->fetchAll();

// $pdo = null;

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bioblog</title>
	<link rel="stylesheet" href="assets/css/app.css">
</head>

<body class="site home">

	<?php include_once 'includes/header.php'; ?>

	<main>
		<form action="" method="GET">
			<div class="form-row form-row--select">
				<label class="sr-only" for="cat-filter">Filtrer les catégories</label>
				<select id="cat-filter" name="categorie">
					<?php foreach ($categories as $categorie) :
						$selected = ( isset( $_GET['categorie'] ) && $_GET['categorie'] == $categorie['id'] ) ? 'selected' : '';
						?>
						<option value="<?php echo $categorie['id']; ?>" <?php echo $selected; ?>><?php echo $categorie['name']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<!-- <button type="submit">Filtrer</button> -->
		</form>

		<section class="posts-list">
			<?php foreach ( $posts as $post ) : ?>
				<?php if ( $post["status"] == 1 ) : // Si == 1 alors le post est publié ?>
					<article id="post-<?php echo $post["id"]; ?>" class="post-card">
						<picture class="post-card-image">
							<a href="single.php?id=<?php echo $post["id"]; ?>">
								<img src="uploads/<?php echo $post["thumbnail"]; ?>" alt="">
							</a>
						</picture>

						<div class="post-card-content">
							<div class="categories-list">
								<a href="">Catégorie 1</a>
								<a href="">Catégorie 2</a>
								<a href="">Catégorie 3</a>
							</div>

							<h2 class="title">
								<a href="single.php?id=<?php echo $post["id"]; ?>"><?php echo $post["title"]; ?></a>
							</h2>
							<p><?php echo (! empty($post["content"])) ? limit_text($post["content"], 20) : ''; ?></p>
						</div>
					</article>
				<?php endif; ?>
			<?php endforeach; ?>
		</section>

		<?php
		// Check si il y a besoin d'une pagination
		if ( $total_posts['n'] > $num_posts ) : ?>
			<ol>
				<?php for ($i = 1; $i < $pagination; $i++) : ?>
					<li>
						<a href="/?p=<?php echo $i; ?>"><?php echo $i; ?></a>
					</li>
				<?php endfor; ?>
			</ol>
		<?php endif; ?>
	</main>

	<?php // include_once 'includes/footer.php'; ?>

	<script src="assets/app.js"></script>
</body>
</html>
