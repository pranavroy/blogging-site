<?php
session_start();
if($_SESSION["authuser"]!=1){
    header("Location:user_login.php");
}
include("db.php");
if(isset($_GET['id']))
                        {   
                    $id=$_GET['id'];
                    $sql = "delete from blog WHERE  id=:id";
                    $query = $conn->prepare($sql);
                    $query-> bindParam(':id',$id, PDO::PARAM_STR);
                    $query -> execute();
                      header("Location:newuser_own_blogs.php");

                        }
?>