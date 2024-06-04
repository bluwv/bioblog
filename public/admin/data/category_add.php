<?php

require '../../../config/database.php';

if ( $_POST ) {

	$query = "INSERT INTO categories (name)
	VALUE (:name)";

	$statement = $pdo->prepare( $query );
	$statement->bindValue( ':name', $_POST['category_name'] );
	$statement->execute();

	// header("Refresh:0");
	header("Location: http://bioblog.localhost/admin/categories.php");

}
