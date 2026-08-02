<?php
include 'partials/header.php';
include '../connectdb.php';

$query = mysqli_query($conn, "SELECT * FROM users ORDER BY user_id DESC");
?>

<h1 class="page-title">Manage Users</h1>

<div class="table-container">

<table class="admin-table">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Username</th>
    <th>Email</th>
    <th>Role</th>
</tr>

<?php while($row = mysqli_fetch_assoc($query)){ ?>

<tr>
    <td><?php echo $row['user_id']; ?></td>
    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
    <td><?php echo htmlspecialchars($row['username']); ?></td>
    <td><?php echo htmlspecialchars($row['email']); ?></td>
    <td><?php echo htmlspecialchars($row['role']); ?></td>
</tr>

<?php } ?>

</table>

</div>

<?php include 'partials/footer.php'; ?>