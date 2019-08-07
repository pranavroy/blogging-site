
<?php
session_start();
if($_SESSION["authuser"]!=2){
	header("Location:admin_login.php");
}
include("db.php");
if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$age = $_POST['age'];
	$uname = $_POST['uname'];
	$pword = md5($_POST['pword']);
	if(!empty($name) && !empty($age) && !empty($uname) && !empty($pword)){
		$sql = "INSERT INTO  users1(name, age, uname, pword) VALUES ('$name','$age','$uname','$pword')";
		$conn->exec($sql);
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
		<h1 class="h1s"><font size="40">Add User</font></h1>
	</div>
		<form action="" method="post">
			<div class="form-group"><b> Name:<b><input type="text" class="form-control" name="name" required></div>
			<br>
			<div class="form-group">Age:<input type="number" class="form-control" name="age" required></div>
			<br>
			<div class="form-group">User Name:<input type="text" class="form-control" name="uname" required></div>
			<br>
			<div class="form-group">Password:<input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" name="pword" required></div>
			<br>

			<input type="submit" class="btn btn-warning" name="submit" value="Submit">
		</form>
		<form action="" method="post">
			<div style='float: right;'>  <input type="submit" class="btn btn-warning" name="back" value="Back" ></div>
			</form>
		</div>
</body>
<html>