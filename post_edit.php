<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: admin_login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edytor posta</title>
  <link rel="stylesheet" href="styl2.css">
</head>

<body>
  <header>
    <h1>Edytor posta</h1>
    <a href="logout.php">Wyloguj</a>
  </header>
  <div class="main">
    <?php
    require_once "conn.php";
    $id = $_GET['id'];
    $sql = "SELECT * FROM posts WHERE id = '$id'";
    mysqli_query($conn, $sql);
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='post'>";
        echo "<form action='post_edit.php' method='POST' enctype='multipart/form-data'>";
        echo"<label for='title'>Tytuł</label>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'><br>";
        echo "<input type='text' name='title' value='" . $row['title'] . "'><br>";
        echo"<br>";
        echo"<label for='content'>Treść</label>";
        echo "<textarea name='content' cols='30' rows='10'>" . $row['content'] . "</textarea><br>";
        echo "<input type='submit' value='Zapisz' name='submit'>";
        echo "</form>";
        echo "</div>";
      }
    }


    if (isset($_POST['submit'])) {
      $id = $_POST['id'];
      $title = $_POST['title'];
      $content = $_POST['content'];
      
      $sql = "UPDATE posts SET title = '$title', content = '$content' WHERE id = '$id'";
      //zapisz zapytanie w pliku sql
      $file = fopen("sql.txt", "w");
      fwrite($file, $sql);
      fclose($file);
      //dodaj wyświetlanie zdjęcia



      mysqli_query($conn, $sql);
      if (mysqli_query($conn, $sql)) {
        echo "Post został zaktualizowany";
        echo "<script>alert('Post został zaktualizowany');</script>";
        header('Location: post_editor.php');

      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }

    ?>
  </div>
</body>

</html>