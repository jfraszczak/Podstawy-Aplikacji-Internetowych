<?php
    session_start();

    $link = mysqli_connect("localhost", "scott", "tiger", "instytut");

    if (!$link) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $sql = "SELECT * FROM pracownicy";
    $result = $link->query($sql);
    foreach ($result as $v) {
        echo $v["ID_PRAC"]." ".$v["NAZWISKO"]."<br/>";
    }
    $result->free();
    $link->close();

    print('<a href="form06_post.php">Dodaj</a>');
    
    if(isSet($_SESSION['SUCCESS'])){
        if($_SESSION['SUCCESS'] == 1){
            printf('<p>');
            printf("Successfully added a new employee");
            printf('</p>');
            $_SESSION['SUCCESS'] = 0;
        }
    }
?>