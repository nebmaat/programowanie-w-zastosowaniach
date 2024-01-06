<?php
require_once '../auth.php';
checkUserRole('admin', "mode");

include "../db_conn.php";
error_reporting(E_ERROR | E_PARSE);
if(isset($_POST['submit'])){
    $imie=$_POST['imie'];
    $nazwisko=$_POST['nazwisko'];

    $sql = "INSERT INTO `uzytkownicy`(`id`, `imie`, `nazwisko`, `nr_seryjny_k`, `nr_seryjny_w`, `mysz`, `klawiatura`) 
    VALUES (NULL, '$imie','$nazwisko',NULL,NULL,NULL,NULL)";

    $result = mysqli_query($conn, $sql);
    if($result){
        echo "Procedura wykonana poprawnie";
    }
    else{
        echo "Błąd:" . mysqli_error($conn);
    }
    header('Location: show.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link
        href="data:image/x-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAABILAAASCwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA4ODh2Pz8/9j8/P/Y4ODhyAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABMTEwHNzc3YkVFRQwAAAAANjY2t4uLi/+JiYn/NjY2swAAAABDQ0MONzc3YktLSwYAAAAAAAAAAAAAAABKSkoJNzc3vFhYWP86OjrbNjY2olBQUP2ZmZn/mZmZ/09PT/w1NTWhOjo63FhYWP83Nze5S0tLCAAAAAAAAAAANzc3ZlhYWP+ZmZn/kJCQ/4GBgf+Xl5f/mZmZ/5mZmf+Wlpb/gYGB/5CQkP+ZmZn/V1dX/zg4OGIAAAAAAAAAAEVFRQw5OTnZj4+P/5mZmf+ZmZn/mZmZ/5mZmf+ZmZn/mZmZ/5mZmf+ZmZn/jo6O/zk5OdZJSUkKAAAAAAAAAAAAAAAANjY2mn5+fv+ZmZn/mZmZ/25ubv9FRUX6RUVF+m5ubv+ZmZn/mZmZ/3x8fP83NzeXAAAAAAAAAAA4ODh7NjY2uk5OTvyWlpb/mZmZ/21tbf83NzeVS0tLC0pKSgo4ODiWbm5u/5mZmf+VlZX/TU1N/DY2Nrk4ODh8Pz8/9YyMjP+ZmZn/mZmZ/5mZmf9ERET4S0tLCQAAAAAAAAAASkpKCkVFRfqZmZn/mZmZ/5mZmf+MjIz/QEBA9z8/P/WLi4v/mZmZ/5mZmf+ZmZn/RERE+FBQUAkAAAAAAAAAAElJSQtFRUX6mZmZ/5mZmf+ZmZn/i4uL/z8/P/Y4ODh0NjY2tk9PT/yWlpb/mZmZ/21tbf83NzeXTExMC05OTgs3NzeYbm5u/5mZmf+VlZX/Tk5O/DY2NrY4ODh1AAAAAAAAAAA2Njabfn5+/5mZmf+ZmZn/bm5u/0ZGRvtGRkb7bm5u/5mZmf+ZmZn/fX19/zc3N5gAAAAAAAAAAAAAAABEREQNOjo62o+Pj/+ZmZn/mZmZ/5mZmf+ZmZn/mZmZ/5mZmf+ZmZn/mZmZ/46Ojv85OTnYSUlJDAAAAAAAAAAAODg4ZVhYWP+ZmZn/j4+P/35+fv+Wlpb/mZmZ/5mZmf+Wlpb/fn5+/4+Pj/+ZmZn/V1dX/zc3N2IAAAAAAAAAAFJSUgg3Nze5V1dX/zk5Odg2NjabT09P/JmZmf+YmJj/TU1N/DY2Npo5OTnaV1dX/zc3N7ZISEgHAAAAAAAAAAAAAAAASUlJBzg4OGBHR0cMAAAAADY2NrWKior/iYmJ/zY2NrIAAAAAREREDTg4OGBNTU0GAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA3NzdxPj4+8z4+PvI4ODhuAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/D8AAMQjAACAAQAAgAEAAIABAADAAwAAAAAAAAGAAAABgAAAAAAAAMADAACAAQAAgAEAAIABAADEIwAA/D8AAA=="
        rel="icon" type="image/x-icon">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../style.css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="../scripts.js"></script>
    <script>
    $(document).ready(function() {
        //Hide second child i.e second column
        $(".table td:nth-child(8)").hide();
        $(".table td:nth-child(9)").hide();
        $('.table tfoot').hide();
        $("#Edit_button").click(function() {
            $(".table td:nth-child(8)").toggle(100);
            $(".table td:nth-child(9)").toggle(100);
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
        <a href="find.php">
            <div class=buttons>
                <div class=info>Znajdź</div>
                <div id=side_button><i class="fa fa-search fa-2x"></i></div>
            </div>
        </a>

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
        <div id=header>Użytkownicy</div>
        <div id=main>
            <!---------------------TREŚĆ---------------------------->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Imię</th>
                        <th scope="col">Nazwisko</th>
                        <th scope="col">Komputer</th>
                        <th scope="col">Wyświetlacz</th>
                        <th scope="col">Mysz</th>
                        <th scope="col">Klawiatura</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../db_conn.php";
                    $connect = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
                    if (mysqli_connect_errno()) {
                        echo "Błąd połączenia z bazą";
                    }
                    $sql = "SELECT * FROM `uzytkownicy`;";
                    $result = mysqli_query($connect, $sql);
                    if ($result === FALSE) {
                        die(mysqli_error($connect));
                    }
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['imie'] ?></td>
                        <td><?php echo $row['nazwisko'] ?></td>
                        <td><?php echo $row['nr_seryjny_k'] ?></td>
                        <td><?php echo $row['nr_seryjny_w'] ?></td>
                        <td><?php echo $row['mysz'] ?></td>
                        <td><?php echo $row['klawiatura'] ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id'] ?>">
                                <i class="fa fa-pencil-square"></i>
                            </a>
                        </td>
                        <td>
                            <a href="delete.php?id=<?php echo $row['id'] ?>">
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
                            <td></td>
                            <td>
                                <input type="text" name="imie" placeholder="Imię" value="<?php echo $row['imie'] ?>">
                            </td>
                            <td>
                                <input type="text" name="nazwisko" placeholder="Nazwisko"
                                    value="<?php echo $row['nazwisko'] ?>">
                            </td>
                            <td><button type="submit" name="submit">Dodaj</button></td>
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