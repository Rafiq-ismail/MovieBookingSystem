<?php
include '../connectdb.php';
include 'partials/header.php';

$totalMovies = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM movies"));

$totalBookings = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM bookings"));

$totalUsers = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));

$totalSalesRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_price) AS total_sales FROM bookings"));

$totalSales = $totalSalesRow['total_sales'] ? number_format($totalSalesRow['total_sales'], 2) : '0.00';

$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';
?>

<h1 class="page-title">Welcome back, <?php echo htmlspecialchars($userName); ?></h1>

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

<?php
include 'partials/footer.php';
?>