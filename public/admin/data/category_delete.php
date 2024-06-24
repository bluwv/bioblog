<?php

require_once '../App/Categorie.php';
$categorie = new Categorie;

if ( $_POST ) {

	$categorie->deleteCategorie( $_POST['category_id'] );

}
