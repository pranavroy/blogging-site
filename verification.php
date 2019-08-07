<?php
session_start();
if($_SESSION["authuser"]!=2){
    header("Location:admin_login.php");
}
include("db.php");
if(isset($_GET['id']))
                        {   
                    $id=$_GET['id'];
                   $sql="update blog set status=1 where id=:id";
							$conn = $conn->prepare($sql);
							$conn->bindParam(':id',$id,PDO::PARAM_STR);
                            $conn->execute();
                      header("Location:admin_verify_post.php");

                        }
?>