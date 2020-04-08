<?php
    session_start();
    require("funkcje.php");
    
    class Osoba {
        public $login;
        public $haslo;
        public $imieNazwisko;
    }

    $osoba1 = new Osoba;
    $osoba1->login = "adam";
    $osoba1->haslo = "adam2020";
    $osoba1->imieNazwisko = "Adam Kowalski";

    $osoba2 = new Osoba;
    $osoba2->login = "agata";
    $osoba2->haslo = "2020agata";
    $osoba2->imieNazwisko = "Agata Nowak";

    function autoryzacja($login, $haslo){
        global $osoba1;
        global $osoba2;
        if($login == $osoba1->login && $haslo == $osoba1->haslo){
            $_SESSION["zalogowanyImie"] = $osoba1->imieNazwisko;
            $_SESSION["zalogowany"] = 1;
            header("Location: user.php");
        }
        else if($login == $osoba2->login && $haslo == $osoba2->haslo){
            $_SESSION["zalogowanyImie"] = $osoba2->imieNazwisko;
            $_SESSION["zalogowany"] = 1;
            header("Location: user.php");
        }
        else{
            header("Location: index.php");
        }
    }

    if(isSet($_POST["zaloguj"])){
        $login = test_input($_POST["login"]);
        $haslo = test_input($_POST["haslo"]);
        //echo "<p>Przesłany login: $login<br>";
        //echo "Przesłane hasło: $haslo</p>";

        autoryzacja($login, $haslo);
    }
?>