<?php
session_start();
include "db.php";

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if($role == "klient"){

    $user_query = mysqli_query($conn, "SELECT email FROM users WHERE id=$user_id");
    $user = mysqli_fetch_assoc($user_query);
    $email = $user['email'];

    mysqli_query($conn,
        "DELETE FROM reservations WHERE email='$email'"
    );

    mysqli_query($conn,
        "DELETE FROM users WHERE id=$user_id"
    );

}else{

    mysqli_query($conn,
        "DELETE FROM hotels WHERE company_id=$user_id"
    );

    mysqli_query($conn,
        "DELETE FROM companies WHERE id=$user_id"
    );
}

session_destroy();
header("Location: index.php");
exit;
?>
