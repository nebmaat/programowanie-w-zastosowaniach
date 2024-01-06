<?php
require_once '../../auth.php';
checkUserRole('admin');

include "../../db_conn.php";

// Pobierz listę użytkowników do wyboru
$userListSql = "SELECT `u_id`, `u_name`, `u_role` FROM `users`";
$userListResult = mysqli_query($conn, $userListSql);

// Sprawdź, czy przesłano formularz
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sprawdź, czy wybrano użytkownika z listy
    if (isset($_POST['selected_user'])) {
        $selectedUserId = $_POST['selected_user'];

        // Pobierz informacje o wybranym użytkowniku
        $userInfoSql = "SELECT `u_name`, `u_role` FROM `users` WHERE `u_id` = $selectedUserId";
        $userInfoResult = mysqli_query($conn, $userInfoSql);

        if ($userInfoResult) {
            $userInfo = mysqli_fetch_assoc($userInfoResult);
            $userNameToEdit = $userInfo['u_name'];
            $userRoleToEdit = $userInfo['u_role'];

            // Sprawdź, czy zalogowany użytkownik jest różny od użytkownika do edycji
            if ($userNameToEdit !== $_SESSION['login']) {
                // Edytuj rolę użytkownika
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $newRole = $_POST['new_role'];

                    // Sprawdź, czy nowa rola należy do dozwolonych wartości
                    $allowedRoles = array("admin", "mode", "user");
                    if (in_array($newRole, $allowedRoles)) {
                        // Zaktualizuj wartość kolumny "u_role" w bazie danych
                        $updateSql = "UPDATE `users` SET `u_role` = '$newRole' WHERE `u_id` = $selectedUserId";
                        $updateResult = mysqli_query($conn, $updateSql);

                        if ($updateResult) {
                            header('Location: ../show.php'); // Przekieruj na stronę show.php po pomyślnej aktualizacji
                            exit();
                        } else {
                            echo "Błąd podczas aktualizacji roli użytkownika: " . mysqli_error($conn);
                        }
                    } else {
                        echo "Wybrano niedozwoloną rolę.";
                    }
                }
            } else {
                echo "Nie możesz edytować swojej własnej roli.";
            }
        } else {
            echo "Błąd podczas pobierania informacji o użytkowniku: " . mysqli_error($conn);
        }
    } else {
        echo "Proszę wybrać użytkownika do edycji.";
    }
}

require_once '../../auth.php';

// Wywołaj funkcję sprawdzającą rolę
checkUserRole('admin');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../style.css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="../../scripts.js"></script>
    <title>Zmiana roli użytkownika</title>
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
        <div id="header">Zmiana roli użytkownika</div>
        <div id="main">
    <form action="" method="post">
        <table>
            <tr>
                <td><label for="selected_user">Wybierz użytkownika:</label></td>
                <td>
                    <select name="selected_user" id="selected_user">
                        <?php
                        while ($user = mysqli_fetch_assoc($userListResult)) {
                            $selected = ($user['u_id'] == $selectedUserId) ? 'selected' : '';
                            echo "<option value=\"{$user['u_id']}\" $selected>{$user['u_name']} - {$user['u_role']}</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="new_role">Nowa rola:</label></td>
                <td>
                    <select name="new_role" id="new_role">
                        <option value="admin">Admin</option>
                        <option value="mode">Mode</option>
                        <option value="user">User</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Zmień rolę" name="submit"></td>
            </tr>
        </table>
    </form>
</div>

        <div id="footer">
            <!-- STOPKA -->
        </div>
    </div>
</body>

</html>
