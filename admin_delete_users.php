<?php
session_start();
if($_SESSION["authuser"]!=2){
    header("Location:admin_login.php");
}
include("db.php");
if(isset($_GET['uname']))
                        {   
                    //$id=$_GET['id'];
                    $uname=$_GET['uname'];
                    $sql = "delete from users1 WHERE  uname=:uname";
                    $query = $conn->prepare($sql);
                    $query-> bindParam(':uname',$uname, PDO::PARAM_STR);
                    $query -> execute();
                    $sql = "delete from blog WHERE name=:uname";
                    $query = $conn->prepare($sql);
                    $query-> bindParam(':uname',$uname, PDO::PARAM_STR);
                    $query -> execute();
                      header("Location:admin_allusers.php");

                        }
?>