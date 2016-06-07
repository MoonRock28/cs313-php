<?php
session_start();

require 'credentials.php';

$userName = $_POST['userName'];
$password = $_POST['password'];

$stmt = $db->prepare('SELECT password, firstName, id FROM user WHERE userName = :userName');
$stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
$stmt->execute();
$check = $stmt->fetchALL(PDO::FETCH_ASSOC);

foreach($check as $word) {
	if ($word['password'] != $password){
		$_SESSION['badPassword'] = TRUE;
		header('location: login.php');
		die('Should have relocated to login.php');
	}
	//echo "Login Successful";
	$_SESSION['firstName'] = $word['firstName'];
	$_SESSION['userId'] = $word['id'];
	header('location: games.php');
	die('Should have relocated to games.php');
}
?>