<?php

require_once 'includes/has_session.php';
require_once '../../config/database.php';

$query = "SELECT c.id, c.name
FROM categories c";

$statement = $pdo->prepare( $query );
$statement->execute();
$categories = $statement->fetchAll();

// $pdo = null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bioblog</title>
	<link rel="stylesheet" href="../assets/css/reset.css">
	<link rel="stylesheet" href="../assets/css/app.css">
</head>

<body  class="admin categorie">

	<?php include_once 'includes/header.php'; ?>

	<main>
		<section>
			<header class="admin-header">
				<h1>Catégories</h1>
			</header>

			<div class="admin-content">
				<table class="categories-list">
					<tbody>
						<?php foreach ($categories as $categorie) : ?>
							<tr class="categorie-item categorie-id-<?php echo $categorie['id']; ?>">
								<td>
									<form action="data/category_update.php" method="POST">
										<input type="hidden" name="category_id" value="<?php echo $categorie['id']; ?>">
										<input type="text" name="category_name" value="<?php echo $categorie['name']; ?>">
										<div>
											<button type="submit" data-click="update">Modifier</button>
											<button type="button" data-click="delete">Supprimer</button>
										</div>
									</form>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

			<aside class="admin-sidebar">
				<form action="data/category_add.php" method="POST">
					<label for="category_name">Ajouter une catégorie</label>
					<input id="category_name" type="text" name="category_name" placeholder="Nom">
					<button type="submit" class="button-primary button-small button">Créer la catégorie</button>
				</form>
			</aside>
		</section>
	</main>

	<aside class="modal">
		<form action="data/category_delete.php" method="POST">
			<input type="hidden" name="category_id" value="">
			<h2>Êtes vous sur de vouloir supprimer ?</h2>
			<p>Attention, cette action est définitive et irréversible.</p>
			<button type="button" class="button-primary button-cancel button" data-click="close">Annuler</button>
			<button type="submit" class="button-primary button-delete button" data-click="drop">Supprimer</button>
		</form>
	</aside>

	<?php // include_once 'includes/footer.php'; ?>

	<script src="../assets/js/app.js"></script>

</body>
</html>
