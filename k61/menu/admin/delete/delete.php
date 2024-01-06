<?php
require_once '../../auth.php';
checkUserRole('admin');

include "../../db_conn.php";

// Sprawdzanie, czy w adresie URL jest parametr "id" o wartości liczbowej
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_to_delete = $_GET['id'];

    // Pobierz login zalogowanego użytkownika
    $loggedInUser = $_SESSION['login'];

    // Wykonaj zapytanie do bazy danych w celu pobrania nazwy użytkownika i roli związanej z usuwanym rekordem
    $checkSql = "SELECT `u_name`, `u_role` FROM `users` WHERE `u_id` = $id_to_delete";
    $checkResult = mysqli_query($conn, $checkSql);

    if ($checkResult) {
        $row = mysqli_fetch_assoc($checkResult);
        $userNameToDelete = $row['u_name'];
        $userRoleToDelete = $row['u_role'];

        // Sprawdź, czy nazwa użytkownika do usunięcia jest różna od nazwy zalogowanego użytkownika
        // oraz czy rola użytkownika do usunięcia nie jest "admin"
        if ($userNameToDelete !== $loggedInUser && $userRoleToDelete !== 'admin') {
            // Usuń rekord tylko jeśli nazwa użytkownika do usunięcia jest inna niż nazwa zalogowanego użytkownika
            // oraz rola użytkownika do usunięcia nie jest "admin"
            $deleteSql = "DELETE FROM `users` WHERE `u_id` = $id_to_delete";
            $deleteResult = mysqli_query($conn, $deleteSql);

            if ($deleteResult) {
                echo "Rekord o ID $id_to_delete został usunięty poprawnie.";

                // Po wykonaniu operacji usuwania przekieruj na stronę delete.php bez parametrów w adresie URL
                header('Location: delete.php');
                exit();
            } else {
                echo "Błąd podczas usuwania rekordu o ID $id_to_delete: " . mysqli_error($conn);
            }
        } else {
            echo "Nie możesz usunąć konta administratora lub swojego własnego konta.";
        }
    } else {
        echo "Błąd podczas sprawdzania nazwy użytkownika i roli do usunięcia: " . mysqli_error($conn);
    }
} else {
    echo "Brak prawidłowego parametru ID w adresie URL.";
}

require_once '../../auth.php';

