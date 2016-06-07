<?php
session_start();
require 'credentials.php';

$firstName = htmlspecialchars($_POST['firstName']);
$lastName = htmlspecialchars($_POST['lastName']);
$userName = htmlspecialchars($_POST['userName']);
$password = htmlspecialchars($_POST['password']);
$verify = htmlspecialchars($_POST['verify']);

if ($password != $verify) {
	$_SESSION['invalid'] = TRUE;
	header('location: newUserInfo.php');
	die('Should have been relocated to newUserInfo.php');
}

$stmt = $db->prepare('INSERT INTO user (userName, password, firstName, lastName)
						VALUES (:userName, :password, :firstName, :lastName)');
$stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
$stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
$stmt->execute();	
	
$stmt = $db->prepare('SELECT * FROM user WHERE firstName = :firstName');
$stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
$stmt->execute();
$valid = $stmt->fetchALL(PDO::FETCH_ASSOC);

foreach ($valid as $val) {
	echo $val['firstName'] . " " . $val['lastName'];
	$_SESSION['newUser'] = $val['firstName'] . " " . $val['lastName'];
}	

header('location: login.php');
die('Should have been relocated to login.php');
?>