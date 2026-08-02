<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: ../index.php");
    exit();
}

if($_SESSION['role'] == 'admin'){
    header("Location: ../admin.php");
    exit();
}

$user_id = $_SESSION['user_id'];

include '../connectdb.php';
include 'partials/header.php';

$query = mysqli_query($conn, "SELECT * FROM users WHERE user_id='$user_id'");
$user = mysqli_fetch_assoc($query);
?>

<link rel="stylesheet" href="../style.css">
<div class="profile-wrapper">

    <div class="profile-card">

        <div class="profile-avatar">
            👤
        </div>

        <h2><?php echo $user['full_name']; ?></h2>
        <p class="role-badge"><?php echo $user['role']; ?></p>

        <div class="profile-info">
            <p><span>Username:</span> <?php echo $user['username']; ?></p>
            <p><span>Email:</span> <?php echo $user['email']; ?></p>
        </div>

        <a href="movies.php" class="btn">Back to Movies</a>

    </div>

</div>

<?php include 'partials/footer.php'; ?>