<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP</title>
		<meta charset='UTF-8' />
	</head>
	<body>
		<?php
			require("funkcje.php");

			echo "<h1>Nasz system</h1>";

			if(isSet($_POST["wyloguj"])){
				$_SESSION["zalogowany"] = 0;
			}

			if(isSet($_COOKIE["Fajne_ciasteczko"])){
				echo "Wartość ciasteczka: " . $_COOKIE["Fajne_ciasteczko"];
			}
		?>

		<fieldset>
  		<legend>Logowanie:</legend>
			<form action="logowanie.php" method="post">
				Login: <input type="text" name="login"><br>
				Hasło: <input type="text" name="haslo"><br>
				<input type="submit" value="Zaloguj" name="zaloguj">
			</form>
		</fieldset>
		<br>
		<a href="user.php">User</a>

	</body>
</html>