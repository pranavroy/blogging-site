<?php
session_start();//for starting the session
if($_SESSION["authuser"]!=2){//for validating the user as authorised or not
    header("Location:admin_login.php");//if not authorized then again go to login page
}
include("db.php");//including database connection page 
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
    <?php
    try {
        $id=$_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM blog where id=:id"); 
        $stmt-> bindParam(':id',$id, PDO::PARAM_STR);
        $stmt->execute();
    }catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
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
                    <li><a href="admin_account.php">Admin Account</a></li>
                </ul>
            </nav>
            
        </div>

        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
           <div  style="background-color:#f6f1ec" class="col-md-10 blogShort">
               <h1><?php echo ($row['title']); ?></h1>
               <article><p>
                   <?php echo ($row['content']); ?>    
               </p></article>
               <?php echo ($row['name']); ?><br>
               <?php echo ($row['time']); ?>

               <div id="disqus_thread"></div>
               <script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://bloo-1.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</div>
<?php } ?>
<form action="" method="post">
    <input type="submit" name="logout" class="btn btn-primary btn-sm btn-block" value="Logout">
</form>
<div class="col-md-12 gap10"></div>
</div>
</div>
</body>
</html>    	
