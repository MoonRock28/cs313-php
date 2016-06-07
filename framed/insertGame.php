<?php
session_start();
require 'credentials.php';

//get variables from the form.
$gameName = htmlspecialchars($_POST['gameName']);
$locationInfo = htmlspecialchars($_POST['locationInfo']);
$users = $_POST['user'];
$start = htmlspecialchars($_POST['start']);
$rules = htmlspecialchars($_POST['rules']);
$extra = htmlspecialchars($_POST['extra']);

//create and manipulate our variables
shuffle($users);
$length = count($users);
$ids = array();
$gameId;

//insert into the game table
$stmt = $db->prepare('INSERT INTO game (name, locationDescription)
						VALUES (:name, :locationDescription)');
$stmt->bindValue(':name', $gameName, PDO::PARAM_STR);
$stmt->bindValue(':locationDescription', $locationInfo, PDO::PARAM_STR);
$stmt->execute();

//verify the game is in the database
$stmt = $db->prepare('SELECT * FROM game WHERE name = :gameName');
$stmt->bindValue(':gameName', $gameName, PDO::PARAM_STR);
$stmt->execute();
$games = $stmt->fetchALL(PDO::FETCH_ASSOC);

foreach ($games as $game) {
	$gameId = $game['id'];
	//echo $game['name'] . " is in the database.";
}

//pull the users information from the database to insert into userGame.
for ($x = 0; $x < $length; $x++) {
	$stmt = $db->prepare('SELECT id FROM user WHERE firstName = :firstName');
	$stmt->bindValue(':firstName', $users[$x], PDO::PARAM_STR);
	$stmt->execute();
	$names = $stmt->fetchALL(PDO::FETCH_ASSOC);
	foreach ($names as $name){
		array_push($ids, $name['id']);
	}
}

//insert into the userGame table
for ($x = 0; $x < $length - 1; $x++) {
	$stmt = $db->prepare('INSERT INTO userGame (userId, gameId, targetId, isAlive)
							VALUES (:userId, :gameId, :targetId, TRUE)');
	$stmt->bindValue(':userId', $ids[$x], PDO::PARAM_INT);
	$stmt->bindValue(':gameId', $gameId, PDO::PARAM_INT);
	$stmt->bindValue(':targetId', $ids[$x+1], PDO::PARAM_INT);
	$stmt->execute();
	
}
$stmt = $db->prepare('INSERT INTO userGame (userId, gameId, targetId, isAlive)
						VALUES (:userId, :gameId, :targetId, TRUE)');
$stmt->bindValue(':userId', $ids[$length-1], PDO::PARAM_INT);
$stmt->bindValue(':gameId', $gameId, PDO::PARAM_INT);
$stmt->bindValue(':targetId', $ids[0], PDO::PARAM_INT);
$stmt->execute();

//insert into the rules table
$stmt = $db->prepare('INSERT INTO rules (gameId, startTime, locationRules, extra)
						VALUES (:gameId, :start, :rules, :extra)');
$stmt->bindValue(':gameId', $gameId, PDO::PARAM_INT);
$stmt->bindValue(':start', $start, PDO::PARAM_STR);
$stmt->bindValue(':rules', $rules, PDO::PARAM_STR);
$stmt->bindValue(':extra', $extra, PDO::PARAM_STR);
$stmt->execute();

//echo "Made it to the end of the file.";
header('location: games.php');
die('Should have relocated to games.php');
?>

















