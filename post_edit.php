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
    <title>Edytor posta</title>
    <link rel= "stylesheet" href="styl2.css">
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
        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<form action='post_edit.php' method='post' enctype='multipart/form-data'>";
                echo "<input type='text' name='title' value='".$row['title']."'>";
                echo "<input type='text' name='content' value='".$row['content']."'>";
                echo "<input type='file' name='fileToUpload' id='fileToUpload'>";
                echo "<input type='submit' value='Upload Image' name='submit'>";
                echo "</form>";
            }
        
        }
        if(isset($_POST['submit'])){

            $titlenew = $_POST['title'];
            $content = $_POST['content'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
              }
              if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
              }
              if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
              && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
              }
              if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
              } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                  echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                } else {
                  echo "Sorry, there was an error uploading your file.";
                }
                }
                $sql1 = "UPDATE posts SET title = ';$titlenew;', content = ';$content;', image = ';$target_file;' WHERE id = ';$id;'";
                mysqli_query($conn, $sql1);
                if (mysqli_query($conn, $sql1) === TRUE) {
                    echo "<script>alert('Post został zaktualizowany!')</script>";
                  } else {
                    echo "Błąd: " . mysqli_error($conn);
                  }
                //header('Location: post_editor.php');
        }
        ?>
    </div>
</body>
</html>

