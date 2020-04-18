<?php
    session_start();

    $link = mysqli_connect("localhost", "scott", "tiger", "instytut");

    if (!$link) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    
    if (isset($_POST['id_prac']) && is_numeric($_POST['id_prac']) && is_string($_POST['nazwisko']))
    {
        $sql = "INSERT INTO pracownicy(id_prac,nazwisko) VALUES(?,?)";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("is", $_POST['id_prac'], $_POST['nazwisko']);
        $result = $stmt->execute();
        if (!$result) {
            $_SESSION["ERROR"] = 1;
            $_SESSION["ERROR_MESSAGE"] = mysqli_error($link);
            header('Location: form06_post.php');
        }
        else{
            $_SESSION["SUCCESS"] = 1;
            header('Location: form06_get.php');
        }
        $stmt->close();
    }
?>