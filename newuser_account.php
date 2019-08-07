<?php
session_start();//for starting the session
if($_SESSION["authuser"]!=1){//for checking session of the user
  header("Location:newlogin_page.php");
}
include("db.php");
if(isset($_POST['update']))//when update button is clicked
{
  $uname=$_SESSION['uname'];
  $name = $_POST['name'];
  $age = $_POST['age'];
  $oldpword=$_POST['oldpword'];
  $oldpword = hash('sha256', $oldpword);
  $pword = $_POST['pword'];
  $pword = hash('sha256', $pword);
    try {
      //$uname=$_GET["uname"];
      $stmt = $conn->prepare("SELECT * FROM users1 where uname=:uname"); 
      $stmt->bindParam(':uname', $uname, PDO::PARAM_STR, 20);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  if($oldpword==$row['pword']){  //matches current entered password with the database stored password for validation purpose 
  if(!empty($name) && !empty($age) && !empty($pword)){//if matched
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
           window.location.href='newlogin_page.php';
           </script>";
  }
}
}
if(isset($_POST['logout']))//when logout button is pressed
{   
    session_unset();
    header("Location:newhome_page.php");//referred to home page

}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>blogs</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="css/blog-home.css" rel="stylesheet">
<style>
  .header {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-direction: column;
    flex-direction: column;
    -ms-flex-pack: center;
    justify-content: center;
    min-height: 350px;
    padding-top: 4rem;
    padding-bottom: 4rem;
    color: #fff;
    background-color: #777;
}
*, ::after, ::before {
    box-sizing: box;
}
h1 {
    font-size: 3.5rem;
    font-weight: 300;
    line-height: 1.1;
}
.header h1 a {
    color: #fff;
    text-decoration: none;
}
/*********footer*******************/
. kilimanjaro_area {
    position: relative;
    z-index: 1;
  }
  .foo_top_header_one {
    background-color: #15151e;
    color: #fff;
}
.section_padding_100_70 {
    padding-top: 100px;
    padding-bottom: 70px;
}
.foo_top_header_one {
    color: #fff;
}.kilimanjaro_part {
    margin-bottom: 30px;
}
.foo_top_header_one .kilimanjaro_part > h5 {
    color: #fff;
}
.kilimanjaro_part h4, .kilimanjaro_part h5 {
    margin-bottom: 30px;
}
.kilimanjaro_single_contact_info > p, .kilimanjaro_single_contact_info > h5, .kilimanjaro_blog_area > a, .foo_top_header_one .kilimanjaro_part > p {
    color: rgba(255,255,255,.5);
}
p, ul li, ol li {
    font-weight: 300;
}
ul {
    margin: 0;
    padding: 0;
}
.kilimanjaro_bottom_header_one {
    background-color: #111;
}
.section_padding_50 {
    padding: 50px 0;
}
.kilimanjaro_bottom_header_one p {
    color: #fff;
    margin: 0;
}
p, ul li, ol li {
    font-weight: 300;
}
.kilimanjaro_bottom_header_one a {
    color: inherit;
    font-size: 14px;
}
a, h1, h2, h3, h4, h5, h6 {
    font-weight: 400;
}
.m-top-15 {
    margin-top: 15px;
}
ul {
    margin: 0;
    padding: 0;
}

.kilimanjaro_widget > li {
    display: inline-block;
}
p, ul li, ol li {
    font-weight: 300;
}
ol li, ul li {
    list-style: outside none none;
}
.kilimanjaro_widget a {
    border: 1px solid #333;
    border-radius: 6px;
    color: #888;
    display: inline-block;
    font-size: 13px;
    margin-bottom: 4px;
    padding: 7px 12px;
}
ul {
    margin: 0;
    padding: 0;
}
.kilimanjaro_links a {
    border-bottom: 1px solid #333;
    color: rgba(255,255,255,.5);
    display: block;
    font-size: 13px;
    margin-bottom: 5px;
    padding-bottom: 10px;
}
.kilimanjaro_links a {
    color: rgba(255,255,255,.5);
    font-size: 13px;
}
top-15 {
    margin-top: 15px;
}
.foo_top_header_one .kilimanjaro_part > h5 {
    color: #fff;
}
.kilimanjaro_part h4, .kilimanjaro_part h5 {
    margin-bottom: 30px;
}
.kilimanjaro_social_links > li {
    display: inline-block;
}
p, ul li, ol li {
    font-weight: 300;
}
.kilimanjaro_social_links a {
    border: 1px solid #333;
    border-radius: 6px;
    color: #888;
    display: inline-block;
    font-size: 13px;
    margin-bottom: 3px;
    padding: 7px 12px;
}
.kilimanjaro_blog_area .kilimanjaro_date {
    color: #27ae60;
    font-size: 13px;
    margin-bottom: 5px;
}
.kilimanjaro_blog_area > p {
    color: rgba(255,255,255,.5);
    line-height: 1.3;
    margin-bottom: 0;
}
.kilimanjaro_works > a {
    display: inline-block;
    float: left;
    position: relative;
    width: 33.33333333%;
    z-index: 1;
}
.kilimanjaro_thumb {
    left: 0;
    position: absolute;
    top: 0;
    width: 75px;
}
.kilimanjaro_links a i {
    padding-right: 10px;
}
  /* :: 18.0 Footer Area CSS */

    .footer_area {
        position: relative;
        z-index: 1;
    }
 .footer_bottom p > i,
    .footer_bottom p > a:hover {
        color: #27ae60;
    } 

    .social_links_area {
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        padding: 50px 0 30px 0;
        text-align: center;
        position: relative;
        z-index: 1;
    }
 .social_links_area > a:hover {
        color: #27ae60;
    }

    .inline-style .social_links_area > a:hover {
        background-color: transparent;
        color: #27ae60;
        border: 0px solid transparent;
    }
 .single_feature:hover .feature_text h4 {
        color: #27ae60;
    }
.kilimanjaro_blog_area {
    border-bottom: 1px solid #333;
    margin-bottom: 15px;
    padding: 0 0 15px 90px;
    position: relative;
    z-index: 1;
}
.kilimanjaro_links a {
    border-bottom: 1px solid #333;
    color: rgba(255,255,255,.5);
    display: block;
    font-size: 13px;
    margin-bottom: 5px;
    padding-bottom: 10px;
}
</style>
  </head>

  <body>
<div class="section" id="b-section-header" name="Header"><div class="widget Header" data-version="2" id="Header1">
<div class="header image-placement-behind no-image">
<div class="container">
<h1><a href="">Creative Blogs</a></h1>
<p>Brainstormer</p>
</div>
</div>
</div></div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Creative Blogs</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="newuser_index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="newuser_own_blogs.php">Your Blogs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="newuser_addpost.php">Write Blogs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="newuser_account.php">Your Account</a>
            </li>
			
          </ul>
		  <div class="ml-auto my-2 my-lg-0">
<div class="section" id="b-section-navbar-search-form" name="Navbar: search form"><div class="widget BlogSearch" data-version="2" id="BlogSearch1">
<form action="" method="post" class="form-inline">
<input aria-label="Search this blog" class="form-control mr-sm-2" name="q" placeholder="Search this blog" type="text">
<button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
<input  type="submit" name="logout" class="btn btn-primary" value="Logout">
</form>
</div></div>
</div>
        </div>
      </div>
    </nav>
	
	



    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          <h1 class="my-4">Be Good To
            <small>Yourself</small>
          </h1>

          <!-- Blog Post -->
          <?php
    try {
      $uname=$_SESSION["uname"];
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
    </form><br>
    <div style='float: right;font-size:30px'> <?php echo "<a onclick='javascript:confirmationDelete($(this));return false;' href='delete_account.php?uname=".$_SESSION["uname"]."'>Delete Account</a>";?></div>
        <script type="text/javascript">
        function confirmationDelete(anchor)
        {
          var conf = confirm('Are you sure want to delete your account?');
          if(conf)
           window.location=anchor.attr("href");
        }</script>

        

          <!-- Pagination -->
          

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button">Go!</button>
                </span>
              </div>
            </div>
          </div>

          <!-- Categories Widget -->
          <div class="card my-3">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#">Simba</a>
                    </li>
                    <li>
                      <a href="#">Nyati</a>
                    </li>
                    <li>
                      <a href="#">Faru</a>
                    </li>
                  </ul>
                </div>
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#">Kiboko</a>
                    </li>
                    <li>
                      <a href="#">Fisi</a>
                    </li>
                    <li>
                      <a href="#">Pundamlia</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">maelezo</h5>
            <div class="card-body">
              You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
            </div>
          </div>
 <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">banner</h5>
            <div class="card-body">
              <img class="card-img-top" src="https://2.bp.blogspot.com/-vvG5hMTFOro/W6RaoxdAikI/AAAAAAAAK1k/jezYdP7fvfYvt15Jv8a0agrGQE2lMU8YgCKgBGAs/s1600/MASAI-2.jpg" alt="Card image cap">
            </div>
          </div>
          <!-- tweeter -->
          <div class="card my-4">
            <h5 class="card-header">Tweeter here</h5>
            <div class="card-body">
             
<a class="twitter-timeline" href="https://twitter.com/Luckmoshy?ref_src=twsrc%5Etfw">Tweets by Luckmoshy</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> 
<a href="https://twitter.com/Luckmoshy?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-show-count="false">Follow @Luckmoshy</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
          </div>
        </div>
          
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!--footer-->
<footer class="kilimanjaro_area">
        <!-- Top Footer Area Start -->
        <div class="foo_top_header_one section_padding_100_70">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="kilimanjaro_part">
                            <h5>About Us</h5>
                            <p>It includes rich features & contents. It's designed & developed based on One Page/ Multi-page Layout,blog themes,world press themes and blogspot. You can use any layout from any demo anywhere.</p>
                            <p>webblogoverflow is completely creative, clean & 100% responsive website. Put your business into next level with Webublogoverflow.</p>
                        </div>
                        <div class="kilimanjaro_part m-top-15">
                            <h5>Social Links</h5>
                            <ul class="kilimanjaro_social_links">
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></li>
                                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
                                <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i> YouTube</a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i> Linkedin</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="kilimanjaro_part">
                            <h5>Tags Widget</h5>
                            <ul class=" kilimanjaro_widget">
                                <li><a href="#">Classy</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Creative</a></li>
                                <li><a href="#">One Page</a></li>
                                <li><a href="#">Multipurpose</a></li>
                                <li><a href="#">Minimal</a></li>
                                <li><a href="#">Classic</a></li>
                                <li><a href="#">Medical</a></li>
                            </ul>
                        </div>

                        <div class="kilimanjaro_part m-top-15">
                            <h5>Important Links</h5>
                            <ul class="kilimanjaro_links">
                                <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Terms & Conditions</a></li>
                                <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>About Licences</a></li>
                                <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Help & Support</a></li>
                                <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Careers</a></li>
                                <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Privacy Policy</a></li>
                                <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Community & Forum</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="kilimanjaro_part">
                            <h5>Latest News</h5>
                            <div class="kilimanjaro_blog_area">
                                <div class="kilimanjaro_thumb">
								<img class="img-fluid" src="https://3.bp.blogspot.com/--C1wpaf_S4M/W7V__10nRoI/AAAAAAAAK24/1NSfapuYSIY0f0wzXY9NgoH0FjQLT07YACKgBGAs/s1600/maxresdefault.jpg" alt="">

                                </div>
                                <a href="#">Your Blog Title Goes Here</a>
                                <p class="kilimanjaro_date">21 Jan 2018</p>
                                <p>Lorem ipsum dolor sit amet, consectetur</p>
                            </div>
                            <div class="kilimanjaro_blog_area">
                                <div class="kilimanjaro_thumb">
								<img class="img-fluid" src="https://3.bp.blogspot.com/--C1wpaf_S4M/W7V__10nRoI/AAAAAAAAK24/1NSfapuYSIY0f0wzXY9NgoH0FjQLT07YACKgBGAs/s1600/maxresdefault.jpg" alt="">
                                </div>
                                <a href="#">Your Blog Title Goes Here</a>
                                <p class="kilimanjaro_date">21 Jan 2018</p>
                                <p>Lorem ipsum dolor sit amet, consectetur</p>
                            </div>
                            <div class="kilimanjaro_blog_area">
                                <div class="kilimanjaro_thumb">
								<img class="img-fluid" src="https://3.bp.blogspot.com/--C1wpaf_S4M/W7V__10nRoI/AAAAAAAAK24/1NSfapuYSIY0f0wzXY9NgoH0FjQLT07YACKgBGAs/s1600/maxresdefault.jpg" alt="">
                                </div>
                                <a href="#">Your Blog Title Goes Here</a>
                                <p class="kilimanjaro_date">21 Jan 2018</p>
                                <p>Lorem ipsum dolor sit amet, consectetur</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="kilimanjaro_part">
                            <h5>Quick Contact</h5>
                            <div class="kilimanjaro_single_contact_info">
                                <h5>Phone:</h5>
                                <p>+255 789 54 50 40 <br> +2255 766 90 94 00</p>
                            </div>
                            <div class="kilimanjaro_single_contact_info">
                                <h5>Email:</h5>
                                <p>support@webblogoverflow.com <br> luckmoshy@gmail.com</p>
                            </div>
                        </div>
                        <div class="kilimanjaro_part">
                            <h5>Latest Works</h5>
                            <div class="kilimanjaro_works">
                                <a class="kilimanjaro_works_img" href="img/gallery/1.jpg"><img src="img/gallery/1.jpg" alt=""></a>
                                <a class="kilimanjaro_works_img" href="img/gallery/4.jpg"><img src="img/gallery/4.jpg" alt=""></a>
                                <a class="kilimanjaro_works_img" href="img/gallery/5.jpg"><img src="img/gallery/5.jpg" alt=""></a>
                                <a class="kilimanjaro_works_img" href="img/gallery/7.jpg"><img src="img/gallery/7.jpg" alt=""></a>
                                <a class="kilimanjaro_works_img" href="img/gallery/10.jpg"><img src="img/gallery/10.jpg" alt=""></a>
                                <a class="kilimanjaro_works_img" href="img/gallery/11.jpg"><img src="img/gallery/11.jpg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom Area Start -->
        <div class=" kilimanjaro_bottom_header_one section_padding_50 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p>© All Rights Reserved by <a href="#">Webublogoverflow.blogspot -(with all love)<i class="fa fa-love"></i></a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>	
    <!-- Bootstrap core JavaScript -->
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </body>

</html>
