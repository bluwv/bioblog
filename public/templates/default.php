<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="../assets/css/style.css">

	<meta property="og:title" content="The Rock" />
	<meta property="og:type" content="video.movie" />
	<meta property="og:url" content="https://www.imdb.com/title/tt0117500/" />
	<meta property="og:image" content="https://ia.media-imdb.com/images/rock.jpg" />
</head>

<body>
	<article class="site">
		<header class="site-header">
			<div class="site-nav">
				<a href="index.php">Bioblog</a>
				<nav class="main-nav menu">
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
</body>
</html>
