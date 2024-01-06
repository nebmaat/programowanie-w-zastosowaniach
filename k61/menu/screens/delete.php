<?php
include "../db_conn.php";
$id = $_GET['id'];
$id_u = $_GET['id_u'];
$nr_seryjny_k = $_GET['nr_seryjny_w'];
$connect = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
if (mysqli_connect_errno()) {
    echo "Błąd połączenia z bazą";
}
#------------------------------#
$sql = "DELETE FROM `wyswietlacze` WHERE id=$id";
$u_sql = "UPDATE `uzytkownicy` SET uzytkownicy.nr_seryjny_w=NULL WHERE uzytkownicy.id=$id_u";
#------------------------------#
$result = mysqli_query($connect, $sql);
if ($result === FALSE) {
    die(mysqli_error($connect));
}
#------------------------------#
$result2 = mysqli_query($connect, $u_sql);
if ($result === FALSE) {
    die(mysqli_error($connect));
}
header('Location: show.php');
