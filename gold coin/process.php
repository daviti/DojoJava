<?php
session_start();
date_default_timezone_set('America/Los_Angeles');
if(isset($_POST['building']) and $_POST['building'] == 'farm')
{
	$gold_found = rand(10,20);
	$_SESSION['gold'] += $gold_found;
	$_SESSION['activities'][] = "<span>You entered a farm and got {$gold_found} golds. " . date("M-d-Y h:i:s") . "</span>"; 
}
else if(isset($_POST['building']) and $_POST['building'] == 'cave')
{
	$gold_found = rand(5,10);
	$_SESSION['gold'] += $gold_found;
	$_SESSION['activities'][] = "<span>You entered a cave and got {$gold_found} golds. " . date("M-d-Y h:i:s") . "</span>"; 
}
else if(isset($_POST['building']) and $_POST['building'] == 'house')
{
	$gold_found = rand(2,5);
	$_SESSION['gold'] += $gold_found;
	$_SESSION['activities'][] = "<span>You entered a house and got {$gold_found} golds. " . date("M-d-Y h:i:s") . "</span>"; 
}
else if(isset($_POST['building']) and $_POST['building'] == 'casino')
{
	$chance = rand(1,10);
	if($chance < 8)
	{
		$gold_found = rand(-50,-1);
		$_SESSION['gold'] += $gold_found;
		$_SESSION['activities'][] = "<span class='loser'>You entered a Casion and got {$gold_found} golds. " . date("M-d-Y h:i:s") . "</span>"; 
	}
	else
	{
		$gold_found = rand(0,50);
		$_SESSION['gold'] += $gold_found;
		$_SESSION['activities'][] = "<span>You entered a Casion and got {$gold_found} golds. " . date("M-d-Y h:i:s") . "</span>"; 
	}
	
}
else
{
	session_destroy();
}

header("Location: main.php");