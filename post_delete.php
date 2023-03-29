<?php
//usuanie posta
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
    <title>Usuwanie posta</title>
    <link rel="stylesheet" href="styl2.css">
</head>
<body>
    <header>
        <h1>Usuwanie posta</h1>
        <a href="logout.php">Wyloguj</a>
    </header>
    <div class="main">
        <?php
        require_once "conn.php";
        $title = $_GET['title'];
        $sql = "DELETE FROM posts WHERE title = '$title'";
        mysqli_query($conn, $sql);
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Post został usunięty!')</script>";
          } else {
            echo "Błąd: " . mysqli_error($conn);
          }
        header('Location: post_editor.php');
        

        ?>
    </div>
</body>
</html>
