<?php
include 'partials/header.php';
include '../connectdb.php';

$id = $_GET['id'];

$query = mysqli_query($conn,

"SELECT * FROM showtimes
WHERE showtime_id='$id'");

$row = mysqli_fetch_assoc($query);

if (!$row) {
    header('Location: showtimes.php');
    exit;
}

if(isset($_POST['update'])){

    $movie_id = $_POST['movie_id'];
    $show_date = $_POST['show_date'];
    $show_time = $_POST['show_time'];
    $hall = $_POST['hall_id'];
    $price = $_POST['price'];

    mysqli_query($conn,

    "UPDATE showtimes SET

    movie_id='$movie_id',
    show_date='$show_date',
    show_time='$show_time',
    hall_id ='$hall',
    price='$price',

    WHERE showtime_id='$id'");

    header("Location: showtimes.php");
}
?>

<h1>Edit Showtime</h1>

<div class="table-container">

<form method="POST">

    <div class="form-group">

        <label>Select Movie</label>

        <select name="movie_id">

            <?php

            $movies = mysqli_query($conn,
            "SELECT * FROM movies");

            while($movie = mysqli_fetch_assoc($movies)){

            ?>

            <option
            value="<?php echo $movie['movie_id']; ?>"

            <?php
            if($movie['movie_id'] == $row['movie_id'])
            echo "selected";
            ?>>

                <?php echo $movie['title']; ?>

            </option>

            <?php } ?>

        </select>

    </div>

    <div class="form-group">

        <label>Show Date</label>

        <input type="date"
        name="show_date"
        value="<?php echo $row['show_date']; ?>">

    </div>

    <div class="form-group">

        <label>Show Time</label>

        <input type="time"
        name="show_time"
        value="<?php echo $row['show_time']; ?>">

    </div>

    <div class="form-group">

        <label>Hall</label>

<select name="hall_id" required>

    <option value="">Select Hall</option>

    <?php

    $hallQuery = mysqli_query($conn, "
    SELECT * FROM halls
    ");

    while($hall = mysqli_fetch_assoc($hallQuery)){
    ?>

        <option value="<?php echo $hall['hall_id']; ?>">

            <?php echo $hall['hall_name']; ?>

        </option>

    <?php } ?>

</select>

    </div>

    <div class="form-group">

        <label>Ticket Price</label>

        <input type="number"
        step="0.01"
        name="price"
        value="<?php echo $row['price']; ?>">

    </div>

    <button type="submit"
    name="update"
    class="btn">

        Update Showtime

    </button>

</form>

</div>

<?php
include 'partials/footer.php';
?>