// Wywołaj funkcję sprawdzającą rolę
checkUserRole('admin');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="data:image/x-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAABILAAASCwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA4ODh2Pz8/9j8/P/Y4ODhyAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABMTEwHNzc3YkVFRQwAAAAANjY2t4uLi/+JiYn/NjY2swAAAABDQ0MONzc3YktLSwYAAAAAAAAAAAAAAABKSkoJNzc3vFhYWP86OjrbNjY2olBQUP2ZmZn/mZmZ/09PT/w1NTWhOjo63FhYWP83Nze5S0tLCAAAAAAAAAAANzc3ZlhYWP+ZmZn/kJCQ/4GBgf+Xl5f/mZmZ/5mZmf+Wlpb/gYGB/5CQkP+ZmZn/V1dX/zg4OGIAAAAAAAAAAEVFRQw5OTnZj4+P/5mZmf+ZmZn/mZmZ/5mZmf+ZmZn/mZmZ/5mZmf+ZmZn/jo6O/zk5OdZJSUkKAAAAAAAAAAAAAAAANjY2mn5+fv+ZmZn/mZmZ/25ubv9FRUX6RUVF+m5ubv+ZmZn/mZmZ/3x8fP83NzeXAAAAAAAAAAA4ODh7NjY2uk5OTvyWlpb/mZmZ/21tbf83NzeVS0tLC0pKSgo4ODiWbm5u/5mZmf+VlZX/TU1N/DY2Nrk4ODh8Pz8/9YyMjP+ZmZn/mZmZ/5mZmf9ERET4S0tLCQAAAAAAAAAASkpKCkVFRfqZmZn/mZmZ/5mZmf+MjIz/QEBA9z8/P/WLi4v/mZmZ/5mZmf+ZmZn/RERE+FBQUAkAAAAAAAAAAElJSQtFRUX6mZmZ/5mZmf+ZmZn/i4uL/z8/P/Y4ODh0NjY2tk9PT/yWlpb/mZmZ/21tbf83NzeXTExMC05OTgs3NzeYbm5u/5mZmf+VlZX/Tk5O/DY2NrY4ODh1AAAAAAAAAAA2Njabfn5+/5mZmf+ZmZn/bm5u/0ZGRvtGRkb7bm5u/5mZmf+ZmZn/fX19/zc3N5gAAAAAAAAAAAAAAABEREQNOjo62o+Pj/+ZmZn/mZmZ/5mZmf+ZmZn/mZmZ/5mZmf+ZmZn/mZmZ/46Ojv85OTnYSUlJDAAAAAAAAAAAODg4ZVhYWP+ZmZn/j4+P/35+fv+Wlpb/mZmZ/5mZmf+Wlpb/fn5+/4+Pj/+ZmZn/V1dX/zc3N2IAAAAAAAAAAFJSUgg3Nze5V1dX/zk5Odg2NjabT09P/JmZmf+YmJj/TU1N/DY2Npo5OTnaV1dX/zc3N7ZISEgHAAAAAAAAAAAAAAAASUlJBzg4OGBHR0cMAAAAADY2NrWKior/iYmJ/zY2NrIAAAAAREREDTg4OGBNTU0GAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA3NzdxPj4+8z4+PvI4ODhuAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/D8AAMQjAACAAQAAgAEAAIABAADAAwAAAAAAAAGAAAABgAAAAAAAAMADAACAAQAAgAEAAIABAADEIwAA/D8AAA==" rel="icon" type="image/x-icon">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../style.css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="../../scripts.js"></script>
    <script>
        $(document).ready(function() {
            //Hide second child i.e second column
            
            $('.table tfoot').hide();
        });
    </script>
    <title>Audyt sprzętu</title>
</head>

<body>
    <!-------------------------------TOP---------------------------------------------->
    <div id=top>
        Użytkownicy systemu
        <a href="../show.php">
            <div id=home>
                <i id=y class="fa fa-home fa-2x"></i>
            </div>
        </a>
    </div>
    <!---------------------------MENU-BOCZNE------------------------------------------>
    <div id=menu>
        <div class=buttons id=wysun>
            <div class=info>Schowaj</div>
            <div id=gap></div>
            <div class=bar></div>
            <div class=bar></div>
            <div class=bar></div>
        </div>
        <div class=sidegap></div>
        <a href="javascript:delay('../../logout.php')">
            <div class=buttons id=logout>
                <div class=info>Wyloguj</div>
                <div id=side_button><i class="fa fa-sign-out fa-2x"></i></div>
            </div>
        </a>
    </div>
    <!-----------------------------STRONA--------------------------------------------->
    <div id=strona>
        <div id=header>Usuń użytkowników</div>
        <div id=main>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Login</th>
                        <th scope="col">Password</th>
                        <th scope="col">Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../../db_conn.php";
                    $connect = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
                    if (mysqli_connect_errno()) {
                        echo "Błąd połączenia z bazą";
                    }
                    $sql = "SELECT * FROM `users`;";
                    $result = mysqli_query($connect, $sql);
                    if ($result === FALSE) {
                        die(mysqli_error($connect));
                    }
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['u_id'] ?></td>
                            <td><?php echo $row['u_name'] ?></td>
                            <td><?php echo $row['u_password'] ?></td>
                            <td>
                                <a href="delete.php?id=<?php echo $row['u_id'] ?>">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div id=footer>
        </div>

    </div>
    <!--end of strona-->
</body>

</html>