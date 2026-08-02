<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}
include '../connectdb.php';
include 'partials/header.php';

$showtime_id = $_GET['showtime_id'];

$query = mysqli_query($conn, "
SELECT movies.title, showtimes.price
FROM showtimes
JOIN movies ON showtimes.movie_id = movies.movie_id
WHERE showtimes.showtime_id='$showtime_id'
");

$movie = mysqli_fetch_assoc($query);


$takenSeats = [];

$seatQuery = mysqli_query($conn, "
SELECT seats FROM bookings
WHERE showtime_id='$showtime_id'
");

while($seatRow = mysqli_fetch_assoc($seatQuery)){

    $seatArray = explode(',', $seatRow['seats']);

    foreach($seatArray as $seat){
        $takenSeats[] = trim($seat);
    }
}
?>
<link rel="stylesheet" href="../style.css">
<div class="seat-wrapper">

    <h1 class="seat-title">
        Select Your Seats
    </h1>

    <h2 class="movie-name">
        <?php echo $movie['title']; ?>
    </h2>

    <p class="seat-price">
        RM <?php echo $movie['price']; ?> / seat
    </p>

    <div class="screen">
        SCREEN
    </div>

    <form method="POST" action="payment.php">

        <div class="seat-grid">

            <?php
            $rows = ['A', 'B', 'C', 'D', 'E'];
            $cols = range(1, 10);

            foreach($rows as $row){
                echo "<div class='seat-row'>";
                foreach($cols as $col){
                    $seatId = $row . $col;
                    $isTaken = in_array($seatId, $takenSeats);
                    $class = $isTaken ? 'taken' : 'available';
                    echo "
                    <label class='seat $class'>
                        <input type='checkbox' name='seats[]' value='$seatId' " . ($isTaken ? 'disabled' : '') . ">
                        $seatId
                    </label>
                    ";
                }
                echo "</div>";
            }
            ?>

        </div>

        <div class="seat-info">
            <div class="seat-legend">
                <div class="legend-item">
                    <div class="seat available"></div>
                    <span>Available</span>
                </div>
                <div class="legend-item">
                    <div class="seat taken"></div>
                    <span>Taken</span>
                </div>
                <div class="legend-item">
                    <div class="seat selected"></div>
                    <span>Selected</span>
                </div>
            </div>
        </div>

        <input type="hidden" name="showtime_id" value="<?php echo $showtime_id; ?>">
        <input type="hidden" name="total" id="totalPrice" value="0">

        <div class="booking-summary">
            <p>Selected Seats: <span id="selectedSeats">None</span></p>
            <p>Total Price: RM <span id="displayTotal">0.00</span></p>
        </div>

        <button type="submit" class="btn book-btn" id="bookBtn" disabled>
            Proceed to Payment
        </button>

    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[name="seats[]"]');
    const selectedSeatsSpan = document.getElementById('selectedSeats');
    const displayTotalSpan = document.getElementById('displayTotal');
    const totalPriceInput = document.getElementById('totalPrice');
    const bookBtn = document.getElementById('bookBtn');
    const pricePerSeat = <?php echo $movie['price']; ?>;

    function updateSelection() {
        const selectedSeats = [];
        let total = 0;

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selectedSeats.push(checkbox.value);
                total += pricePerSeat;
            }
        });

        selectedSeatsSpan.textContent = selectedSeats.length > 0 ? selectedSeats.join(', ') : 'None';
        displayTotalSpan.textContent = total.toFixed(2);
        totalPriceInput.value = total;

        bookBtn.disabled = selectedSeats.length === 0;
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                this.parentElement.classList.add('selected');
            } else {
                this.parentElement.classList.remove('selected');
            }
            updateSelection();
        });
    });
});
</script>
<?php include 'partials/footer.php'; ?>