
<?php
session_start();
if($_SESSION["authuser"]!=1){
	header("Location:user_login.php");
}
include("db.php");
if(isset($_POST['update']))
{
	$uname=$_GET['uname'];
	$name = $_POST['name'];
	$age = $_POST['age'];
	$oldpword=md5($_POST['oldpword']);
	$pword = md5($_POST['pword']);
		try {
			//$uname=$_GET["uname"];
			$stmt = $conn->prepare("SELECT * FROM users1 where uname=:uname"); 
			$stmt->bindParam(':uname', $uname, PDO::PARAM_STR, 20);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		}catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
  if($oldpword==$row['pword']){		
	if(!empty($name) && !empty($age) && !empty($pword)){
		$sql="update users1 set name=:name,age=:age,pword=:pword where uname=:uname and pword=:oldpword";
		$conn = $conn->prepare($sql);
		$conn->bindParam(':name',$name,PDO::PARAM_STR);
		$conn->bindParam(':age',$age,PDO::PARAM_STR);
		$conn->bindParam(':pword',$pword,PDO::PARAM_STR);
		$conn->bindParam(':uname',$uname,PDO::PARAM_STR);
		$conn->bindParam(':oldpword',$oldpword,PDO::PARAM_STR);
		$conn->execute();
		echo "<script>
       alert('Updated , Login Again ');
           window.location.href='user_login.php';
           </script>";
	}
}
else{
	echo "<script>
       alert('Password not matched ');
           window.location.href='user_account.php?uname=$uname';
           </script>";
}

}
if(isset($_POST['back']))
{   

	header("Location:user_index.php");

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
			background:url(header1.png) no-repeat;
			text-align:center;
		}
		.body1{
			background:url(pic.jpg) no-repeat;
			background-size: cover;

		}
		.h1s{
			padding-top: 20px;
		}
	</style>
</head>
<body class="body1">

	<div class="container">
		<div class="header">
			<h1 class="h1s"><font size="40">Update User</font></h1>
		</div><br><br>
		<?php
		try {
			$uname=$_GET["uname"];
			$stmt = $conn->prepare("SELECT * FROM users1 where uname=:uname"); 
			$stmt->bindParam(':uname', $uname, PDO::PARAM_STR, 20);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		}catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		?>
		<form action="" method="post">
			<div class="form-group"><b>Edit Name:<b><input type="text" value="<?php  echo ($row['name']); ?>"class="form-control" name="name"></div>
				<br>
				<div class="form-group">Edit Age:<input type="text" value="<?php  echo ($row['age']); ?>"class="form-control" name="age"></div>
				<br>
				<div class="form-group">Current Password:<input type="password" class="form-control" name="oldpword" required></div>
				<br>
				<div class="form-group">New Password:<input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" name="pword" required></div>
				<br>*Uname cannot be updated*<br>

				<input type="submit" class="btn btn-warning" name="update" value="Update">
		</form>
				<form action="" method="post"><div style='float: right;'>  <input type="submit" class="btn btn-warning" name="back" value="Back" ></div>
				</form><br><br>
				<br>

				<div style='float: right;font-size:30px'> <?php echo "<a onclick='javascript:confirmationDelete($(this));return false;' href='delete_account.php?uname=".$_SESSION["uname"]."'>Delete Account</a>";?></div>
				<script type="text/javascript">
				function confirmationDelete(anchor)
				{
   				var conf = confirm('Are you sure want to delete your account?');
   				if(conf)
     			 window.location=anchor.attr("href");
				}</script>
			</div>

		</form>
	</body>
	<html>