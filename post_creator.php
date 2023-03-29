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
      if(isset($_POST['sumbit'])){
          $title = $_POST['title'];
          $content = $_POST['content'];
          $image = $_POST['image'];
          $date = date('Y-m-d H:i:s');
          require_once 'conn.php';
          //send image to folder
          $target_dir = "images/";
          $target_file = $target_dir . basename($_FILES["image"]["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          // Check if image file is a actual image or fake image
          if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
              echo "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
            } else {
              echo "File is not an image.";
              $uploadOk = 0;
            }
          }
          // Check if file already exists
          if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
          }
          // Check file size
          if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
          }
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
          }

          $sql = "INSERT INTO posts (title, content, image, date) VALUES ('$title', '$content', '$image', '$date')";
          $result = mysqli_query($conn, $sql);
          if($result){
              echo "<script>alert('Dodano post!')</script>";
          }else{
              echo "Błąd, spróbuj ponownie";
          }
      }
      ?>
</body>
</html>

