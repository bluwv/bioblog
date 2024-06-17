<?php
require 'data/users.php';
ob_start(); ?>

<section class="admin-header">
	<h1>Articles</h1>
	<a class="button-primary button-small button" href="posts-edit.php">Ajouter un article</a>
</section>

<section class="admin-content">
	<table>
		<?php foreach ( $posts as $post ) :
			$status = ($post['status']) ? "Publié" : "Brouillon";
			$created_at = date("d/m/Y", strtotime($post['created_at']));
			?>
			<tr class="post-id-<?php echo $post['id']; ?>">
				<td>
					<h3>
						<a href="posts-edit.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a>
					</h3>
					<div>
						<a class="link-small link --publish" href="../single.php?id=<?php echo $post['id']; ?>">Voir l’article</a>
						<a class="link-small link --update" href="posts-edit.php?id=<?php echo $post['id']; ?>">Modifier</a>
						<button class="link-small link --delete">Supprimer</button>
					</div>
				</td>
				<td><?php echo $post['username']; ?></td>
				<td><?php echo $status; ?></td>
				<td><?php echo $created_at; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>

	<ol class="pagination">
		<li class="active">
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

<aside class="admin-sidebar">
</aside>

<?php
$content = ob_get_clean();
require 'views/layout/admin.php';
?>
