<?php
try{
	$user = 'steve';
	$password = 'nerdface';
	$db = new PDO("mysql:host=localhost;dbname=framed", $user, $password);
}
catch (PDOException $ex){
	echo 'ERROR!: ' . $ex->getMessage();
	die();
}
?>