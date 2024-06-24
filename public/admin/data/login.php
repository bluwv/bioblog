<?php

require_once '../App/Admin.php';
$admin = new Admin;

if ( $_POST ) {

	$admin->loginUser();

}
