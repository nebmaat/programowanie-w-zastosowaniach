<?php
session_start();

# Sprawdzamy, czy przesłano login i hasło
if(!isset($_POST['username']) || !isset($_POST['password'])) {
    header('Location: ../index.php');
    exit();
}

# Łączymy się z bazą danych
require_once "db_conn.php";
$connect = @new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

# Sprawdzamy, czy udało się połączyć z bazą danych
if($connect->connect_errno != 0) {
    die("Error: " . $connect->connect_errno);
}

# Pobieramy login i hasło z formularza
$login = $_POST['username'];
$password = $_POST['password'];

# Zabezpieczamy dane przed SQL Injection i XSS
$login = $connect->real_escape_string(htmlspecialchars($login, ENT_QUOTES, "UTF-8"));

# Haszujemy hasło przed porównaniem z bazą danych
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

# Pobieramy użytkownika z bazy danych
$query = "SELECT * FROM users WHERE u_name='$login'";
$result = $connect->query($query);

if(!$result) {
    die("Query failed: " . $connect->error);
}

# Sprawdzamy, czy użytkownik istnieje
if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    # Porównujemy zahashowane hasła
    if(password_verify($password, $row['u_password'])) {
        $_SESSION['logon'] = true;
        $_SESSION['login'] = $login;
        $_SESSION['user'] = $row['u_name'];
        unset($_SESSION['blad']);
        $result->close();
        require_once 'auth.php';
        redirectToRolePage();
    } else {
        # Niepoprawne hasło
        $_SESSION['blad'] = '<span style="color:red">Wrong username or password!</span>'; 
        header('Location: ../index.php');
    }
} else {
    # Użytkownik nie istnieje
    $_SESSION['blad'] = '<span style="color:red">Wrong username or password!</span>'; 
    header('Location: ../index.php');
}

$connect->close();
?>
