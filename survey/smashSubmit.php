<?php
session_start();
$control = $_POST["controller"];
$rStick = $_POST["rstick"];
$rTrigger = $_POST["rtrigger"];
$lTrigger = $_POST["ltrigger"];
$_SESSION['hasVoted'] = True;
$_SESSION['votes'] = 1;

$message = $control . ".";

foreach ($rStick as $value) {
	//echo $value;
	//$message .= "Right Stick: ";
	if (isset($value)){
		$message .= $value . ","; 
	}
}

$message .= ". " . $rTrigger . ". " . $lTrigger . "\n";
file_put_contents("results.txt", $message, FILE_APPEND);
header( 'Location: results.php' ) ; 
?>