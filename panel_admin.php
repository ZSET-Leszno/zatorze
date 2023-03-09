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
<h1>Dodaj nowy post ze zdjęciem:</h1>
<form method="post" enctype="multipart/form-data">
        <label for="tytul">Tytuł:</label>
        <input type="text" name="tytul" required><br><br>
        <label for="zdjecie">Zdjęcie:</label>
        <input type="file" name="zdjecie" required><br><br>
        <label for="opis">Opis:</label><br>
        <textarea name="opis" rows="10" cols="50" required></textarea><br><br>
        <input type="submit" value="Dodaj">
    </form>
    <?php
// Sprawdzenie czy formularz został wysłany
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  require_once 'conn.php';

  $tytul = $_POST['tytul'];
  $opis = $_POST['opis'];
  $zdjecie = 'photos/' . basename($_FILES['zdjecie']['name']);
  
  if (move_uploaded_file($_FILES['zdjecie']['tmp_name'], $zdjecie)) {
      // plik został przesłany i przeniesiony do odpowiedniego folderu
  } else {
      // wystąpił błąd podczas przesyłania pliku
  }
  
  $sql = "INSERT INTO posty (tytul, zdjecie, opis) VALUES ('$tytul', '$zdjecie', '$opis')";
  
  if ($conn->query($sql) === TRUE) {
      echo "Dodano nowy post";
      // polecenie SQL zostało wykonane pomyślnie
  } else {
      echo "Błąd: " . $sql . "<br>" . $conn->error;
  }
  
  // Zamykanie połączenia z bazą danych
  $conn->close();
}
?>
</body>
</html>

