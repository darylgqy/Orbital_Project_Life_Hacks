<!DOCTYPE html>
<?php
	@session_start();
	if (!isset($_SESSION["id"]))
		header("location:login.php");
	else
		$user_id = $_SESSION['id'];
//auto logout
	if(time() - $_SESSION['timestamp'] > 1800)
	    header("Location:logout.php");
	else
    	$_SESSION['timestamp'] = time();
?>
<html>

	<head>
		<title>LifeHacks</title>
		<link rel="stylesheet" type="text/css" href="/home/lifehac5/public_html/styles/main.css">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

		<style>.red {color: #FF0000;}</style>
	</head>
	

	<body>

		<header>
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="index.php"><b>LifeHacks</b></a>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav">
			        <li class=""><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
			        <li><a href="bookmarks.php">Bookmarks</a></li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="index.php?category=DIY">DIY</a></li>
			            <li><a href="index.php?category=Health">Health</a></li>
			            <li><a href="index.php?category=Electronics">Electronics</a></li>
			            <li role="separator" class="divider"></li>
			          	<li><a href="myposts.php">My Posts</a></li>
			          </ul>
				    </li>
			      </ul>
			      <form  action="index.php" class="navbar-form navbar-left" role="search">
			        <div class="form-group">
			          <input type="text" name ="search_term" class="form-control" placeholder="Search">
			        </div>
			        <button type="submit" class="btn btn-default">Submit</button>
			      </form>
			      <ul class="nav navbar-nav navbar-right">
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="#">Edit profile</a></li>
			            <li><a href="changepassword.php">Change password</a></li>
			            <li><a href="#">Account settings</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="logout.php">Logout</a></li>
			          </ul>
			        </li>


			        <!--post button-->
			        <li class="postbtn">
			     	  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#postModal">Post</button>
					  <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  						<div class="modal-dialog modeal-lg" role="document">
    					  <div class="modal-content">
      						<div class="modal-header">
        					  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        					  <h4 class="modal-title" id="exampleModalLabel">New post</h4>
      						</div>
      						
      						<form action="submitpost.php" method="post">
	      					  <div class="modal-body">
	          					<div class="form-group">
									<label class="control-label"><span class="red">*</span> Title</label>
	          						<input class="form-control" name="title"></input><p></p>
	            					<label role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><span class="red">*</span> Tags/Categories <span class="caret"></span></label>
			          				<div class="collapse" id="collapseExample">
			          				  <p><input type="radio" name="category" value="DIY" id="DIY"> <label for="DIY">DIY</label></p>
			            			  <p><input type="radio" name="category" value="Health" id="Health"> <label for="Health">Health</label></p>
			            			  <p><input type="radio" name="category" value="Electronics" id="Electronics"> <label for="Electronics">Electronics</label></p>
			            			</div>
			            		</div>
	          				    <div class="form-group">
	            				  <label class="control-label"><span class="red">*</span> Share the hacks!</label>
	            				  <textarea class="form-control" name="content"></textarea>
	            				  <label class="control-label">Video link</label>
	          					  <input class="form-control" name="video"></input>
	          					</div>
	      					  </div>
	      					  <div class="modal-footer">
	        					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        					<button type="submit" class="btn btn-primary">Post</button>
	      					  </div>
	      					</form>
    					  </div>
  						</div>
					  </div>
			        </li>


			        <li><a href="about.php">About</a></li>
			      </ul>
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
		</header>