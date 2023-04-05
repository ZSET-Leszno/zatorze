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
    <?php
    require_once "conn.php";
    $image = $_GET['image'];
    $sql = "DELETE image FROM posts WHERE image = '$image'";
    mysqli_query($conn, $sql);
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Zdjęcie zostało usunięte!')</script>";
      } else {
        echo "Błąd: " . mysqli_error($conn);
      }
    header('Location: post_photo_editor.php');
    ?>


</body>