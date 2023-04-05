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
  <title>Edytor multimediów w poście</title>
  <link rel="stylesheet" href="styl2.css">
</head>

<body>
  <header>
    <h1>Edytor multimediów</h1>
    <a href="logout.php">Wyloguj</a>
    <a href="post_editor.php">Powrót</a>
    <a href="index.php">Strona główna</a>
    </header>
    <div class="main">
    <?php
    require_once "conn.php";
    $id = $_GET['id'];
    $sql = "SELECT * FROM posts WHERE id = '$id'";
    mysqli_query($conn, $sql);
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='post'>";
            echo "Zdjęcia z posta: ".$row['title'];
            echo "<a href='post_photo_add.php?id=".$row['id']."'>Dodaj zdjęcie</a>";
            echo "<img src=".$row["image"].">";
            echo "<a href='post_photo_delete.php?image=".$row['image']."'>Usuń zdjęcie</a>";
            echo "</div>";
        }
    
    }

    ?>
    </div>
</body>
</html>