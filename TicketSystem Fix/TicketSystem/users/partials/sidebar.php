<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="sidebar">
    <div class="logo">BookTicket</div>

    <ul>

        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){ ?>

            <li><a href="admin.php">Admin Dashboard</a></li>
            <li><a href="admin/movies.php">Manage Movies</a></li>
            <li><a href="admin/showtimes.php">Manage Showtimes</a></li>
            <li><a href="admin/bookings.php">View Bookings</a></li>
            <li><a href="admin/reports.php">Reports</a></li>
            <li><a href="admin/users.php">Manage Users</a></li>

        <?php } else { ?>

            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="movies.php">Movies</a></li>
            <li><a href="my_bookings.php">My Bookings</a></li>
            <li><a href="profile.php">Profile</a></li>

        <?php } ?>

        <li><a href="../logout.php">Logout</a></li>

    </ul>
</div>