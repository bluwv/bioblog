<?php
session_start();

if ( ! isset($_SESSION["current_user"]) ) {
	header('Location: index.php');
}
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
		<header>
			<h1>Articles</h1>
		</header>

		<section>
			<table>
				<tr>
					<td>
						<h3>
							<a href="">Titre de l’article</a>
						</h3>
						<a href="">Voir l’article</a>
						<a href="">Modifier</a>
						<button>Supprimer</button>
					</td>
					<td>Auteur</td>
					<td>Publié</td>
					<td>08/04/2024</td>
				</tr>
				<tr>
					<td>
						<h3>
							<a href="">Titre de l’article</a>
						</h3>
						<a href="">Voir l’article</a>
						<a href="">Modifier</a>
						<button>Supprimer</button>
					</td>
					<td>Auteur</td>
					<td>Publié</td>
					<td>08/04/2024</td>
				</tr>
				<tr>
					<td>
						<h3>
							<a href="">Titre de l’article</a>
						</h3>
						<a href="">Voir l’article</a>
						<a href="">Modifier</a>
						<button>Supprimer</button>
					</td>
					<td>Auteur</td>
					<td>Publié</td>
					<td>08/04/2024</td>
				</tr>
				<tr>
					<td>
						<h3>
							<a href="">Titre de l’article</a>
						</h3>
						<a href="">Voir l’article</a>
						<a href="">Modifier</a>
						<button>Supprimer</button>
					</td>
					<td>Auteur</td>
					<td>Publié</td>
					<td>08/04/2024</td>
				</tr>
				<tr>
					<td>
						<h3>
							<a href="">Titre de l’article</a>
						</h3>
						<a href="">Voir l’article</a>
						<a href="">Modifier</a>
						<button>Supprimer</button>
					</td>
					<td>Auteur</td>
					<td>Publié</td>
					<td>08/04/2024</td>
				</tr>
				<tr>
					<td>
						<h3>
							<a href="">Titre de l’article</a>
						</h3>
						<a href="">Voir l’article</a>
						<a href="">Modifier</a>
						<button>Supprimer</button>
					</td>
					<td>Auteur</td>
					<td>Publié</td>
					<td>08/04/2024</td>
				</tr>
			</table>

			<ol>
				<li>
					<a href="">1</a>
				</li>
				<li>
					<a href="">2</a>
				</li>
				<li>
					<a href="">3</a>
				</li>
			</ol>
		</section>

		<aside>
			<a href="">Créer un article</a>
		</aside>
	</main>

	<?php include_once 'includes/footer.php'; ?>

</body>
</html>
