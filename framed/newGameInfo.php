<?php
session_start();
require 'credentials.php';

$stmt = $db->prepare('SELECT firstName, lastName FROM user');
//$stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
$stmt->execute();
$users = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create New Game</title>
	<link rel="stylesheet" type="text/css" href="framedStyle.css">
</head>
<body>
	<div class="document">
	<div id="pageName">
		<h1>Create New Game</h1>
	</div>
	<div class="content">
		<h3>Please fill in content for your new game.</h3>
		<form action="insertGame.php" method="POST">
			<input type="text" name="gameName"/>Name</br>
			<textarea name="locationInfo" rows="3" cols="65"></textarea>Location Information</br>
			<input type="text" name="start"/>Start Date and Time</br>
			<textarea name="rules" rows="3" cols="65"></textarea>Rules of the Game</br>
			<input type="text" name="extra"/>Any Extra Information</br>
			<h3>Check the players who will be in this game.</h3>
			<?php
			foreach ($users as $user) {
				echo "<input type=\"checkbox\" name=\"user[]\" value=\"" . $user['firstName'] . "\"/>";
				echo $user['firstName'] . " " . $user['lastName'] . "</br>";
			}
			?>
			<input type="submit" value="Create Game"/>
		</form>
	</div>
	</div>
</body>
</html>