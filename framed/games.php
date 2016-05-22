<?php
//start the session
session_start();
$_SESSION['firstName'] = $_POST['firstName'];

/*if (isset($_SESSION['firstName'])) {
	$_SESSION['firstName'] = $_POST['firstName'];
else {
	$_SESSION['firstName'] = $_POST['firstName'];
}*/

require 'credentials.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Framed Games</title>
		<link rel="stylesheet" type="text/css" href="framedStyle.css">
	</head>
	<body>
	<div class="document">
		<div id="pageName">
			<h1>Framed Games</h1>
		</div>
		<div class="content">
<?php
	$stmt = $db->prepare('SELECT name FROM game g 
							JOIN userGame ug ON g.id = ug.gameId
							JOIN user u ON ug.userId = u.id
							WHERE u.firstName=:id');
	$stmt->bindValue(':id', $_SESSION['firstName'], PDO::PARAM_STR);
	$stmt->execute();	
	$games = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>
			<h2>Welcome <?php echo $_SESSION['firstName']?></h2>
			<h3>Please select a game to see its status.</h3>
			<form action="status.php" method="POST">
			<p>
<?php
foreach ($games as $game):
	//echo '<li>' . $game['name'] . '</li>';
?>
				<input type="radio" name="game" value="<?php echo $game['name'] . "\"/>" . $game['name']; ?> </br>
<?php
endforeach;
?>
				<input type="submit" value="Submit"/>
			</p>
			</form>
		</div>
	</div>
	</body>
</html>
