<?php
session_start();
$_SESSION["authuser"]=0;

include("db.php");
if(isset($_POST['submit']))
{
	$uname=$_POST['name'];
	$pword=md5($_POST['pass']);

	if($uname==""){ $error="<br><span class=error>Please enter a username</span><br><br>"; }
	elseif($pword==""){ $error="<br><span class=error>Please enter the password</span><br><br>"; }
	else
	{
		$stmt = $conn->prepare("SELECT uname, pword FROM users1 WHERE (uname=:uname) and (pword=:pword)"); 

		$stmt-> bindParam(':uname', $uname);
		$stmt-> bindParam(':pword', $pword);
		$stmt-> execute();
		$results=$stmt->fetchAll(PDO::FETCH_OBJ);
		if($stmt->rowCount() > 0)
		{
		 
			$_SESSION["uname"]=$uname;
			$_SESSION["authuser"]=1;
			echo "<script>
       alert('Login Success as user ');
           window.location.href='user_index.php';
           </script>";

		} else{
			echo "<script>alert('Invalid Details');</script>";
		}
	}
}
if(isset($_POST['back']))
{   

	header("Location:home_page.php");

} 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Blogging</title>
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
		.h1s{
			padding-top: 20px;
		}
		.body1{
			background:url(write.jpg) no-repeat;
			background-size: cover;

		}
	</style>
</head>
<body class="body1">
	<div class="container">
		<div class="header">
			<h1 class="h1s"><font size="40">Sign in..</font></h1>
		</div><br><br><br>
		<form action="" method="post">
			<div class="form-group">
				<b>Username: <b>           <input type="text" class="form-control" name="name" required>
			</div>
				<br>
			<div class="form-group">
					Password:            <input type="password" class="form-control" name="pass" required>
			</div>
					<br><br>
					<input type="submit" class="btn btn-warning" name="submit" value="login"></form>
					<form method="post"><div style='float: right;'>  <input type="submit" class="btn btn-warning" name="back" value="Back" ></div></form>
		</form>
	</div>
</div>
</body>
<html>