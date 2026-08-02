<?php
include 'partials/header.php';
include '../connectdb.php';

$query = mysqli_query($conn,

"SELECT 

bookings.*,

users.full_name AS user_name,
users.username,

movies.title AS movie_title,

showtimes.show_date,
showtimes.show_time,

halls.hall_name

FROM bookings

LEFT JOIN users 
ON bookings.user_id = users.user_id

LEFT JOIN showtimes 
ON bookings.showtime_id = showtimes.showtime_id

LEFT JOIN movies 
ON showtimes.movie_id = movies.movie_id

LEFT JOIN halls
ON showtimes.hall_id = halls.hall_id

ORDER BY bookings.booking_id DESC

");

?>

<h1 class="page-title">Manage Bookings</h1>

<div class="table-container">

<table class="admin-table">

<tr>
    <th>ID</th>
    <th>User</th>
    <th>Movie</th>
    <th>Date</th>
    <th>Time</th>
    <th>Hall</th>
    <th>Seats</th>
    <th>Total</th>
    <th>Status</th>
</tr>

<?php while($row = mysqli_fetch_assoc($query)){ ?>

<tr>
    <td><?php echo $row['booking_id']; ?></td>
    <td><?php echo htmlspecialchars($row['user_name'] ?: $row['username'] ?: 'Unknown'); ?></td>
    <td><?php echo htmlspecialchars($row['movie_title'] ?: 'Unknown'); ?></td>
    <td><?php echo htmlspecialchars($row['show_date'] ?: '-'); ?></td>
    <td><?php echo htmlspecialchars($row['show_time'] ?: '-'); ?></td>
    <td><?php echo htmlspecialchars($row['hall_name'] ?: '-'); ?></td>
    <td><?php echo htmlspecialchars($row['seats']); ?></td>
    <td>RM <?php echo number_format($row['total_price'], 2); ?></td>
    <td><?php echo htmlspecialchars($row['booking_status']); ?></td>
</tr>

<?php } ?>

</table>

</div>

<?php include 'partials/footer.php'; ?>