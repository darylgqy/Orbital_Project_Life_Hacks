<?php
//loop to retrieve post by post
while ($post = mysql_fetch_assoc($grab_posts)) {
	    $poster_id = $post['user_fk'];
	    $post_id = $post['id'];
	    $title = $post['title'];
	    $category = $post['category'];
	    $content = $post['content'];
	    $video = $post['video'];
	    $upvote = $post['upvote'];
	    $downvote = $post['downvote'];

	    $getposter = mysql_query("SELECT * FROM users WHERE id = '$poster_id'");
	    while($poster = mysql_fetch_assoc($getposter))
		    $poster_un = $poster['username'];

	if (@$_POST['upvote_'.$post_id])
//Increment post upvote
	    $upvote_query = mysql_query("UPDATE posts SET upvote= upvote+1 WHERE id='$post_id'");
	if (@$_POST['downvote_'.$post_id])
//Increment post downvote
	    $downvote_query = mysql_query("UPDATE posts SET downvote= downvote+1 WHERE id='$post_id'");
//bookmark post
	if(@$_POST['bookmark_'.$post_id])
		$bookmark_query = mysql_query("INSERT INTO `bookmarks` (`user_fk`, `post_fk`) VALUES ('$user_id', '$post_id')");
//delete post
	if(@$_POST['delete_'.$post_id])
		$delete_query = mysql_query("DELETE FROM posts WHERE id = '$post_id'");
?>

<!-- post panel -->
			<div class="panel panel-primary">
			  <div class="panel-heading">
			  	<span style="font-size:17px"><?=$title?></span> posted by <?=$poster_un?></div>
			  <div class="panel-body">
			    <p><?=$content?></p>
			    <?php if($video){?>
			    <a href="<?=$video?>"><?=$video;?></a></br>
			    <?php }?>
			    <div class="showOnHover">
			    	<p></p>
					<?php
					if (!isset($delete))
						echo "<form method='POST'>
					      	<button type='submit' name='upvote_$post_id' value=\"upvote\" class='btn btn-xs btn-success'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span>$upvote</button>
					      	<button type='submit' name='downvote_$post_id' value=\"downvote\" class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span>$downvote</button>
					      	<button type='submit' name='bookmark_$post_id' value=\"bookmark\" class='btn btn-xs btn-info'><span class='glyphicon glyphicon-bookmark' aria-hidden='true'></span></button>
					      	</form>";
					else
						echo "<form method='POST'>
							<button type='submit' name='delete_$post_id' value=\"delete\" class='btn btn-xs btn-default'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>
							</form>";
					?>
			    </div>
			  </div>
			</div>
			<hr />

<?php } //end of loop ?>