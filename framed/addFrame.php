<?php
session_start();
require 'credentials.php';

$firstName = $_SESSION['firstName'];
$targetFirstName = $_SESSION['targetFirstName'];

/*$stmt = $db->prepare('');
$stmt->bindValue();
$stmt->execute();
*/
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Upload Frame</title>
		<link rel="stylesheet" type="text/css" href="framedStyle.css">
	</head>
	<body>
	<div class="document">
		<div id="pageName">
			<h1>Upload Frame</h1>
		</div>
		<div class="content">
			<form action="recordFrame.php" method="POST">
				<h3>Photo upload unavailable at this time...</h3>
				<h3>Did you 'Frame' your target?</h3>
				<input type="radio" name="hit" value="hit" checked="TRUE"/>Yes</br>
				<input type="radio" name="hit "value="miss"/>No</br>
				<input type="submit" value="Record Frame"/>
			</form>
		</div>
	</div>
	</body>
</html>