<?php

/**
 * TODO:
 * Check que la pagination ne soit pas infinie
 * Faire le bon nombre de lien de pagination (footer ol)
 */

require_once '../config/database.php';

// TODO: Mettre ceci dans un fichier functions.php à part
function limit_text($text, $limit) {
	if (str_word_count($text, 0) > $limit) {
		$words = str_word_count($text, 2);
		$pos = array_keys($words);
		$text = substr($text, 0, $pos[$limit]) . '...';
	}

	return $text;
}

// Nombre de posts à afficher
$num_posts = 1;

// Récupère le nombre total de posts présent dans la db
$query = 'SELECT count(id) as n FROM posts';
$statement = $pdo->prepare( $query );
$statement->execute();
$total_posts = $statement->fetch(); // $total_posts['n']

$pagination = (ceil( $total_posts['n'] / $num_posts ) + 1);

// Check si il y a de la pagination active si pas alors je suis en pagination 1 par défaut
$p = ( isset( $_GET['p'] ) ) ? $_GET['p'] : 1;

// Redirige si on est trop haut dans la pagination ou trop bas par la réalité
if ($p == 0 || $p > $pagination) {
	header("Location: /index.php");
	exit;
}

$offset = ($num_posts * $p);

// Récupère tous les articles/posts avec une pagination déjà en place et je positionne mon offset à 0 (en retirant 1 de base (array start at 1))
$query = 'SELECT * FROM posts LIMIT ' . $num_posts . ' OFFSET ' . ($offset - 1);
$statement = $pdo->prepare( $query );
$statement->execute();
$posts = $statement->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bioblog</title>
	<link rel="stylesheet" href="assets/css/reset.css">
	<link rel="stylesheet" href="assets/css/app.css">
</head>
<body>

	<header>
		<a href="">
			<img src="" alt="">
		</a>

		<menu>
			<li>
				<a href="">Catégorie 1</a>
			</li>
			<li>
				<a href="">Catégorie 2</a>
			</li>
			<li>
				<a href="">Catégorie 3</a>
			</li>
			<li>
				<a href="">Catégorie 4</a>
			</li>
			<li>
				<a href="">Catégorie 5</a>
			</li>
		</menu>
	</header>

	<main>
		<form action="GET">
			<label for="cat-filter">Filtrer les catégories</label>
			<select id="cat-filter" name="cat-filter">
				<option value="cat-1">Catégorie 1</option>
				<option value="cat-2">Catégorie 2</option>
				<option value="cat-3">Catégorie 3</option>
				<option value="cat-4">Catégorie 4</option>
				<option value="cat-5">Catégorie 5</option>
			</select>

			<button>Filtrer</button>
		</form>

		<section>
			<?php foreach ( $posts as $post ) : ?>
				<?php if ( $post["status"] == 1 ) : ?>
					<article id="post-<?php echo $post["id"]; ?>">
						<a href="single.php">
							<img src="assets/images/<?php echo $post["thumbnail"]; ?>" alt="">
						</a>

						<div>
							<a href="">Catégorie 1</a>
							<a href="">Catégorie 2</a>
							<a href="">Catégorie 3</a>
						</div>
						<h2>
							<a href="single.php"><?php echo $post["title"]; ?></a>
						</h2>
						<p><?php echo $post["content"]; ?></p>
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

	<script src="assets/js/app.js"></script>
</body>
</html>
