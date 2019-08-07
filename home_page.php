<?php
include("db.php");
?>
<html>
<head>
	<title>
		Blogging
	</title>
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body class="body1">
	<div class="container">
		<div class="header">
			<h1 class="h1s"><font size="40"> Creative Blogs</font></h1>
		</div>
		<div id="blog" class="row"> 
			<div class="col-sm-2 paddingTop20">
				<nav class="nav-sidebar">
					<ul class="nav">
						<li><a href="user_login.php"><i class="glyphicon glyphicon-off"></i>User Sign in</a></li>
						<li><a href="user_signup.php"><i class="glyphicon glyphicon-off"></i>New User</a></li>
						<li><a href="admin_login.php"><i class="glyphicon glyphicon-off"></i>Admin sign in</a></li>
					</ul>
				</nav>
				    <div><h2 class="add"></h2></div>
			</div>
			<?php
			try {
				$stmt = $conn->prepare("SELECT * FROM blog where status=1 ORDER BY id DESC"); 
				$stmt->execute();
			}catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			?>
			<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
				<div style="background-color:#f6f1ec" class="col-sm-10 blogShort bg1">
					<h1><?php echo ($row['title']); ?></h1>
					<article><p>
						<?php echo ($row['content']); ?>    
					</p></article>
					By:-<?php echo ($row['name']); ?><br>
					Posted on:-<?php echo ($row['time']); ?>
					<?php echo "<a href='readfull_post.php?id=".$row['id']."'>Read Comments</a>";?><br><br>
				</div>
			<?php } ?>


		</div>
	</div>
</body>
</html>    	
