<?php
include "../db_conn.php";
$id = $_GET['id'];
$sql = "DELETE FROM `uzytkownicy` WHERE id=$id";
$sql2 = "UPDATE `komputery` SET komputery.id_u=0, komputery.imie ='Nieprzypisane', komputery.nazwisko ='Nieprzypisane' WHERE id_u=$id;";
$sql3 = "UPDATE `wyswietlacze` SET wyswietlacze.id_u=0, wyswietlacze.imie ='Nieprzypisane', wyswietlacze.nazwisko ='Nieprzypisane' WHERE id_u=$id";
$sql4 = "UPDATE `peryferia` SET peryferia.id_u=0, peryferia.imie ='Nieprzypisane', peryferia.nazwisko ='Nieprzypisane' WHERE id_u=$id";
$result = mysqli_query($conn, $sql);
if($result){
    echo "Procedura usuwania wykonana poprawnie";
}
else{
    echo "Niepowodzenie: " .mysqli_error($conn);
}
$result2 = mysqli_query($conn, $sql2);
if($result2){
    echo "Procedura usuwania wykonana poprawnie";
}
else{
    echo "Niepowodzenie: " .mysqli_error($conn);
}
$result3 = mysqli_query($conn, $sql3);
if($result3){
    echo "Procedura usuwania wykonana poprawnie";
}
else{
    echo "Niepowodzenie: " .mysqli_error($conn);
}
$result4 = mysqli_query($conn, $sql4);
if($result4){
    echo "Procedura usuwania wykonana poprawnie";
}
else{
    echo "Niepowodzenie: " .mysqli_error($conn);
}
header('Location: show.php');
