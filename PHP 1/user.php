<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP</title>
		<meta charset='UTF-8' />
	</head>
	<body>
        <a href="index.php">Index</a> 
        <?php

            echo "<h1>Zalogowano</h1>";
            if($_SESSION["zalogowany"] != 1){
                header("Location: index.php");
            }
            else{
                echo "<p>Imię i nazwisko: " . $_SESSION['zalogowanyImie'] . "</p>";
            }


            if(isSet($_POST["upload"])){
                $currentDir = getcwd();
                $uploadDirectory = "\zdjeciaUzytkownikow\s";
                $fileName = $_FILES['myfile']['name'];
                $fileSize = $_FILES['myfile']['size'];
                $fileTmpName = $_FILES['myfile']['tmp_name'];
                $fileType = $_FILES['myfile']['type'];

                    $uploadPath = $currentDir . $uploadDirectory . $fileName;
                    if(move_uploaded_file($fileTmpName, $uploadPath)){
                        echo "<img src='zdjeciaUzytkownikow\spicture.JPG' alt='picture'>";
                    }

                }

            


		?>

        <form action='user.php' method='POST' enctype='multipart/form-data'>
            <fieldset>
            <legend>Image upload:</legend>
            <input name="myfile" type="file">
            <input type="submit" value="Upload" name="upload">
            </fieldset>
        </form>
        
        <br>
        <form action="index.php" method="post">
			<input type="submit" value="Wyloguj" name="wyloguj">
		</form>

	</body>
</html>