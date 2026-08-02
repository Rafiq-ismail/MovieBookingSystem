<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

include '../connectdb.php';
include 'partials/header.php';

$id = $_GET['id'];

/*
GET MOVIE DETAILS
*/
$query = mysqli_query($conn, "
SELECT * FROM movies
WHERE movie_id='$id'
");

$movie = mysqli_fetch_assoc($query);

if (!$movie) {

    echo "Movie not found.";

    include 'partials/footer.php';

    exit;
}

/*
GET MINIMUM PRICE
*/
$priceQuery = mysqli_query($conn, "
SELECT MIN(price) AS min_price
FROM showtimes
WHERE movie_id='$id'
");

$priceData = mysqli_fetch_assoc($priceQuery);

/*
GET ALL SHOWTIMES
*/
$showtimeQuery = mysqli_query($conn, "
SELECT * FROM showtimes
WHERE movie_id='$id'
ORDER BY show_date ASC, show_time ASC
");

/*
SHOWTIME CATEGORIES
*/
$morning = [];
$afternoon = [];
$evening = [];
$night = [];

/*
SORT SHOWTIMES INTO CATEGORY
*/
while($showtime = mysqli_fetch_assoc($showtimeQuery)){

    $hour = date('H', strtotime($showtime['show_time']));

    if($hour < 12){

        $morning[] = $showtime;

    } elseif($hour >= 12 && $hour < 17){

        $afternoon[] = $showtime;

    } elseif($hour >= 17 && $hour < 20){

        $evening[] = $showtime;

    } else {

        $night[] = $showtime;

    }
}
?>

<link rel="stylesheet" href="../style.css">

<div class="container">

    <div class="movie-details">

        <img 
            src="../poster/<?php echo $movie['poster']; ?>" 
            class="movie-poster" 
            alt="<?php echo $movie['title']; ?>"
        >

        <div class="movie-info">

            <h1>
                <?php echo $movie['title']; ?>
            </h1>

            <br>

            <p>
                <strong>Genre:</strong>
                <?php echo $movie['genre']; ?>
            </p>

            <p>
                <strong>Duration:</strong>
                <?php echo $movie['duration']; ?> mins
            </p>

            <p>
                <strong>Language:</strong>
                <?php echo $movie['language']; ?>
            </p>

            <p class="movie-price">

                <strong>Ticket Price:</strong>

                RM <?php echo number_format($priceData['min_price'], 2); ?>

            </p>

            <br>

            <p>
                <?php echo $movie['description']; ?>
            </p>

        </div>

    </div>

    <!-- MORNING -->
    <?php if(count($morning) > 0){ ?>

    <h2 class="section-title">
        Morning Showtimes
    </h2>

    <div class="showtimes-grid">

        <?php foreach($morning as $showtime){ ?>

        <div class="showtime-card">

            <h3>
                <?php echo date('M d, Y', strtotime($showtime['show_date'])); ?>
            </h3>

            <p>
                <strong>Time:</strong>
                <?php echo date('h:i A', strtotime($showtime['show_time'])); ?>
            </p>

            <p>
                <strong>Price:</strong>
                RM <?php echo number_format($showtime['price'], 2); ?>
            </p>

            <a 
                href="seat_selection.php?showtime_id=<?php echo $showtime['showtime_id']; ?>" 
                class="btn"
            >
                Select Seats
            </a>

        </div>

        <?php } ?>

    </div>

    <?php } ?>

    <!-- AFTERNOON -->
    <?php if(count($afternoon) > 0){ ?>

    <h2 class="section-title">
        Afternoon Showtimes
    </h2>

    <div class="showtimes-grid">

        <?php foreach($afternoon as $showtime){ ?>

        <div class="showtime-card">

            <h3>
                <?php echo date('M d, Y', strtotime($showtime['show_date'])); ?>
            </h3>

            <p>
                <strong>Time:</strong>
                <?php echo date('h:i A', strtotime($showtime['show_time'])); ?>
            </p>

            <p>
                <strong>Price:</strong>
                RM <?php echo number_format($showtime['price'], 2); ?>
            </p>

            <a 
                href="seat_selection.php?showtime_id=<?php echo $showtime['showtime_id']; ?>" 
                class="btn"
            >
                Select Seats
            </a>

        </div>

        <?php } ?>

    </div>

    <?php } ?>

    <!-- EVENING -->
    <?php if(count($evening) > 0){ ?>

    <h2 class="section-title">
        Evening Showtimes
    </h2>

    <div class="showtimes-grid">

        <?php foreach($evening as $showtime){ ?>

        <div class="showtime-card">

            <h3>
                <?php echo date('M d, Y', strtotime($showtime['show_date'])); ?>
            </h3>

            <p>
                <strong>Time:</strong>
                <?php echo date('h:i A', strtotime($showtime['show_time'])); ?>
            </p>

            <p>
                <strong>Price:</strong>
                RM <?php echo number_format($showtime['price'], 2); ?>
            </p>

            <a 
                href="seat_selection.php?showtime_id=<?php echo $showtime['showtime_id']; ?>" 
                class="btn"
            >
                Select Seats
            </a>

        </div>

        <?php } ?>

    </div>

    <?php } ?>

    <!-- NIGHT -->
    <?php if(count($night) > 0){ ?>

    <h2 class="section-title">
        Night Showtimes
    </h2>

    <div class="showtimes-grid">

        <?php foreach($night as $showtime){ ?>

        <div class="showtime-card">

            <h3>
                <?php echo date('M d, Y', strtotime($showtime['show_date'])); ?>
            </h3>

            <p>
                <strong>Time:</strong>
                <?php echo date('h:i A', strtotime($showtime['show_time'])); ?>
            </p>

            <p>
                <strong>Price:</strong>
                RM <?php echo number_format($showtime['price'], 2); ?>
            </p>

            <a 
                href="seat_selection.php?showtime_id=<?php echo $showtime['showtime_id']; ?>" 
                class="btn"
            >
                Select Seats
            </a>

        </div>

        <?php } ?>

    </div>

    <?php } ?>

    <?php
    if(
        count($morning) == 0 &&
        count($afternoon) == 0 &&
        count($evening) == 0 &&
        count($night) == 0
    ){
    ?>

    <p>No showtimes available for this movie.</p>

    <?php } ?>

</div>

<?php include 'partials/footer.php'; ?>