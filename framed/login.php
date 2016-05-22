<?php
session_start();

require 'credentials.php';

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Framed - Login</title>
		<link rel="stylesheet" type="text/css" href="framedStyle.css">
	</head>
	<body>
	<div class="document">
		<div id="pageName">
			<h1>Framed - Login</h1>
		</div>
		<div class="content">
		<form action="games.php" method="POST">
			<h3>Select one of the following names:</h3>
			<input type="radio" name="firstName" value="John"/>John</br>
			<input type="radio" name="firstName" value="Sally"/>Sally</br>
			<input type="radio" name="firstName" value="Braden"/>Braden</br>
			<input type="radio" name="firstName" value="David"/>David</br>
			<input type="radio" name="firstName" value="Jennifer"/>Jennifer</br>
			<input type="submit" value="Login"/>
		</form>
		</div>
	</div>
	</body>
</html>














