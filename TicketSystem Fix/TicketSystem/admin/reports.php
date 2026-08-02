<?php
include 'partials/header.php';
include '../connectdb.php';

$totalMovies = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM movies"));
$totalBookings = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bookings"));
$totalUsers = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
$totalSalesRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_price) AS total_sales FROM bookings"));
$totalSales = $totalSalesRow['total_sales'] ? number_format($totalSalesRow['total_sales'], 2) : '0.00';

$topMovies = mysqli_query($conn,
"SELECT movies.title, COUNT(*) AS total_bookings
FROM bookings
LEFT JOIN showtimes ON bookings.showtime_id = showtimes.showtime_id
LEFT JOIN movies ON showtimes.movie_id = movies.movie_id
GROUP BY movies.movie_id
ORDER BY total_bookings DESC
LIMIT 5");
?>

<h1 class="page-title">Reports</h1>

<div class="dashboard-cards">
    <div class="card">
        <h2><?php echo $totalMovies; ?></h2>
        <p>Total Movies</p>
    </div>
    <div class="card">
        <h2><?php echo $totalBookings; ?></h2>
        <p>Total Bookings</p>
    </div>
    <div class="card">
        <h2>RM <?php echo $totalSales; ?></h2>
        <p>Total Sales</p>
    </div>
    <div class="card">
        <h2><?php echo $totalUsers; ?></h2>
        <p>Total Users</p>
    </div>
</div>

<div class="page-section">
    <h2 class="section-title">Top Movies</h2>
    <div class="table-container">
        <table class="admin-table">
            <tr>
                <th>Movie</th>
                <th>Bookings</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($topMovies)){ ?>
            <tr>
                <td><?php echo htmlspecialchars($row['title'] ?: 'Unknown'); ?></td>
                <td><?php echo intval($row['total_bookings']); ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

<?php include 'partials/footer.php'; ?>