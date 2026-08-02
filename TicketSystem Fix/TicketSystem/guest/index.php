<?php
include '../connectdb.php';

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
SEARCH BY MOVIE TITLE
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

<section class="hero">

    <h1>
        ENJOY MOVIES ANY TIME, ANYWHERE
    </h1>

    <p>
        See what movies are showing now. Login to book tickets.
    </p>

    <a href="../index.php" class="btn">
        Login
    </a>

</section>

<div class="container">

    <h2 class="section-title">
        Now Showing
    </h2>

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

            while($movie = mysqli_fetch_assoc($movies)){
        ?>

        <div class="movie-card">

            <img 
                src="../poster/<?php echo $movie['poster']; ?>" 
                class="movie-poster"
                alt="<?php echo $movie['title']; ?>"
            >

            <div class="movie-content">

                <h3>
                    <?php echo $movie['title']; ?>
                </h3>

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

                <a 
                    href="movie_details.php?id=<?php echo $movie['movie_id']; ?>" 
                    class="btn"
                >
                    View Details
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