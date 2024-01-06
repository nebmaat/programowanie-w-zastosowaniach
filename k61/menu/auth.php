<?php
// Importuj plik z połączeniem do bazy danych


function checkUserRole() {
    // Sprawdź, czy użytkownik jest zalogowany
    session_start();
    if (!isset($_SESSION['login'])) {
        header("Location: http://wsbk61.eu/index.php"); // Przekieruj na stronę logowania, jeśli nie jest zalogowany
        exit();
    }

    include "db_conn.php";

    // Sprawdź, czy użytkownik ma odpowiednią rolę
    $loggedInUser = $_SESSION['login'];
    $sql = "SELECT u_role FROM users WHERE u_name = '$loggedInUser'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Jeśli rola użytkownika nie jest zgodna z wymaganą rolą, przekieruj go na inną stronę
        $allowedRoles = func_get_args(); // Pobierz wszystkie argumenty funkcji

        if (!in_array($user['u_role'], $allowedRoles)) {
            switch ($user['u_role']) {
                case 'admin':
                    header("Location: http://wsbk61.eu/menu/admin/show.php");
                    break;
                case 'mode':
                    header("Location: menu.php");
                    break;
                default:
                    header("Location: http://wsbk61.eu/menu/spectator/show.php");
                    break;
            }
            exit();
        }
    } 
}

function redirectToRolePage() {
    // Sprawdź, czy użytkownik jest zalogowany
    session_start();
    if (!isset($_SESSION['login'])) {
        header("Location: ../index.php"); // Przekieruj na stronę logowania, jeśli nie jest zalogowany
        exit();
    }

    include "db_conn.php";

    // Sprawdź, czy użytkownik ma odpowiednią rolę
    $loggedInUser = $_SESSION['login'];
    $sql = "SELECT u_role FROM users WHERE u_name = '$loggedInUser'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

            switch ($user['u_role']) {
                case 'admin':
                    header("Location: http://wsbk61.eu/menu/admin/show.php");
                    break;
                case 'mode':
                    header("Location: menu.php");
                    break;
                default:
                    header("Location: http://wsbk61.eu/menu/spectator/show.php");
                    break;
            }
            exit();
        }
    } 
?>
