<?php

require_once '../App/Categorie.php';
$categorie = new Categorie;

if ( $_POST ) {

	$categorie->addCategorie( $_POST['category_name'] );

}
