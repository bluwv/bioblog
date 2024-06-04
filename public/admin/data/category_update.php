<?php

require '../../../config/database.php';

if ( $_POST ) {

	$post = $_POST;

	$query = "UPDATE categories c
	SET c.name = :name
	WHERE c.id = " . $post['category_id'];

	$statement = $pdo->prepare( $query );
	$statement->bindValue( ':name', $post['category_name'] );
	$statement->execute();

	// header("Refresh:0");
	header("Location: http://bioblog.localhost/admin/categories.php");

}
