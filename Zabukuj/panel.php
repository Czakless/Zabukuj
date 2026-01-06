<?php
session_start();
include "db.php";

$company_id = $_SESSION['user_id'];
$message = "";

if(isset($_GET['delete'])){
    $delete_id = (int)$_GET['delete'];

    mysqli_query($conn, "DELETE FROM reservations WHERE hotel_id=$delete_id");

    mysqli_query($conn, "DELETE FROM hotels WHERE id=$delete_id AND company_id=$company_id");
        $message = "Hotel i jego rezerwacje zostały usunięte!";
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $city = $_POST['city'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "INSERT INTO hotels (company_id, name, city, price, description)
            VALUES ($company_id, '$name', '$city', $price, '$description')";

    if(mysqli_query($conn, $sql)){
        $message = "Hotel został dodany!";
    } else {
        $message = "Błąd dodawania hotelu!";
    }
}

$result_hotels = mysqli_query($conn, "SELECT * FROM hotels WHERE company_id=$company_id");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Panel firmy</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <div class="nav-left"><a href="panel.php">Panel firmy</a></div>
    <div class="nav-right">
        <a href="deleteAccount.php">Usuń konto</a>
        <a href="logout.php">Wyloguj się</a>
    </div>
</nav>

<div class="panel">
    <h2>Panel firmy</h2>

    <?php if($message) echo "<p class='success'>$message</p>"; ?>

    <h3>Dodaj hotel</h3>
    <form method="POST">
        <input type="text" name="name" placeholder="Nazwa hotelu" required>
        <input type="text" name="city" placeholder="Miasto" required>
        <input type="number" name="price" placeholder="Cena za noc" required>
        <input type="text" name="description" placeholder="Opis hotelu" required>
        <button type="submit">Dodaj hotel</button>
    </form>

    <h3>Twoje hotele</h3>
    <?php while($h = mysqli_fetch_assoc($result_hotels)) { ?>
        <div class="hotel">
            <div class="info">
                <h4><?php echo $h['name']; ?></h4>
                <p><?php echo $h['description']; ?></p>
                <p><?php echo $h['city']; ?></p>
                <p><?php echo $h['price']; ?> zł / noc</p>

                <a href="?delete=<?php echo $h['id']; ?>" class="delete">Usuń hotel i rezerwacje</a>
            </div>
        </div>
    <?php } ?>
</div>

<footer>
    <p>Strona stworzona przez Mateusza Frątczaka i Tomasza Plutę</p>
</footer>

</body>
</html>
