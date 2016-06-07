<?php
session_start();
require 'credentials.php';


if (isset($_SESSION['invalid'])){
	echo "Passwords are not identical!";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create User</title>
	<link rel="stylesheet" type="text/css" href="framedStyle.css">
</head>
<body>
	<div class="document">
	<div id="pageName">
		<h1>Create User</h1>
	</div>
	<div class="content">
		<h3>Please fill out the following information:</h3>
		<form action="insertUser.php" method="POST">
			<input type="text" name="firstName"/>First Name</br>
			<input type="text" name="lastName"/>Last Name</br>
			<input type="text" name="userName"/>User Name</br>
			<input type="password" name="password"/>Password</br>
			<input type="password" name="verify"/>Verify Password</br>
			<input type="submit" value="Create User"/>
		</form>
		
	</div>
	</div>
</body>
</html>