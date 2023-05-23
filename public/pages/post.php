<?php

$query = "SELECT * FROM categories";
$stmt = $pdo->prepare( $query );
$stmt->execute();
$categories = $stmt->fetchAll();
// var_dump($categories);

$query = "SELECT post_title, post_date, post_content, user_login as author
FROM posts
LEFT JOIN users ON posts.post_author = users.id
WHERE posts.id = " . $_GET['id'];

$stmt = $pdo->prepare( $query );
$stmt->execute();
$post = $stmt->fetch();
// var_dump($posts);

?>

<div class="post">
	<div class="post-card-content">
		<h3 class="post-card-title"><?php echo $post->post_title; ?></h3>
		<p><?php echo $post->author .' - '. $post->post_date; ?></p>
		<?php echo $post->post_content; ?>
	</div>
</div>
