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
			<h1>Catégories</h1>
		</header>

		<section>
			<table>
				<tr>
					<td>
						<h3>
							<a href="">Nom de la catégorie</a>
						</h3>
						<button>Modifier</button>
						<button>Supprimer</button>
					</td>
				</tr>
				<tr>
					<td>
						<h3>
							<a href="">Nom de la catégorie</a>
						</h3>
						<button>Modifier</button>
						<button>Supprimer</button>
					</td>
				</tr>
				<tr>
					<td>
						<h3>
							<a href="">Nom de la catégorie</a>
						</h3>
						<button>Modifier</button>
						<button>Supprimer</button>
					</td>
				</tr>
				<tr>
					<td>
						<h3>
							<a href="">Nom de la catégorie</a>
						</h3>
						<button>Modifier</button>
						<button>Supprimer</button>
					</td>
				</tr>
				<tr>
					<td>
						<h3>
							<a href="">Nom de la catégorie</a>
						</h3>
						<button>Modifier</button>
						<button>Supprimer</button>
					</td>
				</tr>
				<tr>
					<td>
						<h3>
							<a href="">Nom de la catégorie</a>
						</h3>
						<button>Modifier</button>
						<button>Supprimer</button>
					</td>
				</tr>
			</table>
		</section>

		<aside>
			<label for="category">Nom</label>
			<input id="category" type="text" name="category" placeholder="Nom">
			<a class="button-primary button-small button" href="">Créer la catégorie</a>
		</aside>

	</main>

	<aside class="modal">
		<div>
			<h2>Êtes vous sur de vouloir supprimer ?</h2>
			<p>Attention, cette action est définitive et irréversible.</p>
			<button class="button-cancel button">Annuler</button>
			<button class="button-delete button">Supprimer</button>
		</div>
	</aside>

	<?php include_once 'includes/footer.php'; ?>

</body>
</html>
