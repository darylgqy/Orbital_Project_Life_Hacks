<?php
	session_start();
	if (isset($_SESSION["id"]))
		include '/home/lifehac5/public_html/inc/header.inc.php';
	else{
?>

<!DOCTYPE html>
<html>
	<title>LifeHacks</title>
	<link rel="stylesheet" type="text/css" href="styles/main.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
			    <a class="navbar-brand" href="index.php"><b>LifeHacks</b></a>
			</div>

			<div>
			    <ul class="nav navbar-nav">
			    	<li><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
			   	</ul>

			   	<ul class="nav navbar-nav navbar-right">
		   			<li><a href="about.php">About</a></li>
		   		</ul>
		   	</div>
		   	
		</div>
	</nav>

<?php } ?>

	<body>
		<div class="container">
		<div class="col-sm-4">
			<h2>About</h2>
			<hr/>
			<p>Lifehacks is a platform where people can share useful daily living tips with one another, be it generic or niche topics. Make someone's life more convenient today!</p>
		</div>
		</div>
	</body>
</html>

<?php include 'plugin.php'; ?>