<?php
include 'partials/header.php';
include '../connectdb.php';

$id = $_GET['id'];

$query = mysqli_query($conn,
"SELECT * FROM movies
WHERE movie_id='$id'");

$row = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){

    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $duration = $_POST['duration'];
    $language = $_POST['language'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    mysqli_query($conn,

    "UPDATE movies SET

    title='$title',
    genre='$genre',
    duration='$duration',
    language='$language',
    description='$description',
    status='$status'

    WHERE movie_id='$id'");

    header("Location: movies.php");
}
?>

<h1>Edit Movie</h1>

<div class="table-container">

<form method="POST">

    <div class="form-group">

        <label>Movie Name</label>

        <input type="text"
        name="title"
        value="<?php echo $row['title']; ?>">

    </div>

    <div class="form-group">

        <label>Genre</label>

        <input type="text"
        name="genre"
        value="<?php echo $row['genre']; ?>">

    </div>

    <div class="form-group">

        <label>Duration</label>

        <input type="text"
        name="duration"
        value="<?php echo $row['duration']; ?>">

    </div>

    <div class="form-group">

        <label>Language</label>

        <input type="text"
        name="language"
        value="<?php echo $row['language']; ?>">

    </div>

    <div class="form-group">

        <label>Description</label>

        <textarea
        name="description"><?php echo $row['description']; ?></textarea>

    </div>

    <div class="form-group">

        <label>Status</label>

        <select name="status">

            <option <?php if($row['status']=="Active") echo "selected"; ?>>
                Active
            </option>

            <option <?php if($row['status']=="Inactive") echo "selected"; ?>>
                Inactive
            </option>

        </select>

    </div>

    <button type="submit"
    name="update"
    class="btn">
        Update Movie
    </button>

</form>

</div>

<?php
include 'partials/footer.php';
?>