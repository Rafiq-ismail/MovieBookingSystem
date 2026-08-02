<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}
include '../connectdb.php';
include 'partials/header.php';
?>
<link rel="stylesheet" href="../style.css">
<section class="hero">
    <h1>BOOK YOUR MOVIE TICKETS</h1>
    <p>Fast • Secure • Modern Cinema Experience</p>

    <a href="movies.php" class="btn">Explore Movies</a>
</section>

<div class="container">
    <h2 class="section-title">Now Showing</h2>

    <div class="movie-grid">
        <?php
        $query = mysqli_query($conn, "SELECT * FROM movies WHERE status='active'");

        while($movie = mysqli_fetch_assoc($query)){
        ?>
        <div class="movie-card">
<img 
    src="../poster/<?php echo $movie['poster']; ?>" 
    class="movie-poster"
>

            <div class="movie-content">
                <h3><?php echo $movie['title']; ?></h3>
                <p><?php echo $movie['genre']; ?></p>
                <p><?php echo $movie['duration']; ?> mins</p>

                <a href="movie_details.php?id=<?php echo $movie['movie_id']; ?>" class="btn">
                    View Details
                </a>
            </div>
        </div>
                <?php } ?>

    </div>
</div>

<?php include 'partials/footer.php'; ?>