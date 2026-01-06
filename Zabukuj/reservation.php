<?php
session_start();
include "db.php";

$id = (int)$_GET['id'];
$message = "";

$hotel = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM hotels WHERE id=$id")
);

$user = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT email FROM users WHERE id=".$_SESSION['user_id'])
);
$email = $user['email'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $from = $_POST['from'];
    $to = $_POST['to'];

    if($from > $to){
        $message = "Zła data";
    } else {

        $busy = mysqli_query($conn,
            "SELECT id FROM reservations
             WHERE hotel_id=$id
             AND NOT (date_to <= '$from' OR date_from >= '$to')"
        );

        if(mysqli_num_rows($busy) > 0){
            $message = "Termin zajęty";
        } else {
            mysqli_query($conn,
                "INSERT INTO reservations (hotel_id, name, email, date_from, date_to)
                 VALUES ($id, '$name', '$email', '$from', '$to')"
            );
            $message = "Zarezerwowano";
        }
    }
}

$dates = mysqli_query($conn,
    "SELECT date_from, date_to FROM reservations WHERE hotel_id=$id"
);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<title>Rezerwacja</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="offerts.php">⬅ Powrót</a>
</nav>

<div class="panel">

    <div class="hotel">
        <div class="info">
            <h2><?php echo $hotel['name']; ?></h2>
            <p class="city"><?php echo $hotel['city']; ?></p>
            <p class="price"><?php echo $hotel['price']; ?> zł / noc</p>
        </div>
    </div>

    <h3>Zajęte terminy</h3>
    <div class="dates">
        <?php
        if(mysqli_num_rows($dates) == 0){
            echo "<p>Brak rezerwacji</p>";
        } else {
            while($d = mysqli_fetch_assoc($dates)){
                echo "<p>".$d['date_from']." → ".$d['date_to']."</p>";
            }
        }
        ?>
    </div>

    <h3>Zarezerwuj</h3>

    <?php
    if($message) echo "<p class='success'>$message</p>";
    ?>

    <form method="POST" class="reservation-form">
        <input type="text" name="name" placeholder="Imię i nazwisko" required>
        <input type="email" value="<?php echo $email; ?>" readonly>
        <input type="date" name="from" required>
        <input type="date" name="to" required>
        <button type="submit">Zarezerwuj</button>
    </form>

</div>

<footer>
    <p>Strona stworzona przez Mateusza Frątczaka i Tomasza Plutę</p>
</footer>

</body>
</html>
