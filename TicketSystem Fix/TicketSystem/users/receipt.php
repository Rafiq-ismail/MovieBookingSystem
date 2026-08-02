<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

include '../connectdb.php';
include 'partials/header.php';

if (!isset($_GET['booking_id'])) {
    die("Booking ID missing");
}

$booking_id = intval($_GET['booking_id']);
$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn, "
SELECT 
    bookings.*, 
    movies.title,
    movies.poster,
    showtimes.show_date,
    showtimes.show_time,
    halls.hall_name
FROM bookings
JOIN showtimes ON bookings.showtime_id = showtimes.showtime_id
JOIN movies ON showtimes.movie_id = movies.movie_id
JOIN halls ON showtimes.hall_id = halls.hall_id
WHERE bookings.booking_id='$booking_id'
AND bookings.user_id='$user_id'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    die('Booking not found');
}

$dateNow = date("d M Y");
$timeNow = date("h:i A");
?>

<link rel="stylesheet" href="../style.css">

<div class="dashboard-container">


    <div class="main-content">

        <div class="receipt-page">

            <div class="receipt-card">

                <div class="receipt-top">
                    <h1>CINEMA RECEIPT</h1>
                    <p>Thank you for your booking</p>
                </div>

                <div class="receipt-poster">
                    <img 
                        src="../poster/<?php echo $data['poster']; ?>" 
                        alt="Movie Poster"
                    >
                </div>

                <div class="receipt-movie">
                    <?php echo $data['title']; ?>
                </div>

                <div class="receipt-info">

                    <div class="receipt-row">
                        <span>Booking ID</span>
                        <strong>
                            #<?php echo $data['booking_id']; ?>
                        </strong>
                    </div>

                    <div class="receipt-row">
                        <span>Hall</span>
                        <strong>
                            <?php echo $data['hall_name']; ?>
                        </strong>
                    </div>

                    <div class="receipt-row">
                        <span>Date</span>
                        <strong>
                            <?php echo $data['show_date']; ?>
                        </strong>
                    </div>

                    <div class="receipt-row">
                        <span>Time</span>
                        <strong>
                            <?php echo $data['show_time']; ?>
                        </strong>
                    </div>

                    <div class="receipt-row">
                        <span>Seats</span>
                        <strong>
                            <?php echo $data['seats']; ?>
                        </strong>
                    </div>

                    <div class="receipt-row total-row">
                        <span>Total Payment</span>
                        <strong>
                            RM <?php echo number_format($data['total_price'], 2); ?>
                        </strong>
                    </div>

                </div>

                <div class="receipt-footer">

                    <p>Transaction Date</p>

                    <strong>
                        <?php echo $dateNow; ?> | <?php echo $timeNow; ?>
                    </strong>

                </div>

                <div class="receipt-buttons">

                    <button 
                        onclick="window.print()" 
                        class="print-btn"
                    >
                        Print Receipt
                    </button>

                    <a 
                        href="my_bookings.php" 
                        class="back-btn"
                    >
                        Back to My Bookings
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include 'partials/footer.php'; ?>