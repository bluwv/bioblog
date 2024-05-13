<?php
session_start();

require '../../config/database.php';

if ( ! isset($_SESSION["current_user"]) ) {
	header('Location: index.php');
}

$query = "SELECT c.id, c.name
FROM categories c";

$statement = $pdo->prepare( $query );
$statement->execute();
$categories = $statement->fetchAll();

$pdo = null;
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
				<?php foreach ($categories as $categorie) : ?>
					<tr class="categorie-id-<?php echo $categorie['id']; ?>">
						<td>
							<h3><?php echo $categorie['name']; ?></h3>
							<button>Modifier</button>
							<button>Supprimer</button>
						</td>
					</tr>
				<?php endforeach; ?>
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
