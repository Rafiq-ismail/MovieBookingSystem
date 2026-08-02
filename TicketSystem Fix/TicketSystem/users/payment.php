<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

include '../connectdb.php';
include 'partials/header.php';

/*
CHECK ACCESS
*/
if (!isset($_POST['showtime_id']) || !isset($_POST['seats'])) {
    die("Invalid Access");
}

/*
GET USER DATA
*/
$user_id = $_SESSION['user_id'];
$showtime_id = intval($_POST['showtime_id']);
$selectedSeats = $_POST['seats'];

/*
CONVERT SEATS TO ARRAY
IF NEEDED
*/
if (!is_array($selectedSeats)) {

    $selectedSeats = explode(',', $selectedSeats);

}

/*
GET SHOWTIME + MOVIE DETAILS
INCLUDING movie_id
*/
$query = mysqli_query($conn, "
SELECT
    movies.movie_id,
    movies.title,
    movies.poster,

    showtimes.price,
    showtimes.show_date,
    showtimes.show_time,

    halls.hall_name

FROM showtimes

JOIN movies
ON showtimes.movie_id = movies.movie_id

JOIN halls
ON showtimes.hall_id = halls.hall_id

WHERE showtimes.showtime_id='$showtime_id'
");

$data = mysqli_fetch_assoc($query);

/*
STORE movie_id
*/
$movie_id = $data['movie_id'];

/*
CALCULATE PRICE
*/
$seatCount = count($selectedSeats);

$pricePerSeat = $data['price'];

$totalPrice = $seatCount * $pricePerSeat;

/*
CONVERT ARRAY TO STRING
*/
$seats = implode(',', $selectedSeats);
?>

<link rel="stylesheet" href="../style.css">

<div class="payment-container">

    <h1 class="payment-title">
        Payment Summary
    </h1>

    <div class="payment-card">

        <div class="payment-poster">

            <img 
                src="../poster/<?php echo $data['poster']; ?>" 
                class="payment-poster"
                alt="<?php echo $data['title']; ?>"
            >

        </div>

        <div class="payment-details">

            <h2>
                <?php echo $data['title']; ?>
            </h2>

            <div class="ticket-row">

                <span>Movie ID</span>

                <strong>
                    <?php echo $movie_id; ?>
                </strong>

            </div>

            <div class="ticket-row">

                <span>Show Date</span>

                <strong>
                    <?php echo date('M d, Y', strtotime($data['show_date'])); ?>
                </strong>

            </div>

            <div class="ticket-row">

                <span>Show Time</span>

                <strong>
                    <?php echo date('h:i A', strtotime($data['show_time'])); ?>
                </strong>

            </div>

            <div class="ticket-row">

                <span>Hall</span>

                <strong>
                    <?php echo $data['hall_name']; ?>
                </strong>

            </div>

            <div class="ticket-row">

                <span>Seats Selected</span>

                <strong>
                    <?php echo implode(', ', $selectedSeats); ?>
                </strong>

            </div>

            <div class="ticket-row">

                <span>Price per Seat</span>

                <strong>
                    RM <?php echo number_format($pricePerSeat, 2); ?>
                </strong>

            </div>

            <div class="ticket-row">

                <span>Number of Seats</span>

                <strong>
                    <?php echo $seatCount; ?>
                </strong>

            </div>

            <div class="ticket-row total-row">

                <span>Total Payment</span>

                <strong>
                    RM <?php echo number_format($totalPrice, 2); ?>
                </strong>

            </div>

        </div>

    </div>

    <form method="POST" action="process_payment.php">

        <!-- IMPORTANT -->
        <!-- PASS movie_id -->
        <input 
            type="hidden" 
            name="movie_id" 
            value="<?php echo $movie_id; ?>"
        >

        <input 
            type="hidden" 
            name="showtime_id" 
            value="<?php echo $showtime_id; ?>"
        >

        <input 
            type="hidden" 
            name="seats" 
            value="<?php echo $seats; ?>"
        >

        <input 
            type="hidden" 
            name="total_price" 
            value="<?php echo $totalPrice; ?>"
        >

        <button type="submit" class="pay-btn">

            Pay Now

        </button>

    </form>

</div>

<?php include 'partials/footer.php'; ?>