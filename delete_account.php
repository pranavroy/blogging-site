<?php
session_start();
if($_SESSION["authuser"]!=1){
    header("Location:newlogin_page.php");
}
include("db.php");
if(isset($_GET['uname']))
                        {   
                    $uname=$_GET['uname'];
                    $sql = "delete from users1 WHERE uname=:uname";
                    $query = $conn->prepare($sql);
                    $query-> bindParam(':uname',$uname, PDO::PARAM_STR);
                    $query -> execute();
                    $sql = "delete from blog WHERE name=:uname";
                    $query = $conn->prepare($sql);
                    $query-> bindParam(':uname',$uname, PDO::PARAM_STR);
                    $query -> execute();
                    echo "<script>
       alert('Deleted Account Successfully');
           window.location.href='newhome_page.php';
           </script>";

                        }
?>