<!DOCTYPE html>
<?php
	include 'connect.php';
	
	if(isset($_POST['username']) && isset($_POST['password'])){
		$username = stripslashes($_POST['username']);
		$password = stripslashes($_POST['password']);
		$password = hash('sha256', $password);
		$query = mysql_query("SELECT id FROM users WHERE username='$username'and password='$password'");
		$count = mysql_num_rows($query); 

		mysql_close();

		$msg = "";
		if($count==1){
			$seconds = 1800 + time();
			date_default_timezone_set("Asia/Singapore");
			setcookie(loggedin, date("F jS - g:i a"), $seconds);
			while($row = mysql_fetch_array($query))
            	$id = $row["id"];
            session_start();
            $_SESSION['timestamp'] = time();
		 	$_SESSION["id"] = $id;
			header("location:index.php");
		}
		else{
			$msg = "Incorrect username or password...";
		}
	}
?>
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

	<body>
		<div class="container col-xs-12 col-md-6 col-md-offset-3 center">
		<div class="panel panel-primary">
		<div class="panel-heading"><h4>Sign in for members</h4></div>
			<div class="panel-body">
			<div class="container">
				<form action = "login.php" method = "POST">
					<?php if(isset($_GET['newUserMsg']))
    					echo "<p>".$_GET['newUserMsg']."</p>";
					?>
					<p>Username: </p><input type="text" name = "username" />
					<p>Password: </p><input type="password" name="password"/>
					<br></br>
					<?php if(!empty($msg)): ?>
						<p><?= $msg ?></p>
					<?php endif; ?>
					<input type="submit" class="btn btn-default" value = "Login">
					<br></br>
					<p>Not a member?</p>
					<a href="register.php" type="button" class="btn btn-default">Register</a>
				</form>
			</div>
			</div>
		</div>
		</div>
	</body>
</html>

<?php include 'plugin.php'; ?>