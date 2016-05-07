<?php
session_start();
$myfile = file_get_contents("results.txt") or die("Unable to open file!");
$lines = explode("\n", $myfile);

//Set controller result variables.
$GC = 0;
$WP = 0;
$WG = 0;

//Set right stick result variables.
$Smash = 0;
$Special = 0;
$Attack = 0;

//Set right trigger result variables.
$rShield = 0;
$rGrab = 0;
$rJump = 0;

//Set left trigger result variables.
$lShield = 0;
$lGrab = 0;
$lJump = 0;

foreach($lines as $line) {
	list($controller, $rStick, $rTrigger, $lTrigger) = explode('.', $line . '...');
	
	switch ($controller) {
		case "Gamecube Controller":
			$GC += 1;
			break;
		case "Wii U Pro Controller":
			$WP += 1;
			break;
		case "Wii U Game Pad":
			$WG += 1;
			break;
		default:
			break;
	}
	
	$stick = explode(",", $rStick);
	
	foreach ($stick as $value) {
		switch ($value) {
		case " Smash":
			$Smash += 1;
			break;
		case "Special":
			$Special += 1;
			break;
		case "Attack":
			$Attack += 1;
			break;
		default:
			break;
	}
	}
	
	switch ($rTrigger) {
		case " Shield":
			$rShield += 1;
			break;
		case " Grab":
			$rGrab += 1;
			break;
		case " Jump":
			$rJump += 1;
			break;
		default:
			break;
	}
	
	switch ($lTrigger) {
		case " Shield":
			$lShield += 1;
			break;
		case " Grab":
			$lGrab += 1;
			break;
		case " Jump":
			$lJump += 1;
			break;
		default:
			break;
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Smash Controller Results</title>
		<link rel="stylesheet" type="text/css" href="baseStyle.css">
	</head>
	<body>
		<div id="header">
			<h1>Smash Controller Survey Results:</h1>
			<?php
				if (isset($_SESSION['votes']) && $_SESSION['votes'] > 1) {
					echo "<p>You have voted in this survey!<br/></p>";
				}
			?>
		</div>
		<div>
			<p>
			<span class="identifier">Controllers:</span><br/>
<?php
echo "Gamecube Controller: " . $GC . "<br/>";
echo "Wii U Pro Controller: " . $WP . "<br/>";
echo "Wii U Game Pad: " . $WG . "<br/>";
?>
			</p>
			<p>
			<span class="identifier">Right Stick:</span><br/>
<?php
echo "Smash: " . $Smash . "<br/>";
echo "Special: " . $Special . "<br/>";
echo "Attack: " . $Attack . "<br/>";
?>
			</p>
			<p>
			<span class="identifier">Right Trigger:</span><br/>
<?php
echo "Shield: " . $rShield . "<br/>";
echo "Grab: " . $rGrab . "<br/>";
echo "Jump: " . $rJump . "<br/>";
?>
			</p>
			<p>
			<span class="identifier">Left Trigger:</span><br/>
<?php
echo "Shield: " . $lShield . "<br/>";
echo "Grab: " . $lGrab . "<br/>";
echo "Jump: " . $lJump . "<br/>";
?>
			</p>
		</div>
		
	</body>
</html>