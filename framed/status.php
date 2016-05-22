<?php
session_start();
$firstName = $_SESSION['firstName'];

require 'credentials.php';

if(isset($_POST['game'])){
	$gameName = $_POST['game'];
}
else {
	echo "<h1>No Game Selected!</h1>";
}

// Get the users last name	
$stmt = $db->prepare('SELECT * FROM user WHERE firstName=:name');
$stmt->bindValue(':name', $firstName, PDO::PARAM_STR);
$stmt->execute();
$users = $stmt->fetchALL(PDO::FETCH_ASSOC);
foreach ($users as $user){
	$lastName = $user['lastName'];
	$userId = $user['id'];
	//echo $lastName . " " . $userId;
}

// Get the user's game status information.
$stmt = $db->prepare('SELECT ug.targetId, ug.isAlive, ug.gameId, ug.userId
						FROM userGame ug 
						INNER JOIN user u 
						ON ug.userId = u.id
						WHERE u.firstName=:first');
$stmt->bindValue(':first', $firstName, PDO::PARAM_STR);
$stmt->execute();
$games = $stmt->fetchALL(PDO::FETCH_ASSOC);

$stmt = $db->prepare('SELECT * FROM game WHERE name=:name');
$stmt->bindValue(':name', $gameName, PDO::PARAM_STR);
$stmt->execute();
$names = $stmt->fetchALL(PDO::FETCH_ASSOC);
foreach ($names as $name) {
	$gameId = $name['id'];
}
foreach ($games as $game){
	if ($game['gameId'] == $gameId){
		$targetId = $game['targetId'];
		$isAlive = $game['isAlive'];
	}
	//echo $targetId;
}

//Get the information about the target.
$stmt = $db->prepare('SELECT * FROM user WHERE id=:id');
$stmt->bindValue(':id', $targetId, PDO::PARAM_STR);
$stmt->execute();
$targets = $stmt->fetchALL(PDO::FETCH_ASSOC);
foreach($targets as $target) {
	$targetFirstName = $target['firstName'];
	$targetLastName = $target['lastName'];
	//echo $targetFirstName;
	//echo $targetLastName;
}

//Get the Games location information.
$stmt = $db->prepare('SELECT * FROM game WHERE id=:name');
$stmt->bindValue(':name', $gameId, PDO::PARAM_STR);
$stmt->execute();
$games = $stmt->fetchALL(PDO::FETCH_ASSOC);
foreach($games as $game) {
	$location = $game['locationDescription'];
	if (isset($game['winnerId'])){
		$winnerId = $game['winnerId'];
	}	
}

//Get the rules for the game.
$stmt = $db->prepare('SELECT * FROM rules WHERE gameId=:name');
$stmt->bindValue(':name', $gameId, PDO::PARAM_STR);
$stmt->execute();
$rules = $stmt->fetchALL(PDO::FETCH_ASSOC);
foreach ($rules as $rule) {
	$startTime = $rule['startTime'];
	$locationRules = $rule['locationRules'];
	if (isset($rule['extra'])) {
		$extra = $rule['extra'];
	}
}

//Get the picture locations from the database.
$stmt = $db->prepare('SELECT img FROM frame WHERE gameId=:id');
$stmt->bindValue('id', $gameId, PDO::PARAM_STR);
$stmt->execute();
$locations = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Framed Game Status</title>
		<link rel="stylesheet" type="text/css" href="framedStyle.css">
	</head>
	<body>
	<div class="document">
		<div id="pageName">
			<h1>"<?php echo $gameName; ?>"</h1>
		</div>
		<div class="content">
			<div id="gameInfo">
				<h2>Location: 
				<?php echo $location; ?>
				</h2>
				<h3>Starts: 
				<?php echo $startTime; ?></br>
				Rules: 
				<?php echo $locationRules; ?>
				</h3>
			</div>
			<!--<div id="names">
			<?php 
				//echo "<h3>Welcome " . $firstName . " " . $lastName . "</h3>"; // I'm not sure why this isn't working.
			?>
			</div> -->
			<div id="alive">
				<h3>Active Status: 
			<?php
			
				if ($isAlive){
					echo "Alive";
				}
				else {
					echo "Terminated";
				}
			?>
				</h3>
			</div>
			<div id="target">
				<h3>Your target is: <span style="color: #cc0000;"><?php echo $targetFirstName . " " . $targetLastName; ?></span></h3>
			
			</div>
			<div id="frames">
				<h3>Players Terminated: 
				<?php 
					if($locations == NULL){
						echo "N/A";
					}
				?>
				</h3>
			<?php foreach($locations as $url): ?>
				<div class="picture">			
					<img src="<?php echo $url; ?>" height="400"/>
				</div>
			<?php endforeach; ?>
			</div>
			<div id="modify">
				<h3><a href="addFrame.php">Record your recent Frame</a></h3>
			</div>
		</div>
	</div>
	</body>
</html>













