<?php
session_start();
if(!isset($_SESSION['gold']))
{	
	$_SESSION['gold'] = 0;
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>The GoldGame</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<style>
		.col-md-3{
			border: 10px solid black;
			width:	150px;
			height: 153px;
			display: inline-table;
		}
		.col-md-12{
			height: 100px;
			width: 500px;
			overflow: auto;
			border: 1px solid black;		}
		span{
			color: green;
		}
		.loser{
			color: red;
		}
	</style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		$('button').click(function(){
			var place = $(this).attr('id');
			$('#type').val(place);
			$('form').submit();
		});
	});
	</script>
</head>
<body>
	<div class="container">
		<form action="process.php" method="post">
			<input id="type" type="hidden" name="building">
		</form>
		<h1>Gold game</h1>
		<h3>Your gold = <?= $_SESSION['gold'] ?></h3>
		<div class="row">
			<div class="col-md-3">
				<h3>Farm</h3>
				<h5>Earns 10-20 golds</h5>
				<!-- <form action="process.php" method="post">
					<input type="hidden" name="building" value="farm">
					<input type="submit" value="Fine Gold!">
				</form> -->
				<button id="farm">Fine Gold!</button>

			</div>
			<div class="col-md-3">
				<h3>Cave</h3>
				<h5>Earns 5-10 golds</h5>
				<!-- <form action="process.php" method="post">
					<input type="hidden" name="building" value="cave">
					<input type="submit" value="Fine Gold!">
				</form> -->
				<button id="cave">Fine Gold!</button>

			</div>
			<div class="col-md-3">
				<h3>House</h3>
				<h5>Earns 2-5 gold coins</h5>
				<!-- <form action="process.php" method="post">
					<input type="hidden" name="building" value="house">
					<input type="submit" value="Fine Gold!">
				</form> -->
				<button id="house">Fine Gold!</button>

			</div>
			<div class="col-md-3">
				<h3>Casion</h3>
				<h5>Win/Lose, the odds are big.</h5>
				<!-- <form action="process.php" method="post">
					<input type="hidden" name="building" value="casino">
					<input type="submit" value="Fine Gold!">
				</form> -->
				<button id="casino">Fine Gold!</button>

			</div>
		</div>
		<a href="process.php">Destroy</a>
		<div class="row">
			<div class='col-md-12'>
				<?php
				if(isset($_SESSION['activities']))
				{
					$activities = $_SESSION['activities'];
					$start = count($activities) - 1;
					for($i = $start; $i > 0; $i--)
					{
						echo $activities[$i] . "<br>";
					}
				}
				?>
			</div>
		</div>
	</div>
</body>
</html>