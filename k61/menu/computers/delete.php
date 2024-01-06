<?php
include "../db_conn.php"; #nawiązujemy połączenie z bazą danych

#------ WSTAWIAMY DO ZMIENNYCH DANE Z FORMULARZA---------#
$id = $_GET['id'];
$id_u = $_GET['id_u'];
$nr_seryjny_k = $_GET['nr_seryjny_k'];
#------POŁĄCZENIE Z BAZĄ DANYCH---------#
$connect = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
if (mysqli_connect_errno()) {
    echo "Błąd połączenia z bazą";
}
 #-------------ZAPISUJEMY DO ZMIENNYCH ZAPYTANIA SQL-----------------#
$sql = "DELETE FROM `komputery` WHERE id=$id";
$u_sql = "UPDATE `uzytkownicy` SET uzytkownicy.nr_seryjny_k=NULL WHERE uzytkownicy.id=$id_u";
#------------WYKONUJEMY ZAPYTANIE SQL------------------#
$result = mysqli_query($connect, $sql);
if ($result === FALSE) {
    die(mysqli_error($connect));
}
#------------WYKONUJEMY ZAPYTANIE SQL------------------#
$result2 = mysqli_query($connect, $u_sql);
if ($result === FALSE) {
    die(mysqli_error($connect));
}
header('Location: show.php');
