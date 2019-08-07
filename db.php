<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_database='assignment';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$db_database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
	catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
function Redirect($url) { 
       if(headers_sent()) { 
               echo "<script type='text/javascript'>location.href='$url';</script>"; 
       } else { 
               header("Location: $url"); 
       } 
} 
?>