<?php
#PODAJEMY DANE DO WYKONANIA POŁĄCZENIA Z BAZĄ DANYCH
$dbservername = "phpmyadmin54.lh.pl";
$dbusername = "serwer77843_wsbk61p7";
$dbpassword = "G_uzW^9M";
$dbname = "serwer77843_wsbk61p7";

#NAWIAZUJEMY POŁĄCZENIE
$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);

#SPRAWDZAMY CZY POŁĄCZENIE ZOSTAŁO NAWIĄZANE
if (!$conn) {
    die("Połączenie nieudane: " . mysqli_connect_error());
}

#USTAWIAMY KODOWANIE ZNAKÓW NA UTF-8
if (!mysqli_set_charset($conn, "utf8")) {
    die("Błąd podczas ustawiania kodowania: " . mysqli_error($conn));
}
?>
