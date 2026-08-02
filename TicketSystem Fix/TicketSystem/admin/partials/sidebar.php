<div class="sidebar">

    <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
    <h2 class="logo">MovieBook Admin</h2>

    <ul>

        <li>
            <a href="dashboard.php" class="<?php echo $currentPage === 'dashboard.php' ? 'active' : ''; ?>">Dashboard</a>
        </li>

        <li>
            <a href="movies.php" class="<?php echo $currentPage === 'movies.php' ? 'active' : ''; ?>">Movies</a>
        </li>

        <li>
            <a href="showtimes.php" class="<?php echo $currentPage === 'showtimes.php' ? 'active' : ''; ?>">Showtimes</a>
        </li>

        <li>
            <a href="bookings.php" class="<?php echo $currentPage === 'bookings.php' ? 'active' : ''; ?>">Bookings</a>
        </li>

        <li>
            <a href="reports.php" class="<?php echo $currentPage === 'reports.php' ? 'active' : ''; ?>">Reports</a>
        </li>

        <li>
            <a href="users.php" class="<?php echo $currentPage === 'users.php' ? 'active' : ''; ?>">Users</a>
        </li>

        <li>
            <a href="../logout.php">Logout</a>
        </li>

    </ul>

</div>