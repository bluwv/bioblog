<?php

$query = "SELECT * FROM categories";
$stmt = $pdo->prepare( $query );
$stmt->execute();
$categories = $stmt->fetchAll();
// var_dump($categories);

$query = "SELECT post_title, post_date, post_content, user_login as author, post_thumbnail
FROM posts
LEFT JOIN users ON posts.post_author = users.id
WHERE posts.id = " . $_GET['id'];

$stmt = $pdo->prepare( $query );
$stmt->execute();
$post = $stmt->fetch();
// var_dump($posts);

?>

<div class="single single-post">
	<img class="thumbnail" src="../uploads/<?php echo $post->post_thumbnail; ?>" alt="">
	<h3 class="title"><?php echo $post->post_title; ?></h3>
	<p class="infos">Publié le <?php echo date_format( date_create( $post->post_date ), "d.m.Y" ) .' par '. $post->author; ?></p>
	<p><?php echo $post->post_content; ?></p>
</div>
