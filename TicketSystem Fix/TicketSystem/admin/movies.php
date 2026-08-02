<?php
include 'partials/header.php';
include '../connectdb.php';

$query = mysqli_query($conn,
"SELECT * FROM movies");
?>

<h1>Manage Movies</h1>

<a href="add_movie.php" class="btn">
    + Add Movie
</a>

<br><br>

<div class="table-container">

<table class="admin-table">

<tr>

    <th>ID</th>
    <th>Poster</th>
    <th>Movie</th>
    <th>Genre</th>
    <th>Duration</th>
    <th>Status</th>
    <th>Actions</th>

</tr>

<?php while($row = mysqli_fetch_assoc($query)){ ?>

<tr>

    <td><?php echo $row['movie_id']; ?></td>

    <td>

        <img
        src="../uploads/<?php echo htmlentities($row['poster']); ?>"
        alt="<?php echo htmlentities($row['title']); ?>"
        class="table-poster">

    </td>

    <td><?php echo $row['title']; ?></td>

    <td><?php echo $row['genre']; ?></td>

    <td><?php echo $row['duration']; ?></td>

    <td><?php echo $row['status']; ?></td>

    <td>

        <a class="btn"
        href="edit_movie.php?id=<?php echo $row['movie_id']; ?>">
            Edit
        </a>

        <a class="btn btn-danger"
        href="delete_movie.php?id=<?php echo $movie['movie_id']; ?>" 
    onclick="return confirm('Are you sure you want to delete this movie?')"
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