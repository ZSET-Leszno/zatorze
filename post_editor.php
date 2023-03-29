<?php
session_start();
     if(!isset($_SESSION['admin'])){
               header('Location: admin_login.php');
                 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytor postów</title>
    <link rel= "stylesheet" href="styl2.css">
</head>
<body>
    <header>
        <h1>Edytor postów</h1>
        <a href="logout.php">Wyloguj</a>
    </header>
    <div class="main">
        <?php
        require_once "conn.php";
        $sql = "SELECT * FROM posts";
        mysqli_query($conn, $sql);
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<div class='post'>";
                echo "<h2>".$row['title']."</h2>";
                echo "<a href='post_edit.php?id=".$row['id']."'>Edytuj</a>";
                echo "<a href='post_delete.php?title=".$row['title']."'>Usuń</a>";
                echo "</div>";
            }
        
        }
        

        ?>


    </div>
</body>
</html>