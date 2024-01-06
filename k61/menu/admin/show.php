<?
require_once '../auth.php';
checkUserRole('admin');
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
            $(".table td:nth-child(7)").hide();
            $(".table td:nth-child(8)").hide();
            $('.table tfoot').hide();
            $("#Edit_button").click(function() {
                $(".table td:nth-child(7)").toggle(100);
                $(".table td:nth-child(8)").toggle(100);
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

        <a href="javascript:delay('../logout.php')">
            <div class=buttons id=logout>
                <div class=info>Wyloguj</div>
                <div id=side_button><i class="fa fa-sign-out fa-2x"></i></div>
            </div>
        </a>
    </div>
    <!-----------------------------STRONA--------------------------------------------->
    <div id=strona>
        <div id=header style="background-color: #0B6FA4">Panel administratora</div>
        <a href="/menu/admin/add/add.php">
            <div class=choice id=a style="background-color: #0B6FA4">
                <i class="fa fa-address-book fa-5x"></i>
                <p>Dodaj nowych użytkowników</p>
            </div>
        </a>
        <a href="/menu/admin/edit/edit.php">
            <div class=choice id=a style="background-color: #0B6FA4">
                <i class="fa fa-address-book fa-5x"></i>
                <p>Edytuj role użytkowników</p>
            </div>
        </a>
        <a href="/menu/admin/delete/delete.php">
            <div class=choice id=b style="background-color: #0B6FA4">
                <i class="fa fa-trash-o fa-5x"></i>
                <p>Usuń użytkowników</p>
            </div>
        </a>
        <a href="/menu/admin/search/search.php">
            <div class=choice id=c style="background-color: #0B6FA4">
                <i class="fa fa-refresh fa-5x"></i>
                <p>Wyszukaj użytkownika</p>
            </div>
        </a>
        <a href="../menu.php">
            <div class=choice id=c style="background-color: green">
                <i class="fa fa-user fa-5x"></i>
                <p>Panel użytkownika</p>
            </div>
        </a>
    </div>
    <div id=footer>
        <!--------------------STOPKA--------------------------->
    </div>

    </div>
    <!--end of strona-->
</body>

</html>