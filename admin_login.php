<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel logowania administratora</title>
</head>
<body>
    // panel logowania administratora
    <form action="admin_login.php" method="post">
        <input type="text" name="login" placeholder="Login">
        <input type="password" name="password" placeholder="Hasło">
        <input type="submit" value="Zaloguj">
    </form>
    <?php
        // sprawdzenie czy zostały przesłane dane
        if(isset($_POST['login']) && isset($_POST['password'])){
            // sprawdzenie czy dane są poprawne
            if($_POST['login'] == 'admin' && $_POST['password'] == 'admin'){
                // zalogowanie administratora
                session_start();
                $_SESSION['admin'] = true;
                header('Location: admin_panel.php');
            } else {
                // wyświetlenie komunikatu o błędnych danych
                echo 'Błędny login lub hasło';
            }
        }
    ?>
    
</body>
</html>