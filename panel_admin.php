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
    <link rel="stylesheet" href="styl2.css">
</head>
<body>
    <h1>Panel administratora</h1>
    <a href="logout.php">Wyloguj</a>
    <a href="post_editor.php">Edytor postów</a>
    <form action="panel_admin.php" method="post" enctype="multipart/form-data">
  <input type = "text" name = "title" placeholder = "Tytuł">
  <input type = "text" name = "content" placeholder = "Opis">
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>
      <?php
$unikeid = uniqid("post");
require_once "conn.php";
//multiple images

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $target_dir = "uploads/";
$target_file = $target_dir .$unikeid. basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $title = $_POST['title'];
          $content = $_POST['content'];
         
          $date = date('Y-m-d H:i:s');
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
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
    $nazwa= htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". $nazwa. " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
$sql = "INSERT INTO posts (title, content, image, date) VALUES ('$title', '$content', '$target_file', '$date')";
          $result = mysqli_query($conn, $sql);
          if($result){
              echo "<script>alert('Post został dodany!')</script>";
          }else{
              echo "Błąd, spróbuj ponownie";
          }
        }
      ?>
</body>
</html>

