<?php
require_once '../auth.php';
checkUserRole('admin', "mode");

include "../db_conn.php";
error_reporting(E_ERROR | E_PARSE);
if (isset($_POST['submit'])) {
    #------DANE Z FORMULARZA---------#
    $id_u = $_POST['id_u'];
    $mysz = $_POST['mysz'];
    $klawiatura = $_POST['klawiatura'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    #------------------------------#
    $sql_u_name = "SELECT imie FROM `uzytkownicy` WHERE id=$id_u;";
    $sql_u_surname = "SELECT nazwisko FROM `uzytkownicy` WHERE id=$id_u;";
    #------------------------------#
    $zapytanie_u_name = mysqli_query($conn, $sql_u_name);
    $zapytanie_u_surname = mysqli_query($conn, $sql_u_surname);
    #------------------------------#
    while ($row = mysqli_fetch_assoc($zapytanie_u_name)) {
        $u_name=$row['imie'];
    }
    while ($row = mysqli_fetch_assoc($zapytanie_u_surname)) {
        $u_surname=$row['nazwisko'];
    }
    #------------------------------#
    $sql = "INSERT INTO `peryferia`(`imie`, `nazwisko`, `mysz`, `klawiatura`, `id_u`) 
    VALUES ('$u_name','$u_surname','$mysz','$klawiatura', '$id_u')";
    $u_sql = "UPDATE `uzytkownicy` SET `mysz`='$mysz',`klawiatura`='$klawiatura' WHERE id=$id_u";
    #------------------------------#
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Procedura wykonana poprawnie";
    } else {
        echo "Błąd:" . mysqli_error($conn);
    }
    #------------------------------#
    $result2 = mysqli_query($conn, $u_sql);
    if ($result2) {
        echo "Procedura wykonana poprawnie";
    } else {
        echo "Błąd:" . mysqli_error($conn);
    }
    header('Location: show.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="data:image/x-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAABILAAASCwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA4ODh2Pz8/9j8/P/Y4ODhyAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABMTEwHNzc3YkVFRQwAAAAANjY2t4uLi/+JiYn/NjY2swAAAABDQ0MONzc3YktLSwYAAAAAAAAAAAAAAABKSkoJNzc3vFhYWP86OjrbNjY2olBQUP2ZmZn/mZmZ/09PT/w1NTWhOjo63FhYWP83Nze5S0tLCAAAAAAAAAAANzc3ZlhYWP+ZmZn/kJCQ/4GBgf+Xl5f/mZmZ/5mZmf+Wlpb/gYGB/5CQkP+ZmZn/V1dX/zg4OGIAAAAAAAAAAEVFRQw5OTnZj4+P/5mZmf+ZmZn/mZmZ/5mZmf+ZmZn/mZmZ/5mZmf+ZmZn/jo6O/zk5OdZJSUkKAAAAAAAAAAAAAAAANjY2mn5+fv+ZmZn/mZmZ/25ubv9FRUX6RUVF+m5ubv+ZmZn/mZmZ/3x8fP83NzeXAAAAAAAAAAA4ODh7NjY2uk5OTvyWlpb/mZmZ/21tbf83NzeVS0tLC0pKSgo4ODiWbm5u/5mZmf+VlZX/TU1N/DY2Nrk4ODh8Pz8/9YyMjP+ZmZn/mZmZ/5mZmf9ERET4S0tLCQAAAAAAAAAASkpKCkVFRfqZmZn/mZmZ/5mZmf+MjIz/QEBA9z8/P/WLi4v/mZmZ/5mZmf+ZmZn/RERE+FBQUAkAAAAAAAAAAElJSQtFRUX6mZmZ/5mZmf+ZmZn/i4uL/z8/P/Y4ODh0NjY2tk9PT/yWlpb/mZmZ/21tbf83NzeXTExMC05OTgs3NzeYbm5u/5mZmf+VlZX/Tk5O/DY2NrY4ODh1AAAAAAAAAAA2Njabfn5+/5mZmf+ZmZn/bm5u/0ZGRvtGRkb7bm5u/5mZmf+ZmZn/fX19/zc3N5gAAAAAAAAAAAAAAABEREQNOjo62o+Pj/+ZmZn/mZmZ/5mZmf+ZmZn/mZmZ/5mZmf+ZmZn/mZmZ/46Ojv85OTnYSUlJDAAAAAAAAAAAODg4ZVhYWP+ZmZn/j4+P/35+fv+Wlpb/mZmZ/5mZmf+Wlpb/fn5+/4+Pj/+ZmZn/V1dX/zc3N2IAAAAAAAAAAFJSUgg3Nze5V1dX/zk5Odg2NjabT09P/JmZmf+YmJj/TU1N/DY2Npo5OTnaV1dX/zc3N7ZISEgHAAAAAAAAAAAAAAAASUlJBzg4OGBHR0cMAAAAADY2NrWKior/iYmJ/zY2NrIAAAAAREREDTg4OGBNTU0GAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA3NzdxPj4+8z4+PvI4ODhuAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/D8AAMQjAACAAQAAgAEAAIABAADAAwAAAAAAAAGAAAABgAAAAAAAAMADAACAAQAAgAEAAIABAADEIwAA/D8AAA==" rel="icon" type="image/x-icon">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style.css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="../scripts.js"></script>
    <script>
        $(document).ready(function() {
            //Hide second child i.e second column
            $(".table td:nth-child(6)").hide();
            $(".table td:nth-child(7)").hide();
            $('.table tfoot').hide();
            $("#Edit_button").click(function() {
                $(".table td:nth-child(6)").toggle(100);
                $(".table td:nth-child(7)").toggle(100);
            });
            $("#Add_button").click(function() {
                $('.table tfoot').toggle(200);
            });
        });
    </script>
    <title>Audyt sprzętu</title>
</head>

<body>
    <!-------------------------------TOP---------------------------------------------->
    <div id=top>
        Audyt sprzętu
        <a href="../menu.php">
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
        <div class=buttons id=Edit_button>
            <div class=info>Edytuj</div>
            <div id=side_button><i class="fa fa-pencil-square fa-2x"></i></div>
        </div>

        <div class=buttons id=Add_button>
            <div class=info>Dodaj</div>
            <div id=side_button><i class="fa fa-plus-square fa-2x"></i></div>
        </div>
        <div class=sidegap></div>
        <a href="javascript:delay('../logout.php')">
            <div class=buttons id=logout>
                <div class=info>Wyloguj</div>
                <div id=side_button><i class="fa fa-sign-out fa-2x"></i></div>
            </div>
        </a>
    </div>
    <!-----------------------------STRONA--------------------------------------------->
    <div id=strona>
        <div id=header>Peryferia</div>
        <div id=main>
            <!---------------------TREŚĆ---------------------------->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID użytkownika</th>
                        <th scope="col">Imię</th>
                        <th scope="col">Nazwisko</th>
                        <th scope="col">Mysz</th>
                        <th scope="col">Klawiatura</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../db_conn.php";
                    $connect = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
                    mysqli_set_charset($connect, "utf8");
                    if (mysqli_connect_errno()) {
                        echo "Błąd połączenia z bazą";
                    }
                    $sql = "SELECT * FROM `peryferia`;";
                    $result = mysqli_query($connect, $sql);
                    if ($result === FALSE) {
                        die(mysqli_error($connect));
                    }
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['id_u'] ?></td>
                            <td><?php echo $row['imie'] ?></td>
                            <td><?php echo $row['nazwisko'] ?></td>
                            <td><?php echo $row['mysz'] ?></td>
                            <td><?php echo $row['klawiatura'] ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id'] ?>&id_u=<?php echo $row['id_u'] ?>">
                                    <i class="fa fa-pencil-square"></i>

                                </a>
                            </td>
                            <td>
                                <a href="delete.php?id=<?php echo $row['id'] ?>&id_u=<?php echo $row['id_u'] ?>">
                                    <i class="fa fa-trash"></i>

                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <form method="POST">
                    <tfoot>
                        <tr>
                            <td>
                                <input type="text" name="id_u" placeholder="ID użytkownika" value="<?php echo $row['id_u'] ?>" required>
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="text" name="mysz" placeholder="Mysz" value="<?php echo $row['mysz'] ?>" required>
                            </td>
                            <td>
                                <input type="text" name="klawiatura" placeholder="Klawiatura" value="<?php echo $row['klawiatura'] ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-color: #f2f2f2; background-color: #f2f2f2;"><button type="submit" name="submit">Dodaj</button></td>
                        </tr>
                    </tfoot>
                </form>
            </table>
        </div>
        <div id=footer>
            <!--------------------STOPKA--------------------------->
        </div>

    </div>
    <!--end of strona-->
</body>

</html>