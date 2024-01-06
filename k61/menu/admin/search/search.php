<?php
include "../../db_conn.php";

require_once '../../auth.php';
checkUserRole('admin');

// Początkowe zapytanie do wyświetlenia wszystkich rekordów
$sql = "SELECT * FROM `users`";
$result = mysqli_query($conn, $sql);

$highlightedRows = []; // Przechowuje ID zaznaczonych rekordów
if (isset($_POST['search_submit'])) {
    $search_name = mysqli_real_escape_string($conn, $_POST['search_name']);
    $searchSql = "SELECT * FROM `users` WHERE `u_name` LIKE '%$search_name%'";
    $searchResult = mysqli_query($conn, $searchSql);

    // Pobierz ID zaznaczonych rekordów
    while ($row = mysqli_fetch_assoc($searchResult)) {
        $highlightedRows[] = $row['u_id'];
    }
}

// Funkcja sprawdzająca, czy ID rekordu znajduje się w tablicy zaznaczonych rekordów
function isHighlighted($id, $highlightedRows)
{
    return in_array($id, $highlightedRows);
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
    <style>
        /* Dodaj styl dla zaznaczonych rekordów */
        .highlight {
            background-color: #FFFF99; /* Kolor tła dla zaznaczonych rekordów */
        }
    </style>
</head>

<body>
    <!-- TOP -->
    <div id="top">
        Wyszukiwanie użytkowników
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
        <div id="header">Wyszukiwanie użytkowników</div>
        <div id="main">
            <form method="post" action="">
                <label for="search_name">Login:</label>
                <input type="text" name="search_name" placeholder="Podaj login">
                <input type="submit" name="search_submit" value="Szukaj">
            </form>
            <table class="table1">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Login</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Użyj funkcji isHighlighted do sprawdzenia, czy ID rekordu znajduje się w tablicy zaznaczonych rekordów
                        $highlightClass = isHighlighted($row['u_id'], $highlightedRows) ? 'highlight' : '';
                    ?>
                        <tr class="<?php echo $highlightClass; ?>">
                            <td><?php echo $row['u_id'] ?></td>
                            <td><?php echo $row['u_name'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="footer"></div>
    </div>
</body>

</html>
