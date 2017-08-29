<?php
session_start();
include 'connect.php';

if(!empty($_POST['title'])&&!empty($_POST['category'])&&!empty($_POST['content'])){
	$poster_id = $_SESSION['id'];
	$title = $_POST['title'];
	$category = $_POST['category'];
	$content = $_POST['content'];
	$video = $_POST['video'];
	$query = mysql_query("INSERT INTO posts (user_fk, title, category, content, video)
		VALUES ('$poster_id', '$title', '$category', '$content', '$video')");
	if($query){
		echo "<script>
		alert('Lifehack posted');
		window.location.href='index.php';
		</script>";
	}
	else
		echo "<script>
		alert('Something went wrong');
		window.location.href='index.php';
		</script>";
}
else
	echo "<script>
	alert('*Please fill in all required fields');
	window.location.href='index.php';
	</script>";
?>