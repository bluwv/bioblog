<?php

require '../config/database.php';

$query = "SELECT c.id, c.name
FROM categories c";

$statement = $pdo->prepare( $query );
$statement->execute();
$categories = $statement->fetchAll();

$pdo = null;

?>

<header class="site-header">
	<a class="logo" href="index.php">
		<img src="assets/images/logo-bioblog.png" alt="">
	</a>

	<menu>
		<?php foreach ($categories as $categorie) : ?>
			<li>
				<a href="?categorie=<?php echo $categorie['id']; ?>"><?php echo $categorie['name']; ?></a>
			</li>
		<?php endforeach; ?>
	</menu>
</header>
