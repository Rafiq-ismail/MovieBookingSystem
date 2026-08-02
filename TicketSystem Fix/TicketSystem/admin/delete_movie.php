<?php

include '../connectdb.php';

if(isset($_GET['id'])){

    $movie_id = $_GET['id'];

    // DELETE BOOKINGS FIRST
    mysqli_query($conn, "
    DELETE bookings
    FROM bookings
    JOIN showtimes 
    ON bookings.showtime_id = showtimes.showtime_id
    WHERE showtimes.movie_id='$movie_id'
    ");

    // DELETE SHOWTIMES
    mysqli_query($conn, "
    DELETE FROM showtimes
    WHERE movie_id='$movie_id'
    ");

    // DELETE MOVIE
    mysqli_query($conn, "
    DELETE FROM movies
    WHERE movie_id='$movie_id'
    ");

    header("Location: movies.php");
    exit();

}
?>