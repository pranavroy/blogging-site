<?php
session_start();//for starting the session
if($_SESSION["authuser"]!=2){//for validating the user as it is authorized or not
    header("Location:admin_login.php");
}
include("db.php");//including database connection
if(isset($_POST['logout']))//when logout button is clicked
{   
    session_unset();
    header("Location:newhome_page.php");//referred to home page

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
                    <li class="active"><a href="admin_index.php">Home Page</a></li>
                    <li><a href="admin_verify_post.php">verify Post</a></li>
                    <li><a href="admin_addpost.php">Add Post</a></li>
                    <li><a href="admin_allusers.php">All Users</a></li>
                    <li><a href="admin_alltransaction.php">All transaction</a></li>
                    <li><a href="admin_account.php">Admin Account</a></li>
                </ul>
            </nav>
            
        </div> 
        <?php
        try {
            $stmt = $conn->prepare("SELECT * FROM blog where status=1 ORDER BY id DESC"); 
           $stmt->execute();
       }catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
    <div class="col-md-10 blogShort" style="background-color:#f6f1ec" >
        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>

           <h1><?php echo ($row['title']); ?></h1>
           <article><p>
               <?php echo ($row['content']); ?>    
           </p></article>
           By:-<?php echo ($row['name']); ?><br>
           Posted on:-<?php echo ($row['time']); ?>
           <?php echo "<a href='admin_readfull_post.php?id=".$row['id']."'>Read More</a>";?><br>
           <?php echo "<a href='admin_edit_post.php?id=".$row['id']."'>Edit</a>";?><br>
           <?php echo "<a href='admin_delete_post.php?id=".$row['id']."'>Delete</a>";?>

       <?php } ?>
       <br><br>
</div>
</div>
<form action="" method="post">
    <input type="submit" name="logout" class="btn btn-primary btn-sm btn-block" value="Logout">
</form>
<div class="col-md-12 gap10"></div>
</div>

</div>
</body>
</html>    	
