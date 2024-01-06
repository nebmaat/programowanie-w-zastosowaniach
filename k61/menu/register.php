<?php
// Importuj plik z połączeniem do bazy danych
require_once 'db_conn.php';

// Inicjalizuj sesję
session_start();

// Funkcja do sprawdzania poprawności danych
function validateUsername($username) {

    // Sprawdź, czy użytkownik o danej nazwie już istnieje
    global $conn; // Używamy globalnego połączenia do bazy danych
    $stmt = $conn->prepare("SELECT u_name FROM users WHERE u_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Użytkownik o danej nazwie już istnieje
        $_SESSION['registration_error'] = "Użytkownik o podanej nazwie już istnieje.";
        header("Location: ../index.php");
        exit();
    }

    $stmt->close();
}

// Sprawdź, czy formularz został wysłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobierz dane z formularza
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Wywołaj funkcję do walidacji danych
    validateUsername($username);

    // Jeśli walidacja przeszła pomyślnie, dodaj użytkownika do bazy danych
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Haszowanie hasła

    $sql = "INSERT INTO users (u_name, u_password, u_role) VALUES (?, ?, ?)";
    $role = "user";
    // Używamy prepared statements
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $hashed_password, $role);
    
    if ($stmt->execute()) {
        // Użytkownik został pomyślnie dodany
        $_SESSION['registration_success'] = "Rejestracja udana. Możesz się teraz zalogować.";
        header("Location: ../index.php");
        exit();
    } else {
        // Błąd podczas dodawania użytkownika
        $_SESSION['registration_error'] = "Błąd rejestracji. Spróbuj ponownie.";
        header("Location: ../index.php");
        exit();
    }
    
    $stmt->close(); // Zamknij prepared statement
} else {
    // Przekieruj, jeśli formularz nie został wysłany
    header("Location: ../index.php");
    exit();
}
?>
