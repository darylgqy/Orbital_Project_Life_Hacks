<!DOCTYPE html>
<?php
	include("connect.php");
	include("/home/lifehac5/public_html/inc/header.inc.php");
?>
	<div class="container">
<!-- screen message (not being used)-->
		<?php if(isset($_GET['postMsg'])){
	    	echo "<p>".$_GET['postMsg']."</p>";
	    }
		?>

<?php
//page and offset
	$per_page = 5;
	if (!isset($_GET['page']))
   		$page = 1;
	else{
            if((int)$_GET['page']>=1)
	      $page = (int)$_GET['page'];
        }
	$offset = $per_page*$page - $per_page;

//grab posts by searchbar, category or everything
	$user_id = $_SESSION['id'];
	$term = isset($_GET['search_term'])?$_GET['search_term']:"";
	$cat_selected = "";

	if (!empty($_GET['search_term'])) {
		$query = "SELECT * FROM posts WHERE
			`title` LIKE '%$term%' OR
			`category` LIKE '%$term%' OR
			`content` LIKE '%$term%' ";
	}
	else if(!empty($_GET['category'])){
		$cat_selected = $_GET['category'];
		$query = "SELECT * FROM posts WHERE category='$cat_selected' ";
	}
	else
		$query = "SELECT * FROM posts ";

	$query = $query."ORDER by id desc LIMIT $per_page OFFSET ";
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
				    	<li><a href="index.php?search_term=<?=$term?>&category=<?=$cat_selected?>&page=<?=$page-1?>">Previous</a></li>
				    <?php }?>
				    <div class="btn" style="font-size:20px"><?=$page?></div>
				    <?php if($next_rows != 0){ ?>
				    	<li><a href="index.php?search_term=<?=$term?>&category=<?=$cat_selected?>&page=<?=$page+1?>">Next</a></li>
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