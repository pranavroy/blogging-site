<?php
	session_start();
	include 'db.php';

	if($_SESSION["authuser"]!=2)
	{
    	header("Location:admin_login.php");
	}
	if(isset($_FILES) && isset($_FILES['my_file']['name']) && isset($_FILES['my_file']['tmp_name']))
	{
		$file_ext = substr($_FILES['my_file']['name'], strpos($_FILES['my_file']['name'], '.'));
		$file_name = bin2hex(random_bytes(10)).$file_ext;

		if(move_uploaded_file($_FILES['my_file']['tmp_name'], 'images/'.$file_name))
		{
			try
			{ 
				$uname = $_SESSION["uname"];
				$q = $conn->prepare("UPDATE admin SET image=:image WHERE uname = :uname");
				$q->bindParam(':image', $file_name);
				$q->bindParam(':uname', $uname);
				$q->execute();
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
			//echo json_encode(['response' => 1, 'phone' => 123465798]);
		}
	}
?>