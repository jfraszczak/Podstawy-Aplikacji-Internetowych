<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP</title>
		<meta charset='UTF-8' />
	</head>
	<body>
		<h1>Cookies</h1>
		
		<?php
			require("funkcje.php");

			if(isSet($_GET["utworzCookie"])){
				setcookie("Fajne_ciasteczko", "Fajna_wartosc", time() + ($_GET["czas"]), "/");
				echo "Utworzono ciasteczko";
			}

		?>
		<fieldset>
  		<legend>Czas życia ciasteczka:</legend>
		<form action="cookie.php" method="get">
			Czas: <input type="number" name="czas"><br>
			<input type="submit" name="utworzCookie">
		</form>
		</fieldset>
		<br>
		<a href="index.php">Wstecz</a> 
			
	</body>
</html>