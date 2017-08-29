<?php
include 'connect.php';

$msg = "";
$reg = @$_POST['reg'];
$un = ""; //Username
$pswd = ""; //Password
$pswd2 = ""; // Password 2
$u_check = ""; // Check if username exists

//registration form
$un = strip_tags(@$_POST['username']);
$pswd = strip_tags(@$_POST['password']);
$pswd2 = strip_tags(@$_POST['password2']);

if ($reg) {
	// Check if user already exists
	$u_check = @mysql_query("SELECT username FROM users WHERE username='$un'");
	// Count the amount of rows where username = $un
	$check = @mysql_num_rows($u_check);

	if ($check == 0) {
		//check all of the fields have been filed in
		if ($un&&$pswd&&$pswd2) {
			// check that passwords match
			if ($pswd==$pswd2) {
				// check the maximum length of username/first name/last name does not exceed 25 characters
				if (strlen($un)>25) {
					$msg = "Username can only have a maximum of 25 characters";
				}
				else{
					// check the maximum length of password does not exceed 25 characters and is not less than 5 characters
					if (strlen($pswd)<8) {
						$msg = "Your password must be at least 8 characters long!";
					}
					else{
                                                //encrypt password and password 2 using sha256 before sending to database
                                                $pswd = hash('sha256', $pswd);
                                                $pswd2 = hash('sha256', $pswd2);
                                                $query = @mysql_query("INSERT INTO users (username, password)
	            			        VALUES ('$un','$pswd')");
	            		if($query){
	            			$new = "Account successfully created";
		            		header("location:login.php?newUserMsg=$new");
	            		}
		            	else
		            		die(mysql_error());
	          		}
	        	}
	      	}
	      	else {$msg = "Your passwords don't match";}
	    }
	    else{$msg = "Please fill in all the fields";}
	}
	else{$msg = "Username already taken";}
}

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
			    <a class="navbar-brand" href="login.php"><b>LifeHacks</b></a>
			</div>

			<div>
			    <ul class="nav navbar-nav">
			    	<li><a href="login.php">Home<span class="sr-only">(current)</span></a></li>
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
		<div class="panel-heading"><h4>Registration for new users</h4></div>
			<div class="panel-body">
			<div class="container">
	           	<form action="register.php" method="post">
    	       	<p>Username: </p>
        	   	<input type="text" size="40" name="username" class="auto-clear" title="Username" placeholder="Maximum 25 characters"><p></p>
    	       	<p>Password: </p>
       		   	<input type="password" size="40" name="password" placeholder="Minimum of 8 characters"><p></p>
           		<p>Confirm password: </p>
           		<input type="password" size="40" name="password2" placeholder="Repeat password"><p></p>
           		<?php if(!empty($msg)): ?>
					<p><?= $msg ?></p>
				<?php endif; ?>
           		<input type="submit" class="btn btn-default" name="reg" value="Sign Up!">
           		</form>
           	</div>
           	</div>
        </div>
		</div>
	</body>
</html>