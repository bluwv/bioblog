<?php

if ( ! isset( $_SESSION['current_session'] ) ) {
	header('Location: index.php?page=login');
}

if ( isset( $_GET['offset'] ) ) {
	$offset = $_GET['offset'];
} else {
	$offset = 1;
}

$query = "SELECT COUNT(*) FROM posts";
$total_posts = $pdo->query( $query )->fetchColumn();

$limit_posts = 20;
$posts_per_page = ceil( $total_posts / $limit_posts );
$offset = ($offset - 1) * $limit_posts;

// var_dump($total_posts);
// var_dump($posts_per_page);
// var_dump($limit_posts);

// Requête SQL catégories
// $query = "SELECT posts.id, posts.post_content, posts.post_date, posts.post_title, posts.post_status, users.user_login, categories.name FROM posts
// LEFT JOIN users ON posts.post_author = users.id
// LEFT JOIN categorie_post ON posts.id = categorie_post.id_post
// LEFT JOIN categories ON categorie_post.id_categorie = categories.id
// ";
$query = "SELECT posts.id as slug, posts.post_date, posts.post_title, posts.post_status
FROM posts
ORDER BY posts.post_date ASC
LIMIT ". $limit_posts ." OFFSET " . $offset
;
$stmt = $pdo->prepare( $query );
$stmt->execute();
$posts = $stmt->fetchAll();

?>

<div class="posts">
	<h2 class="title">Mes articles</h2>

	<a class="button" href="index.php?page=posts-edit">Ajouter un nouvel article</a>

	<table>
		<thead>
			<tr>
				<th>Titre</th>
				<th>Status</th>
				<th>Création</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach( $posts as $post ) : ?>
				<tr>
					<td>
						<a href="index.php?page=posts-edit&id=<?php echo $post->slug; ?>">
							<?php echo $post->post_title; ?>
						</a>
					</td>
					<td>
						<?php echo $post->post_status; ?>
					</td>
					<td>
						<?php echo date_format( date_create( $post->post_date ), "d/m/Y H:i:s" ); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div>
		<?php if ( $total_posts >= $limit_posts ) : ?>
			<?php for ( $i = 1 ; $i <= $posts_per_page ; $i++ ) : ?>
				<a href="index.php?page=posts-list&offset=<?php echo $i; ?>"><?php echo $i; ?></a>
			<?php endfor; ?>
		<?php endif; ?>
	</div>
</div>
