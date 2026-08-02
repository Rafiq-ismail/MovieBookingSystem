<?php
include 'partials/header.php';
include '../connectdb.php';
if (!isset($_GET['booking_id'])) {
    die("Booking ID missing");
}
$booking_id = intval($_GET['booking_id']);

$query = mysqli_query($conn, "
SELECT
    bookings.*,
    movies.title,
    movies.poster,
    showtimes.show_date,
    showtimes.show_time
FROM bookings
JOIN showtimes ON bookings.showtime_id = showtimes.showtime_id
JOIN movies ON showtimes.movie_id = movies.movie_id
WHERE bookings.booking_id='$booking_id'
");

$data = mysqli_fetch_assoc($query);
?>

<link rel="stylesheet" href="../style.css">

<div class="success-page">

    <div class="success-card">

        <div class="success-check">✓</div>

        <h1>Booking Confirmed</h1>

        <p class="success-message">
            Your movie tickets have been successfully booked!
        </p>

        <div class="ticket-details">

            <div class="ticket-row">
                <span>Booking ID</span>
                <strong>#<?php echo $data['booking_id']; ?></strong>
            </div>

            <div class="ticket-row">
                <span>Movie</span>
                <strong><?php echo $data['title']; ?></strong>
            </div>

            <div class="ticket-row">
                <span>Time</span>
                <strong><?php echo $data['show_time']; ?></strong>
            </div>

            <div class="ticket-row">
                <span>Seats</span>
                <strong><?php echo $data['seats']; ?></strong>
            </div>

            <div class="ticket-row total-row">
                <span>Total Payment</span>
                <strong>RM <?php echo number_format($data['total_price'], 2); ?></strong>
            </div>

        </div>

        <div class="success-actions">

            <a href="receipt.php?booking_id=<?php echo $data['booking_id']; ?>" class="btn">
                View Receipt
            </a>

            <a href="my_bookings.php" class="btn">
                My Bookings
            </a>

        </div>

    </div>

</div>

<?php include 'partials/footer.php'; ?>