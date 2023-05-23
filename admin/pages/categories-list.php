<?php

if ( ! isset( $_SESSION['current_session'] ) ) {
	header('Location: index.php?page=login');
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);

	return $data;
}

// Requête SQL catégories
$query = "SELECT categories.name FROM categories";
$stmt = $pdo->prepare( $query );
$stmt->execute();
$categories = $stmt->fetchAll();

// function delete( $id ) {
// 	$query = "DELETE FROM `categories` WHERE id = ?";
// 	$stmt = $pdo->prepare( $query );
// 	$stmt = $stmt->execute( array( $id ) );

// 	$message = "Record deleted successfully.";
// }

// function update( $id ) {
// 	$query = "UPDATE `categories`
// 	SET `name` = :category_name
// 	WHERE `id` = :category_id";

// 	$stmt = $pdo->prepare( $query );
// 	$stmt->bindValue(":category_name", $name);
// 	$stmt->bindValue(":category_id", $id);
// 	$stmt->execute();

// 	$message = "Record updated successfully.";
// }

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
	$name = test_input( $_POST['category_name'] );

	if ( isset ( $_POST['delete'] ) ) {

		// $query = "DELETE FROM `categories` WHERE id = ?";
		// $stmt = $pdo->prepare( $query );
		// $stmt = $stmt->execute( array( /* TODO: Trouve une solution pr modifier les lignes à la volée*/ ) );

		// $message = "Record deleted successfully.";

	} else if ( isset ( $_POST['update'] ) ) {

		// $query = "UPDATE `categories`
		// SET `name` = :category_name
		// WHERE `id` = :category_id";

		// $stmt = $pdo->prepare( $query );
		// $stmt->bindValue(":category_name", $name);
		// $stmt->bindValue(":category_id", /* TODO: Trouve une solution pr modifier les lignes à la volée*/);
		// $stmt->execute();

		// $message = "Record updated successfully.";

	} else if ( isset ( $_POST['create'] ) ) {

		if ( isset ( $_POST['category_name'] ) ) {
			$query = "INSERT INTO `categories` (name)
			VALUES ('$name')";

			$stmt = $pdo->prepare( $query );
			$stmt->execute();

			$message = "New record created successfully.";
		}

	}
}

?>

<div class="categories">
	<form action="" method="POST">
		<label for="">Ajouter une nouvelle catégorie</label>
		<input type="text" name="category_name" placeholder="Ma catégorie">
		<button type="submit" name="create">Ajouter</button>

		<?php if ( ! empty( $message ) ) : ?>
			<div class="form-row">
				<p class="error"><?php echo $message; ?></p>
			</div>
		<?php endif; ?>
	</form>

	<table>
		<?php foreach( $categories as $categorie ) : ?>
			<tr>
				<td>
					<form action="" method="POST">
						<input type="text" name="category_name" value="<?php echo $categorie->name; ?>">
						<button type="submit" name="update">Modifier</button>
						<button type="submit" name="delete">Supprimer</button>
					</form>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
