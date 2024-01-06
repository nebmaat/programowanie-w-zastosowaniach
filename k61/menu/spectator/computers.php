<?php
require_once '../auth.php';
checkUserRole('user');

error_reporting(E_ERROR | E_PARSE);
include "../db_conn.php";

$sql = "SELECT * FROM `komputery`;";
$result = mysqli_query($conn, $sql);

if ($result === FALSE) {
    die(mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style.css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="../scripts.js"></script>
    <title>Audyt sprzętu</title>
</head>

<body>
    <div id="top">
        Audyt sprzętu
        <a href="../menu.php">
            <div id="home">
                <i id="y" class="fa fa-home fa-2x"></i>
            </div>
        </a>
    </div>

    <div id="menu">
        <div class="buttons" id="wysun">
            <div class="info">Schowaj</div>
            <div id="gap"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>

        <div class="sidegap"></div>

        <a href="javascript:delay('../logout.php')">
            <div class="buttons" id="logout">
                <div class="info">Wyloguj</div>
                <div id="side_button"><i class="fa fa-sign-out fa-2x"></i></div>
            </div>
        </a>
    </div>

    <div id="strona">
        <div id="header">Komputery</div>
        <div id="main">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID użytkownika</th>
                        <th scope="col">Imię</th>
                        <th scope="col">Nazwisko</th>
                        <th scope="col">Producent</th>
                        <th scope="col">Model</th>
                        <th scope="col">Numer seryjny</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['id_u'] ?></td>
                            <td><?php echo $row['imie'] ?></td>
                            <td><?php echo $row['nazwisko'] ?></td>
                            <td><?php echo $row['producent'] ?></td>
                            <td><?php echo $row['model'] ?></td>
                            <td><?php echo $row['nr_seryjny_k'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="footer"></div>
    </div>
</body>

</html>
