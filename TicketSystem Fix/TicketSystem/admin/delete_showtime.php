<?php
include '../connectdb.php';

$id = $_GET['id'];

mysqli_query($conn,

"DELETE FROM showtimes
WHERE showtime_id='$id'");

header("Location: showtimes.php");
?>