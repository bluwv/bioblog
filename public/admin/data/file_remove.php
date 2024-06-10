<?php

require '../../../config/database.php';

if ( $_POST ) {

	$query="UPDATE posts
	SET thumbnail = ''
	WHERE id = " . $_POST['post_id'];

	$statement = $pdo->prepare( $query );
	$statement->execute();

	// header("Refresh:0");
	header("Location: http://bioblog.localhost/admin/posts-edit.php?id=" . $_POST['post_id']);

}
