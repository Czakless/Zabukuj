<?php
session_start();
include "db.php";
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zabukuj</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <div class="nav-left">
        <a href="index.php">Zabukuj.pl</a>
    </div>
    <div class="nav-right">
        <a href="offerts.php">Oferty</a>
        <?php
        if(isset($_SESSION['user_id'])) {
            echo '<a href="deleteAccount.php">Usuń konto</a>';
            echo '<a href="logout.php">Wyloguj się</a>';
        } else {
            echo '<a href="login.php">Zaloguj się</a>';
        }
        ?>
    </div>
</nav>

<section class="hero">
    <div class="hero-content">
        <h1 style="margin-bottom:20px;">Znajdź idealne miejsce na wypoczynek</h1>
        <a href="offerts.php" class="hero-button">Sprawdź oferty</a>
    </div>
</section>

<main class="offers">

<?php
$sql = "SELECT * FROM hotels ORDER BY id DESC LIMIT 3";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
?>
    <div class="offer">
        <h3><?php echo $row['name']; ?></h3>
        <p class="city"><?php echo $row['city']; ?></p>
        <p class="price"><?php echo $row['price']; ?> zł / noc</p>
        <a href="login.php?id=<?php echo $row['id']; ?>">
            <button>Sprawdź</button>
        </a>
    </div>
<?php } ?>

</main>

<footer>
    <p>Strona stworzona przez Mateusza Frątczaka i Tomasza Plutę</p>
</footer>

</body>
</html>
