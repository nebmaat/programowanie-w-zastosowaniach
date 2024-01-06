<?php
    session_start();
    if((isset($_SESSION['logon'])) && ($_SESSION['logon']==true))
    {
        header('Location: menu/menu.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link
        href="data:image/x-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAABILAAASCwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA4ODh2Pz8/9j8/P/Y4ODhyAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABMTEwHNzc3YkVFRQwAAAAANjY2t4uLi/+JiYn/NjY2swAAAABDQ0MONzc3YktLSwYAAAAAAAAAAAAAAABKSkoJNzc3vFhYWP86OjrbNjY2olBQUP2ZmZn/mZmZ/09PT/w1NTWhOjo63FhYWP83Nze5S0tLCAAAAAAAAAAANzc3ZlhYWP+ZmZn/kJCQ/4GBgf+Xl5f/mZmZ/5mZmf+Wlpb/gYGB/5CQkP+ZmZn/V1dX/zg4OGIAAAAAAAAAAEVFRQw5OTnZj4+P/5mZmf+ZmZn/mZmZ/5mZmf+ZmZn/mZmZ/5mZmf+ZmZn/jo6O/zk5OdZJSUkKAAAAAAAAAAAAAAAANjY2mn5+fv+ZmZn/mZmZ/25ubv9FRUX6RUVF+m5ubv+ZmZn/mZmZ/3x8fP83NzeXAAAAAAAAAAA4ODh7NjY2uk5OTvyWlpb/mZmZ/21tbf83NzeVS0tLC0pKSgo4ODiWbm5u/5mZmf+VlZX/TU1N/DY2Nrk4ODh8Pz8/9YyMjP+ZmZn/mZmZ/5mZmf9ERET4S0tLCQAAAAAAAAAASkpKCkVFRfqZmZn/mZmZ/5mZmf+MjIz/QEBA9z8/P/WLi4v/mZmZ/5mZmf+ZmZn/RERE+FBQUAkAAAAAAAAAAElJSQtFRUX6mZmZ/5mZmf+ZmZn/i4uL/z8/P/Y4ODh0NjY2tk9PT/yWlpb/mZmZ/21tbf83NzeXTExMC05OTgs3NzeYbm5u/5mZmf+VlZX/Tk5O/DY2NrY4ODh1AAAAAAAAAAA2Njabfn5+/5mZmf+ZmZn/bm5u/0ZGRvtGRkb7bm5u/5mZmf+ZmZn/fX19/zc3N5gAAAAAAAAAAAAAAABEREQNOjo62o+Pj/+ZmZn/mZmZ/5mZmf+ZmZn/mZmZ/5mZmf+ZmZn/mZmZ/46Ojv85OTnYSUlJDAAAAAAAAAAAODg4ZVhYWP+ZmZn/j4+P/35+fv+Wlpb/mZmZ/5mZmf+Wlpb/fn5+/4+Pj/+ZmZn/V1dX/zc3N2IAAAAAAAAAAFJSUgg3Nze5V1dX/zk5Odg2NjabT09P/JmZmf+YmJj/TU1N/DY2Npo5OTnaV1dX/zc3N7ZISEgHAAAAAAAAAAAAAAAASUlJBzg4OGBHR0cMAAAAADY2NrWKior/iYmJ/zY2NrIAAAAAREREDTg4OGBNTU0GAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA3NzdxPj4+8z4+PvI4ODhuAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/D8AAMQjAACAAQAAgAEAAIABAADAAwAAAAAAAAGAAAABgAAAAAAAAMADAACAAQAAgAEAAIABAADEIwAA/D8AAA=="
        rel="icon" type="image/x-icon">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="menu/style.css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        if ($(window).width() < 990) {
            var currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos) {
                document.getElementById("top").style.top = "0px";
            } else {
                document.getElementById("top").style.top = "-85px";
            }
            prevScrollpos = currentScrollPos;
        }
    }
    </script>
    <title>Audyt sprzętu</title>
</head>

<body>
    <!--TOPP-->
    <div id=top>
        Logowanie
    </div>
    <!--LOGIN-->
    <div id=login>
        <form action="menu/login.php" method="post">
            <input type="text" name="username" placeholder="Użytkownik" required>
            <input type="password" name="password" placeholder="Hasło" required>
            <input type="submit" value="Zaloguj">
        </form>
<?php
    if(isset($_SESSION['blad'])) echo $_SESSION['blad'];

?>
    </div>

    <div id="login">
    <form action="menu/register.php" method="post" onsubmit="return validateForm()">
        <input type="text" name="username" placeholder="Użytkownik" required>
        <input type="password" name="password" id="password" placeholder="Hasło" required>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Potwierdź hasło" required>
        <input type="submit" value="Zarejestruj się">
    </form>
    <div id="error_message"></div>
    <?php
        if(isset($_SESSION['registration_error'])) echo $_SESSION['registration_error'];
    ?>
</div>

<script>
    function validateForm() {
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("confirm_password").value;

        if (password !== confirm_password) {
            document.getElementById("error_message").innerHTML = "Hasła nie są identyczne.";
            return false; // Przerwij wysyłanie formularza
        } else {
            document.getElementById("error_message").innerHTML = "";
            return true; // Wysyłaj formularz
        }
    }
</script>

    <!--end of login-->
</body>

</html>