<?php
	include("connect.php");
	include("/home/lifehac5/public_html/inc/header.inc.php");
	$user_id = $_SESSION['id'];
?>

<div class="container">

<?php
//page and offset
	$per_page = 5;
	if (!isset($_GET['page']))
   		$page = 1;
	else
	    $page = (int)$_GET['page'];
	$offset = $per_page*$page - $per_page;

//get bookmarks and display
	$query = "SELECT * FROM `posts` JOIN `bookmarks`
				ON `posts`.id = `bookmarks`.post_fk
				WHERE `bookmarks`.user_fk = '$user_id'
				ORDER by id desc LIMIT $per_page OFFSET ";
	$grab_posts = mysql_query($query.$offset);
	$offset += $per_page;
	$check_next = mysql_query($query.$offset);
	$numrows = mysql_num_rows($grab_posts);
	$next_rows = mysql_num_rows($check_next);
	
	if($numrows == 0)
		echo "<h2>"."Sorry! No posts to show here."."</h2>";
	else
		include 'getposts.php';
?>

<!-- pagination-->
			<nav>
				<ul class="pager">
					<?php if($page>1){ ?>
				    	<li><a href="bookmarks.php?page=<?=$page-1?>">Previous</a></li>

				    <?php }?>
				    <div class="btn" style="font-size:20px"><?=$page?></div>
				    <?php if($next_rows != 0){ ?>
				    	<li><a href="bookmarks.php?page=<?=$page+1?>">Next</a></li>
				    <?php }?>
		  		</ul>
			</nav>
		</div>

		<footer class="col-m-3 col-sm-3">Orbital2016(Team Basic)</footer>
		<?php
			if(isset($_COOKIE["loggedin"]))
				echo $_COOKIE["loggedin"];
		?>
	</body>
</html>

<?php include 'plugin.php'; ?>