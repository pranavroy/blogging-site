
<?php
session_start();//For starting the session
if($_SESSION["authuser"]!=2){
	header("Location:admin_login.php");//refer to login page again if not authorised
}
include("db.php");//for connecting to the database
if(isset($_POST['submit']))//when submit button is clicked
{
	$id=$_GET['id'];
	$name = $_POST['name'];
	$age = $_POST['age'];
	$uname = $_POST['uname'];
	$pword = $_POST['pword'];
	$pword = hash('sha256', $pword);
	if(!empty($name) && !empty($age) && !empty($uname) && !empty($pword)){
		$sql="update users1 set name=:name,age=:age,uname=:uname,pword=:pword where id=:id";
		$conn = $conn->prepare($sql);
		$conn->bindParam(':name',$name,PDO::PARAM_STR);
		$conn->bindParam(':age',$age,PDO::PARAM_STR);
		$conn->bindParam(':pword',$pword,PDO::PARAM_STR);
		$conn->bindParam(':uname',$uname,PDO::PARAM_STR);
		$conn->bindParam(':id',$id,PDO::PARAM_STR);
		$conn->execute();
		header("Location:admin_allusers.php");

	}
}
if(isset($_POST['back']))
{   

	header("Location:admin_allusers.php");

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Enter Here</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<style>
		.header{
      height:100px;
      background:url(header1.png) no-repeat;
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
		<h1 class="h1s"><font size="40">Edit User</font></h1>
	</div>
		<form action="" method="post">
			<?php
			try {
				$id=$_GET["id"];
				$stmt = $conn->prepare("SELECT * FROM users1 where id=:id"); 
				$stmt->bindParam(':id', $id, PDO::PARAM_STR, 20);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
			}catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			?>
			<div class="form-group"><b>Edit Name:<b><input type="text" value="<?php  echo ($row['name']); ?>" class="form-control" name="name" required></div>
			<br>
			<div class="form-group">Edit Age:<input type="number" value="<?php  echo ($row['age']); ?>" class="form-control" name="age" required></div>
			<br>
			<div class="form-group">Edit User Name:<input type="text"value="<?php  echo ($row['uname']); ?>" class="form-control" name="uname" required></div>
			<br>
			<div class="form-group">New Password:<input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" name="pword" required></div>
			<br>

			<input type="submit" class="btn btn-warning" name="submit" value="Submit">
			<div style='float: right;'>  <input type="submit" class="btn btn-warning" name="back" value="Back" ></div></div>

		</form>
	</body>
	<html>