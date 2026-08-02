<?php
session_start();

if (!isset($_SESSION['user_id'])) {

    header('Location: ../index.php');
    exit;

}

include '../connectdb.php';

/*
CHECK FORM DATA
*/
if(
    !isset($_POST['showtime_id']) ||
    !isset($_POST['seats']) ||
    !isset($_POST['total_price'])
){
    die("Invalid Access");
}

/*
GET FORM DATA
*/
$user_id = $_SESSION['user_id'];

$showtime_id = intval($_POST['showtime_id']);

$seats = $_POST['seats'];

$total_price = $_POST['total_price'];

/*
INSERT BOOKING
*/
mysqli_query($conn, "
INSERT INTO bookings
(
    user_id,
    showtime_id,
    seats,
    total_price,
    booking_status
)
VALUES
(
    '$user_id',
    '$showtime_id',
    '$seats',
    '$total_price',
    'PAID'
)
");

/*
GET NEW BOOKING ID
*/
$booking_id = mysqli_insert_id($conn);

/*
REDIRECT TO SUCCESS PAGE
*/
header("Location: booking-success.php?booking_id=$booking_id");

exit;
?>