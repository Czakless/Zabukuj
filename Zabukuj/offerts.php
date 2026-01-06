<?php
session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM hotels ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Oferty</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <div class="nav-left">
        <a href="index.php">Zabukuj.pl</a>
    </div>
    <div class="nav-right">
        <a href="deleteAccount.php">Usuń konto</a>
        <a href="logout.php">Wyloguj się</a>
    </div>
</nav>

<main class="offers">

<?php
if(mysqli_num_rows($result) == 0){
    echo "<p class='empty'>Brak ofert</p>";
}

while($h = mysqli_fetch_assoc($result)){
?>
    <div class="offer">
        <h3><?php echo $h['name']; ?></h3>
        <p class="city"><?php echo $h['city']; ?></p>
        <p class="price"><?php echo $h['price']; ?> zł / noc</p>
        <a href="reservation.php?id=<?php echo $h['id']; ?>">
            <button>Zarezerwuj</button>
        </a>
    </div>
<?php } ?>

</main>

<footer>
    <p>Strona stworzona przez Mateusza Frątczaka i Tomasza Plutę</p>
</footer>

</body>
</html>
