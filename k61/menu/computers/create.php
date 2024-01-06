<?php
include "../db_conn.php";

if (isset($_POST['submit'])) {
    #------ WSTAWIAMY DO ZMIENNYCH DANE Z FORMULARZA---------#
    $id_u = $_POST['id_u'];
    $producent = $_POST['producent'];
    $model = $_POST['model'];
    $nr_seryjny_k = $_POST['nr_seryjny_k'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    
    #-------------ZAPISUJEMY DO ZMIENNYCH ZAPYTANIA SQL-----------------#
    $sql_u_name = "SELECT imie FROM `uzytkownicy` WHERE id=$id_u;";
    $sql_u_surname = "SELECT nazwisko FROM `uzytkownicy` WHERE id=$id_u;";
    #------------WYKONUJEMY ZAPYTANIE SQL------------------#
    $zapytanie_u_name = mysqli_query($conn, $sql_u_name);
    $zapytanie_u_surname = mysqli_query($conn, $sql_u_surname);
    
    # Dodane zabezpieczenie: Sprawdzamy, czy zapytanie zwróciło poprawny wynik
    if (!$zapytanie_u_name || !$zapytanie_u_surname) {
        echo "Błąd w zapytaniu do bazy danych: " . mysqli_error($conn);
        exit;
    }

    #--------------WYNIK ZAPYTANIA SQL ZAPISUJEMY DO ZMIENNYCH----------------#
    $u_name = '';
    $u_surname = '';
    while ($row = mysqli_fetch_assoc($zapytanie_u_name)) {
        $u_name = $row['imie'];
    }
    while ($row = mysqli_fetch_assoc($zapytanie_u_surname)) {
        $u_surname = $row['nazwisko'];
    }
    
    #------------ZAPISUJEMY DO ZMIENNYCH ZAPYTANIA SQL------------------#
    $sql = "INSERT INTO `komputery`(`imie`, `nazwisko`, `producent`, `model`, `nr_seryjny_k`, `id_u`) 
    VALUES ('$u_name','$u_surname','$producent','$model','$nr_seryjny_k', '$id_u')";
    $u_sql = "UPDATE `uzytkownicy` SET `nr_seryjny_k`='$nr_seryjny_k' WHERE id=$id_u";
    
    #------------WYKONUJEMY ZAPYTANIE SQL------------------#
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Procedura wykonana poprawnie";
    } else {
        echo "Błąd:" . mysqli_error($conn);
        exit; // Dodane zabezpieczenie: Przerywamy wykonanie skryptu w przypadku błędu
    }
    #------------WYKONUJEMY ZAPYTANIE SQL------------------#
    $result2 = mysqli_query($conn, $u_sql);
    if ($result2) {
        echo "Procedura wykonana poprawnie";
    } else {
        echo "Błąd:" . mysqli_error($conn);
        exit; // Dodane zabezpieczenie: Przerywamy wykonanie skryptu w przypadku błędu
    }
    header('Location: show.php');
}
?>
