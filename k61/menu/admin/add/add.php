<?php
require_once '../../auth.php';
checkUserRole('admin');

include "../../db_conn.php";

if (isset($_POST['submit'])) {
    $u_name = $_POST['u_name'];
    $u_password = password_hash($_POST['u_password'], PASSWORD_DEFAULT); // Haszowanie hasła
    $u_role = $_POST['u_role'];

    // Sprawdź, czy użytkownik o podanej nazwie już istnieje
    $checkSql = "SELECT * FROM `users` WHERE `u_name` = ?";
    $stmt = mysqli_prepare($conn, $checkSql);
    mysqli_stmt_bind_param($stmt, "s", $u_name);
    mysqli_stmt_execute($stmt);
    $checkResult = mysqli_stmt_get_result($stmt);

    // Sprawdź, czy zapytanie było poprawne
    if (!$checkResult) {
        die("Błąd zapytania: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($checkResult) > 0) {
        // Użytkownik o podanej nazwie już istnieje
        echo "Użytkownik o podanej nazwie już istnieje.";
    } else {
        // Dodaj nowego użytkownika do bazy danych
        $insertSql = "INSERT INTO `users` (`u_name`, `u_password`, `u_role`) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertSql);
        mysqli_stmt_bind_param($stmt, "sss", $u_name, $u_password, $u_role);
        $insertResult = mysqli_stmt_execute($stmt);

        if ($insertResult) {
            echo "Rekord został dodany poprawnie.";
        } else {
            echo "Błąd podczas dodawania rekordu: " . mysqli_error($conn);
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../style.css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="../../scripts.js"></script>
    <title>Audyt sprzętu</title>
</head>

<body>
    <!-- TOP -->
    <div id="top">
        Użytkownicy systemu
        <a href="../show.php">
            <div id="home">
                <i id="y" class="fa fa-home fa-2x"></i>
            </div>
        </a>
    </div>

    <!-- MENU BOCZNE -->
    <div id="menu">
        <div class="buttons" id="wysun">
            <div class="info">Schowaj</div>
            <div id="gap"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <div class="sidegap"></div>
        <a href="javascript:delay('../../logout.php')">
            <div class="buttons" id="logout">
                <div class="info">Wyloguj</div>
                <div id="side_button"><i class="fa fa-sign-out fa-2x"></i></div>
            </div>
        </a>
    </div>

    <!-- STRONA -->
    <div id="strona">
        <div id="header">Dodaj użytkowników</div>
        <div id="main">
            <form method="post" action="">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Login</th>
                            <th scope="col">Password</th>
                            <th scope="col">Role</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td><input type="text" name="u_name" placeholder="Login" required></td>
                            <td><input type="password" name="u_password" placeholder="Password" required></td>
                            <td>
                                <select name="u_role" required>
                                    <option value="admin">Admin</option>
                                    <option value="mode">Moderator</option>
                                    <option value="user">User</option>
                                </select>
                            </td>
                            <td>
                                <input type="submit" name="submit" value="Dodaj">
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
        <div id="footer"></div>
    </div>
</body>

</html>
