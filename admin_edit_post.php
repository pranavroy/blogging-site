<?php
session_start();
if($_SESSION["authuser"]!=2){
	header("Location:admin_login.php");
}
include("db.php");
$id=$_GET['id'];
if(isset($_POST['submit']))
{
	$id=$_GET['id'];
	$title=$_POST['title'];
	$content=$_POST['content'];
	if(!empty($title) && !empty($content)){
		$time=date("Y-m-d H:i:s");
							//$name=$_SESSION["uname"];
		$sql="update blog set title=:title,content=:content,time=:time where id=:id";
		$conn = $conn->prepare($sql);
		$conn->bindParam(':title',$title,PDO::PARAM_STR);
		$conn->bindParam(':content',$content,PDO::PARAM_STR);
		$conn->bindParam(':time',$time,PDO::PARAM_STR);
							//$conn->bindParam(':name',$name,PDO::PARAM_STR);
		$conn->bindParam(':id',$id,PDO::PARAM_STR);
		$conn->execute();
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
		<h1 class="h1s"><font size="40">Edit Blog</font></h1>
	</div>
		<?php
		try {
			$id=$_GET["id"];
			$stmt = $conn->prepare("SELECT * FROM blog where id=:id"); 
			$stmt->bindParam(':id', $id, PDO::PARAM_STR, 20);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		}catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		?>
		<form action="" method="post">
			<div class="form-group">
				<b>Edit Title<b> <input type="text" value="<?php  echo ($row['title']); ?>" class="form-control" name="title"></div>
				<br>
				<div class="form-group">
					Edit Content <textarea class="form-control" name="content" rows="20" cols="50"><?php  echo ($row['content']); ?>
				</textarea>
			</div>
			<br><br>
			<input type="submit" class="btn btn-warning" name="submit" value="Update">
			<div style='float: right;'>  <input type="submit" class="btn btn-warning" name="back" value="Back" ></div>
		</form>
	</div>
</body>
