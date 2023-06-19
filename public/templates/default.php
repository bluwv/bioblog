<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@0;1&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css/app.css">

	<meta property="og:title" content="The Rock" />
	<meta property="og:type" content="video.movie" />
	<meta property="og:url" content="https://www.imdb.com/title/tt0117500/" />
	<meta property="og:image" content="https://ia.media-imdb.com/images/rock.jpg" />
</head>

<body>
	<article class="site">
		<header class="site-header">
			<div class="site-nav">
				<a class="logo" href="index.php">
					<img src="../assets/images/logo-bioblog.png" alt="Bioblog">
				</a>

				<button class="burger" data-menu="front-menu">
					<span>Menu</span>
				</button>

				<nav id="front-menu" class="main-nav menu">
					<ul>
						<?php foreach ( $categories as $categorie ) : ?>
							<li class="menu-item">
								<a href="index.php?category_id=<?php echo $categorie->id; ?>"><?php echo $categorie->name; ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
			</div>
		</header>

		<main class="site-content">
			<?php echo $content; ?>
		</main>

		<footer class="site-footer"></footer>

	</article>

	<script src="../assets/app.js"></script>
</body>
</html>
