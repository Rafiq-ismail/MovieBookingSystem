<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

include '../connectdb.php';
include 'partials/header.php';

/*
GET SEARCH VALUES
*/
$search = isset($_GET['search']) ? $_GET['search'] : '';
$genre = isset($_GET['genre']) ? $_GET['genre'] : '';
$time_category = isset($_GET['time']) ? $_GET['time'] : '';

/*
MAIN QUERY
*/
$query = "
SELECT DISTINCT movies.*
FROM movies
LEFT JOIN showtimes
ON movies.movie_id = showtimes.movie_id
WHERE movies.status='active'
";

/*
SEARCH BY TITLE
*/
if($search != ''){
    $query .= "
    AND movies.title LIKE '%$search%'
    ";
}

/*
FILTER BY GENRE
*/
if($genre != ''){
    $query .= "
    AND movies.genre='$genre'
    ";
}

/*
FILTER BY SHOWTIME CATEGORY
*/
if($time_category == 'morning'){
    $query .= "
    AND TIME(showtimes.show_time) < '12:00:00'
    ";
}

if($time_category == 'afternoon'){
    $query .= "
    AND TIME(showtimes.show_time) >= '12:00:00'
    AND TIME(showtimes.show_time) < '17:00:00'
    ";
}

if($time_category == 'evening'){
    $query .= "
    AND TIME(showtimes.show_time) >= '17:00:00'
    AND TIME(showtimes.show_time) < '20:00:00'
    ";
}

if($time_category == 'night'){
    $query .= "
    AND TIME(showtimes.show_time) >= '20:00:00'
    ";
}

/*
SORT MOVIES
*/
$query .= "
ORDER BY movies.movie_id ASC
";

$movies = mysqli_query($conn, $query);
?>

<link rel="stylesheet" href="../style.css">

<div class="container">

    <h1 class="section-title">
        Available Movies
    </h1>

    <!-- SEARCH & FILTER FORM -->
    <form method="GET" class="search-form">

        <input 
            type="text"
            name="search"
            placeholder="Search movie..."
            value="<?php echo $search; ?>"
            class="search-input"
        >

        <select name="genre" class="search-select">

            <option value="">
                All Genres
            </option>

            <option value="Action" 
            <?php if($genre == 'Action') echo 'selected'; ?>>
                Action
            </option>

            <option value="Horror"
            <?php if($genre == 'Horror') echo 'selected'; ?>>
                Horror
            </option>

            <option value="Comedy"
            <?php if($genre == 'Comedy') echo 'selected'; ?>>
                Comedy
            </option>

            <option value="Sci-Fi"
            <?php if($genre == 'Sci-Fi') echo 'selected'; ?>>
                Sci-Fi
            </option>

            <option value="Animation"
            <?php if($genre == 'Animation') echo 'selected'; ?>>
                Animation
            </option>

        </select>

        <select name="time" class="search-select">

            <option value="">
                All Showtime
            </option>

            <option value="morning"
            <?php if($time_category == 'morning') echo 'selected'; ?>>
                Morning
            </option>

            <option value="afternoon"
            <?php if($time_category == 'afternoon') echo 'selected'; ?>>
                Afternoon
            </option>

            <option value="evening"
            <?php if($time_category == 'evening') echo 'selected'; ?>>
                Evening
            </option>

            <option value="night"
            <?php if($time_category == 'night') echo 'selected'; ?>>
                Night
            </option>

        </select>

        <button type="submit" class="btn">
            Search
        </button>

    </form>

    <div class="movie-grid">

        <?php
        if(mysqli_num_rows($movies) > 0){

            while($row = mysqli_fetch_assoc($movies)){
        ?>

        <div class="movie-card">

            <img 
                src="../poster/<?php echo $row['poster']; ?>" 
                class="movie-poster"
                alt="<?php echo $row['title']; ?>"
            >

            <div class="movie-content">

                <h3>
                    <?php echo $row['title']; ?>
                </h3>

                <p>
                    <strong>Genre:</strong>
                    <?php echo $row['genre']; ?>
                </p>

                <p>
                    <strong>Language:</strong>
                    <?php echo $row['language']; ?>
                </p>

                <a 
                    href="movie_details.php?id=<?php echo $row['movie_id']; ?>" 
                    class="btn"
                >
                    Book Now
                </a>

            </div>

        </div>

        <?php
            }

        } else {
        ?>

        <p>No movies found.</p>

        <?php } ?>

    </div>

</div>

<?php include 'partials/footer.php'; ?>