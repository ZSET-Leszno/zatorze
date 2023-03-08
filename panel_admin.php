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
    <title>Panel administratora</title>
</head>
<body>
    <h1>Panel administratora</h1>
    <a href="logout.php">Wyloguj</a>
    <form action="panel_admin.php" method="post">
        <input type="text" name="title" placeholder="Tytuł">
        <textarea name="content" cols="30" rows="10" placeholder="Treść"></textarea>
        <input type="file" name="image">
        <input type="submit" value="Dodaj">
      </form>
      <?php
        // sprawdzenie czy zostały przesłane dane
        if(isset($_POST['title']) && isset($_POST['content'])){
            // połączenie z bazą danych
            require_once 'conn.php';
            // dodanie wpisu do bazy danych
            $sql = "INSERT INTO posts (title, content, image) VALUES ('{$_POST['title']}', '{$_POST['content']}', '{$_FILES['image']['name']}')";            $result = mysqli_query($conn, $sql);
            // sprawdzenie czy dodanie wpisu się powiodło
            if($result){
                echo 'Dodano wpis';
            } else {
                echo 'Wystąpił błąd podczas dodawania wpisu';
            }
        }
      ?>
</body>
</html>

