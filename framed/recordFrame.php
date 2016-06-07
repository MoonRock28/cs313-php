<?php
session_start();
require 'credentials.php';

//set variables
$firstName = $_SESSION['firstName'];
$targetFirstName = $_SESSION['targetFirstName'];
$targetExterminated = $_POST['hit'];
$gameId = $_SESSION['gameId'];

//get userId
$stmt = $db->prepare('SELECT id FROM user WHERE firstName = :firstName;');
$stmt->bindValue(':firstName', $firstName, PDO::PARAM_INT);
$stmt->execute();
$ids = $stmt->fetchALL(PDO::FETCH_ASSOC);
foreach($ids as $id) {
	$userId = $id['id'];
}

//get targetId
$stmt = $db->prepare('SELECT id FROM user WHERE firstName = :firstName');
$stmt->bindValue(':firstName', $targetFirstName, PDO::PARAM_INT);
$stmt->execute();
$ids = $stmt->fetchALL(PDO::FETCH_ASSOC);
foreach($ids as $id) {
	$targetId = $id['id'];
}

//get new target id
$stmt = $db->prepare('SELECT targetId FROM userGame 
						WHERE gameId = :gameId AND userId = :targetId');
$stmt->bindValue(':gameId', $gameId, PDO::PARAM_INT);
$stmt->bindValue(':targetId', $targetId, PDO::PARAM_INT);
$stmt->execute();
$newTargets = $stmt->fetchALL(PDO::FETCH_ASSOC);
foreach($newTargets as $myTarget) {
	$newTargetId = $myTarget['targetId'];
}	

//update the database with new target
if ($targetExterminated) {
	if ($userId == $newTargetId) {
		//finish the game
		$stmt = $db->prepare('UPDATE game
								SET winnerId = :userId
								WHERE id =:gameId');
		$stmt->bindValue(':gameId', $gameId, PDO::PARAM_INT);
		$stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
		$stmt->execute();
		
		$stmt = $db->prepare('UPDATE userGame
								SET isAlive = FALSE
								WHERE gameId =:gameId AND userId =:targetId');
		$stmt->bindValue(':gameId', $gameId, PDO::PARAM_INT);
		$stmt->bindValue(':targetId', $targetId, PDO::PARAM_INT);
		$stmt->execute();
	}
	else {
		$stmt = $db->prepare('UPDATE userGame
								SET targetId = :newTargetId
								WHERE gameId =:gameId AND userId =:userId');
		$stmt->bindValue(':newTargetId', $newTargetId, PDO::PARAM_INT);
		$stmt->bindValue(':gameId', $gameId, PDO::PARAM_INT);
		$stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
		$stmt->execute();
		
		$stmt = $db->prepare('UPDATE userGame
								SET isAlive = FALSE
								WHERE gameId =:gameId AND userId =:targetId');
		$stmt->bindValue(':gameId', $gameId, PDO::PARAM_INT);
		$stmt->bindValue(':targetId', $targetId, PDO::PARAM_INT);
		$stmt->execute();
	}
}

header('location: status.php');
die('Should have relocated to status.php');
?>

