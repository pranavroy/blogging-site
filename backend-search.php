<?php
include("db.php");//for connecting to database
if(isset($_REQUEST["term"])){
	 try {
	 	$param_term = $_REQUEST["term"] . '%';
        $stmt = $conn->prepare("SELECT * FROM blog where title like :param_term and status=1"); 
        $stmt-> bindParam(':param_term', $param_term);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        	echo "<h1>".$row['title']."</h1>";
        	echo"<p>".$row['content']."</p>";
        	echo"By:-<h3>".$row['name']."</h3>";
        	echo"<h4>".$row['time']."</h4>";

        }
      }catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
}
?>