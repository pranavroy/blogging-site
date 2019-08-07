<?php
session_start();
if($_SESSION["authuser"]!=2){
	header("Location:admin_login.php");
}
include("db.php");
if(isset($_POST['submit']))
{
	$title=$_POST['title'];
	$content=$_POST['content'];
	if(!empty($title) && !empty($content)){
		$time=date("Y-m-d H:i:s");
		$name=$_SESSION["uname"];
		$sql = "INSERT INTO blog (title, content, time, name,status) VALUES ('$title','$content','$time','$name','1')";
		$conn->exec($sql);
		header("Location:admin_index.php");
	}

}
if(isset($_POST['back']))
{   

	header("Location:admin_index.php");

}						
?>
<html>
<head>
	<title>Write Post</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<style>
		.header{
			height:100px;
			background:url(header.jpg) no-repeat;
			text-align:center;
		}
		body{
			background:url(pic1.jpg) no-repeat;
			background-size: cover;
		}
		.h1s{
			padding-top: 20px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="header">
		<h1 class="h1s"><font size="40">Add Blog</font></h1>
	</div><br>
		<form action="" method="post">
			<div class="form-group">
				<b>Title<b> <input type="text" class="form-control" name="title" required></div>
				<br>
				<div class="form-group">
					Blog <textarea class="form-control" name="content" rows="20" cols="50" required></textarea></div>
					<br><br>
					<input type="submit" class="btn btn-warning" name="submit" value="Post">
		</form>		
		        <form action="" method="post">	
					<div style='float: right;'>  <input type="submit" class="btn btn-warning" name="back" value="Back" ></div>
				</form>
			</div>
		</body>
