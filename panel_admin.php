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
        // Pobranie danych z formularza
        $title = $_POST["title"];
        $content = $_POST["content"];
        $image = $_FILES["image"]["name"];

        // Dodanie posta do bazy danych
        $sql = "INSERT INTO posts (title, content, image) VALUES ('$title', '$content', '$image')";

        if ($conn->query($sql) === TRUE) {
            // Przesłanie zdjęcia na serwer
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            echo "Post added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
      ?>
</body>
</html>

