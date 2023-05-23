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

$limit_posts = 3;
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
LIMIT ". $limit_posts ." OFFSET " . $offset
;
$stmt = $pdo->prepare( $query );
$stmt->execute();
$posts = $stmt->fetchAll();

?>

<div class="posts">
	<a href="index.php?page=posts-edit">Ajouter un nouvel article</a>
	<table>
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
					<?php echo $post->post_date; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>

	<div>
		<?php if ( $total_posts <= $posts_per_page ) : ?>
			<?php for ( $i = 1 ; $i <= $posts_per_page ; $i++ ) : ?>
				<a href="index.php?page=posts-list&offset=<?php echo $i; ?>"><?php echo $i; ?></a>
			<?php endfor; ?>
		<?php endif; ?>
	</div>
</div>
