<?php
include 'partials/header.php';
include '../connectdb.php';
$query = mysqli_query($conn, "

SELECT 

    showtimes.*,
    movies.title,
    halls.hall_name

FROM showtimes

JOIN movies
ON showtimes.movie_id = movies.movie_id

LEFT JOIN halls
ON showtimes.hall_id = halls.hall_id

ORDER BY show_date DESC

");
?>

<h1>Manage Showtimes</h1>

<a href="add_showtimes.php" class="btn">
    + Add Showtime
</a>

<br><br>

<div class="table-container">

<table class="admin-table">

<tr>

    <th>ID</th>
    <th>Movie</th>
    <th>Date</th>
    <th>Time</th>
    <th>Hall</th>
    <th>Price</th>
    <th>Total Seats</th>
    <th>Actions</th>

</tr>

<?php while($row = mysqli_fetch_assoc($query)){ ?>

<tr>

    <td><?php echo $row['showtime_id']; ?></td>

    <td><?php echo $row['title']; ?></td>

    <td><?php echo $row['show_date']; ?></td>

    <td><?php echo $row['show_time']; ?></td>

    <td><?php echo isset($row['hall_name']) ? $row['hall_name'] : 'N/A'; ?></td>

    <td>RM <?php echo $row['price']; ?></td>

    <td><?php echo $row['total_seats']; ?></td>

    <td>

        <a class="btn"
        href="edit_showtime.php?id=<?php echo $row['showtime_id']; ?>">
            Edit
        </a>

        <a class="btn btn-danger"
        href="delete_showtime.php?id=<?php echo $row['showtime_id']; ?>"
    onclick="return confirm('Are you sure you want to delete this showtime?')"
    class="delete-btn"
>
    Delete
</a>

    </td>

</tr>

<?php } ?>

</table>

</div>

<?php
include 'partials/footer.php';
?>