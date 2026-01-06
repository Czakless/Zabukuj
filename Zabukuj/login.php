<?php
session_start();
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($role == "klient") {
        $table = "users";
    } else {
        $table = "companies";
    }

    $query = "SELECT * FROM $table WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($password == $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $role;

            if ($role == "klient") {
                header("Location: offerts.php");
            } else {
                header("Location: panel.php");
            }
            exit;

        } else {
            $message = "Nieprawidłowe hasło!";
        }

    } else {
        $message = "Nie znaleziono użytkownika!";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <div class="nav-left">
        <a href="index.php">Zabukuj.pl</a>
    </div>
</nav>

<div class="rezerwacja">
    <h2>Logowanie</h2>

    <?php if($message) echo "<p class='success'>$message</p>"; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Hasło" required>
        <select name="role">
            <option value="klient">Klient</option>
            <option value="firma">Firma</option>
        </select>
        <button type="submit">Zaloguj się</button>
    </form>

    <p>Nie masz konta? <a href="register.php">Zarejestruj się</a></p>
</div>

<footer>
    <p>Strona stworzona przez Mateusza Frątczaka i Tomasza Plutę</p>
</footer>

</body>
</html>