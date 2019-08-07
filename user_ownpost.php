<?php
session_start();
if($_SESSION["authuser"]!=1){
    header("Location:user_login.php");
}
include("db.php");
if(isset($_POST['logout']))
{   
    session_unset();
    header("Location:home_page.php");

}
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
<body>
    <div class="container">
    	<div class="header">
            <h1 class="h1s"><font size="40"> Creative Blogs</font></h1>
        </div>
        <div id="blog" class="row"> 

          <div class="col-sm-2 paddingTop20">
            <nav class="nav-sidebar">
                <ul class="nav">
                    <li><a href="user_index.php">Home Page</a></li>
                    <li class="active"><a href="user_ownpost.php">Your Blogs</a></li>
                    <li><a href="user_addpost.php">Create Blogs</a></li>
                    <li><a href="user_delete.php">Update/Delete Blogs</a></li>
                    <li><?php echo "<a href='user_account.php?uname=".$_SESSION["uname"]."'>Update/delete Account</a>";?></li>
                </ul>
            </nav>
        </div>
        <?php
        try {
         $name=$_SESSION["uname"];
         $stmt = $conn->prepare("SELECT * FROM blog where name=:name and status=1"); 
         $stmt->bindParam(':name', $name, PDO::PARAM_STR, 20);
         $stmt->execute();
     }catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
    <div style="background-color:#f6f1ec" class="col-md-10 blogShort">
        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>

         <h1><?php echo ($row['title']); ?></h1>
         <article><p>
             <?php echo ($row['content']); ?>    
         </p></article>
         <?php  echo ($row['name']); ?><br>
         <?php echo ($row['time']); ?>
         <?php echo "<a href='readfull_post.php?id=".$row['id']."'>Read More</a>";?>

     <?php } ?>
     <br><br><br>

 </div>
 <form action="" method="post">
    <input type="submit" name="logout" class="btn btn-primary btn-sm btn-block" value="Logout">
</form>
<div class="col-md-12 gap10"></div>
</div>

</div>
</body>
</html>    	
