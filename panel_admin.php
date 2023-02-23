<html>
<head>
<meta charset="utf-8">
<title>Panel Logowania</title>
<link rel="stylesheet" href="style.css">
<meta name="description" content="Zadania lekcyjne">
<meta name="author" content="Maksymilian Igras">
<meta name="keywords" content="HTML, CSS, PHP" >
<?php
   ob_start();
   session_start();
?>
</head>
<body>
<p>Zadania Aplikacje Internetowe</p><br>
<div name="main"><div id="menu" >
<?php include'menu.php';?>
</div>
<div id="content" ><div>
<?php
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['user']) 
               && !empty($_POST['password'])) {
				
               if ($_POST['user'] == 'admin' && $_POST['password'] == 'zaq1@WSX') {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['user'] = 'admin';
				echo ('Wprowadziłeś poprawne hasło. Witaj Admin');
               }
			   else {
                  $msg = 'Błąd! Złe hasło, bądź login';
               }
            }
         ?><br></div>
<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "POST">
            <?php echo $msg; ?><br>
            <input type = "text" name = "user" placeholder = "użytkownik = admin"></br>
            <input type = "password" name = "password" placeholder = "hasłow = zaq1@WSX" required><br>
            <button type = "submit" name = "login">Zaloguj</button><br
         </form>
		  Kliknija aby się <a href = "panel_admin_logout.php">wylogować</a>.
</div></div>
<footer>
Maksymilian Igras 4TI2A <?php echo date('d-m-y');

echo  ' Data ostatniej modyfikacji: '.date("F d Y H:i:s.", filemtime(".php"));
?>
</footer>
</body>
</html>