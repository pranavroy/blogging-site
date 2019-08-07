<?php
session_start();//for starting the session
if($_SESSION["authuser"]!=2){//for checking the session user as authorized or not
    header("Location:admin_login.php");//if not then referred t login page again
}
include("db.php");//including the database connection page
if(isset($_POST['logout']))//when logout button is pressed
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
                    <li><a href="admin_index.php">Home Page</a></li>
                    <li><a href="admin_verify_post.php">Verify Post</a></li>
                    <li><a href="admin_addpost.php">Add Post</a></li>
                    <li class="active"><a href="admin_allusers.php">All Users</a></li>
                    <li><a href="admin_alltransaction.php">All transaction</a></li>
                    <li><a href="admin_account.php">Admin Account</a></li>
                </ul>
            </nav>
            
        </div> 
        <?php
        try {
           $stmt = $conn->prepare("SELECT * FROM users1"); 
           $stmt->execute();
       }catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
    <div class="col-md-10 blogShort" style="background-color:#f6f1ec"><br><br>
        <table class="table" cellpadding="0" cellspacing="0" border="1px">
            <tr>
                <td><b>Id</b></td>
                <td><b>Name</b></td>
                <td><b>Age</b></td>
                <td><b>Uname</b></td>
                <td><b>Password</b></td>
                <td></td>
                <td></td>
            </tr>
            <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
               <tr>
                <td><?php echo ($row['id']); ?></td>
                <td><?php echo ($row['name']); ?></td>
                <td><?php echo ($row['age']); ?></td>
                <td><?php echo ($row['uname']); ?></td>
                <td><?php echo ($row['pword']); ?></td>
                <td><?php echo "<a href='admin_edit_users.php?id=".$row['id']."'>Edit</a>";?></td>
                <td><?php echo "<a href='admin_delete_users.php?uname=".$row['uname']."'>Delete</a>";?></td>

            </tr>
        <?php } ?>

    </table>
    <div style='float: right;font-size:30px'><a href="admin_add_users.php">Add User</a></div>
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
