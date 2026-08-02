<?php
session_start();
include '../connectdb.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

include 'partials/header.php';

$user_id = intval($_SESSION['user_id']);

$query = mysqli_query($conn, "
SELECT bookings.*, movies.title
FROM bookings
JOIN showtimes ON bookings.showtime_id = showtimes.showtime_id
JOIN movies ON showtimes.movie_id = movies.movie_id
WHERE bookings.user_id='$user_id'
ORDER BY bookings.booking_id DESC
");
?>

<link rel="stylesheet" href="../style.css">
<h1 class="page-title">My Bookings</h1>

<table class="bookings-table">

<tr>
    <th>ID</th>
    <th>Movie</th>
    <th>Seats</th>
    <th>Total</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($query)){ ?>

<tr>
    <td><?php echo $row['booking_id']; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td><?php echo $row['seats']; ?></td>
    <td>RM <?php echo $row['total_price']; ?></td>
    <td><?php echo $row['booking_status']; ?></td>

    <td>
        <a href="receipt.php?booking_id=<?php echo $row['booking_id']; ?>">
    View Ticket
</a>
    </td>
</tr>

<?php } ?>

</table>

<?php include 'partials/footer.php'; ?>