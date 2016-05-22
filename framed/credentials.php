<?php
try{
	$user = 'SomePrettyPerson';
	$password = 'VYDwJyyNH2haum3U';
	$db = new PDO("mysql:host=127.11.155.2;dbname=framed", $user, $password);
}
catch (PDOException $ex){
	echo 'ERROR!: ' . $ex->getMessage();
	die();
}
?>