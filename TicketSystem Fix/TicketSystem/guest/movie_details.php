<?php
include '../connectdb.php';

/*
GET MOVIE ID
*/
$id = isset($_GET['id']) ? $_GET['id'] : null;

/*
CHECK MOVIE ID
*/
if (!$id) {

    echo '
    <link rel="stylesheet" href="../style.css">

    <div class="container">
        <p>Movie not found.</p>
    </div>
    ';

    exit;
}

/*
GET MOVIE DETAILS
*/
$query = mysqli_query($conn, "
SELECT * FROM movies
WHERE movie_id='$id'
");

$movie = mysqli_fetch_assoc($query);

/*
CHECK MOVIE EXISTS
*/
if (!$movie) {

    echo '
    <link rel="stylesheet" href="../style.css">

    <div class="container">
        <p>Movie not found.</p>
    </div>
    ';

    exit;
}

/*
GET SHOWTIMES
*/
$showtimeQuery = mysqli_query($conn, "
SELECT * FROM showtimes
WHERE movie_id='$id'
ORDER BY show_date ASC, show_time ASC
");

/*
GET MINIMUM PRICE
*/
$priceQuery = mysqli_query($conn, "
SELECT MIN(price) AS min_price
FROM showtimes
WHERE movie_id='$id'
");

$priceData = mysqli_fetch_assoc($priceQuery);
?>

<link rel="stylesheet" href="../style.css">

<div class="guest-topbar guest-topbar--movie">

    <a href="../index.php" class="btn">
        Login
    </a>

</div>

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

            <!-- NEW PRICE DISPLAY -->
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

    <h2 class="section-title">
        Available Showtimes
    </h2>

    <div class="showtimes-grid">

        <?php
        if(mysqli_num_rows($showtimeQuery) > 0){

            while($showtime = mysqli_fetch_assoc($showtimeQuery)){
        ?>

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

            <a href="../index.php" class="btn">
                Login to Book
            </a>

        </div>

        <?php
            }

        } else {
        ?>

        <p>No showtimes available for this movie.</p>

        <?php } ?>

    </div>

</div>