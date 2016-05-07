<?php
// Start the session
session_start();
if (isset($_SESSION['hasVoted'])) {
	$_SESSION['votes'] += 1;
	header('Location: results.php');
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Smash 4 Controller Survey</title>
		<link rel="stylesheet" type="text/css" href="baseStyle.css">
	</head>
	<body>
		<div id="header">
			<h1>Smash 4 Controller Survey - Enjoy</h1>
			<h3>Please enter your preferences for your Controller and settings.</h3>
		</div>
		<div>
			<p>
				See <a href="results.php">Results!</a>
			</p>
			<form action="smashSubmit.php" method="POST">
				<p>Controller: <br/>
					<input type="radio" name="controller" value="Gamecube Controller"/>Gamecube Controller <br/>
					<input type="radio" name="controller" value="Wii U Pro Controller"/>Wii U Pro Controller <br/>
					<input type="radio" name="controller" value="Wii U Game Pad"/>Wii U Game Pad <br/>
				</p>
				<p>Right Stick: <br/>
					<input type="checkbox" name="rstick[]" value="Smash"/>Smash<br/>
					<input type="checkbox" name="rstick[]" value="Special"/>Special<br/>
					<input type="checkbox" name="rstick[]" value="Attack"/>Attack<br/>
				</p>
				<p>Right Trigger: <br/>
					<input type="radio" name="rtrigger" value="Shield"/>Shield<br/>
					<input type="radio" name="rtrigger" value="Grab"/>Grab<br/>
					<input type="radio" name="rtrigger" value="Jump"/>Jump<br/>
				</p>
				<p>Left Trigger: <br/>
					<input type="radio" name="ltrigger" value="Shield"/>Shield<br/>
					<input type="radio" name="ltrigger" value="Grab"/>Grab<br/>
					<input type="radio" name="ltrigger" value="Jump"/>Jump<br/>
				</p>
				<input type="submit" value="Submit"/>
			</form>
		</div>
		<div id="footer">
		</div>
	</body>
</html>