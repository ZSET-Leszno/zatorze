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
        $sql = "SELECT title FROM posts";
        mysqli_query($conn, $sql);
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<div class='post'>";
                echo "<h2>".$row['title']."</h2>";
                echo "<a href='post_edit.php?title=".$row['title']."'>Edytuj</a>";
                echo "<a href='post_delete.php?title=".$row['title']."'>Usuń</a>";
                echo "</div>";
            }
        
        }
        $title = $_GET['title'];
        $sql = "SELECT * FROM posts WHERE title = '$title'";
        mysqli_query($conn, $sql);
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<form action='post_editor.php' method='post' enctype='multipart/form-data'>";
                echo "<input type = 'text' name = 'title' placeholder = 'Tytuł' value='".$row['title']."'>";
                echo "<input type = 'text' name = 'content' placeholder = 'Opis' value='".$row['content']."'>";
                echo "<input type='file' name='fileToUpload' id='fileToUpload'>";
                echo "<input type='submit' value='Upload Image' name='submit'>";
                echo "</form>";
            }
        
        }
        if(isset($_POST['submit'])){
            $title = $_POST['title'];
            $content = $_POST['content'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
              $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
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
            if ($_FILES["fileToUpload"]["size"] > 500000) {
              echo "Sorry, your file is too large.";
              $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
              echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
              } else {
                echo "Sorry, there was an error uploading your file.";
              }
            }
            $sql = "UPDATE posts SET title = '$title', content = '$content', image = '$target_file' WHERE title = '$title'";
            mysqli_query($conn, $sql);
            if (mysqli_query($conn, $sql)) {
                echo
                "<script>
                alert('Post został zaktualizowany');
                window.location.href='post_editor.php';
                </script>";
                } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
        }

        ?>


    </div>
</body>
</html>