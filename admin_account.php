<?php
session_start();//for starting the session
if($_SESSION["authuser"]!=2){//for checking the session user as authorized or not
    header("Location:admin_login.php");//if not then redirected to login page again
}
include("db.php");//including the database connection file
if(isset($_POST['submit']))//when submit button is pressed
{   
    try {
            $name=$_SESSION["uname"];
            $stmt = $conn->prepare("SELECT * FROM admin where uname=:name"); 
            $stmt->bindParam(':name', $name, PDO::PARAM_STR, 20);
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $id=$row['id']; 
                $dbpword=$row['password']; 
            }
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    $oldpword = $_POST['oldpword'];
    $name = $_POST['name'];
    $uname = $_POST['uname'];
    $pword = $_POST['pword'];
  if($oldpword==$dbpword){ //matching current enterd password by database stored password for validation purpose  
    if(!empty($name) && !empty($uname) && !empty($pword)){//if matches
        $sql="update admin set name=:name,uname=:uname,password=:pword where id=:id";
        $conn = $conn->prepare($sql);
        $conn->bindParam(':name',$name,PDO::PARAM_STR);
        $conn->bindParam(':uname',$uname,PDO::PARAM_STR);
        $conn->bindParam(':pword',$pword,PDO::PARAM_STR);
        $conn->bindParam(':id',$id,PDO::PARAM_STR);
        $conn->execute();
        echo "<script>
       alert('Updated please login again');
           window.location.href='admin_login.php';
           </script>";

    }
}
else{//if not matched
    echo "<script>
       alert('Old password not matched');
           window.location.href='admin_account.php';
           </script>";
}
}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
   
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
                    <li><a href="admin_allusers.php">All Users</a></li>
                    <li><a href="admin_alltransaction.php">All transaction</a></li>
                    <li class="active"><a href="admin_account.php">Admin Account</a></li>
                </ul>
            </nav>
            
        </div> 
        <?php
        try {
            $name=$_SESSION["uname"];
            $stmt = $conn->prepare("SELECT * FROM admin where uname=:name"); 
            $stmt->bindParam(':name', $name, PDO::PARAM_STR, 20);
            $stmt->execute();
        }catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
        <div class="col-md-10 blogShort" style="background-color:#f6f1ec">
        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
           
            <img src="images/<?php echo $row['image']?>" class="img-responsive">  
            <h1>Hello <?php echo ($row['Name']); ?></h1>
            <h2>Your User Name:- <?php echo ($row['uname']); ?></h2> 
            <br><br>
    <?php } ?>
     <div>
       <h3>Want to edit</h3>
         <form action="" method="post">
            <div class="form-group"> Name:<input type="text" class="form-control" name="name" required></div>
            <br>
            <div class="form-group">User Name:<input type="text" class="form-control" name="uname" required></div>
            <br>
            <div class="form-group">Current Password:<input type="password" class="form-control" name="oldpword" required></div>
            <br>
            <div class="form-group">New Password:<input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" name="pword" required></div>
            <br>
            <input type="submit" class="btn btn-default" name="submit" value="Submit">
          </form>
      </div><br><br>
      <form name="ajax_form" id="ajax_form">
        <table>
            <tr>
                <td><input type="file" name="my_file" id="my_file" required></td>
            </tr>
            <tr>
                <td>
                    <button type="submit">Change Pic</button>
                </td>
            </tr>
        </table>
    </form>
    </div>
    
    <br><br><br><form action="" method="post">
    <input type="submit" name="logout" class="btn btn-primary btn-sm btn-block" value="Logout">
</form>
</div>
</body>
<script src="ajax_demo.js"></script>
</html>    	
