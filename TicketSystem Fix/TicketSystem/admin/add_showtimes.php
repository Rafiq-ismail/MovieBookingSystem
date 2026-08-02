<?php
include 'partials/header.php';
include '../connectdb.php';

if(isset($_POST['save'])){

    $movie_id = $_POST['movie_id'];
    $show_date = $_POST['show_date'];
    $show_time = $_POST['show_time'];
    $hall = $_POST['hall_id'];
    $price = $_POST['price'];

    mysqli_query($conn,

    "INSERT INTO showtimes
    (movie_id,show_date,show_time,hall_id,price)

    VALUES

    ('$movie_id','$show_date','$show_time','$hall','$price')");

    header("Location: showtimes.php");
}
?>

<h1>Add Showtime</h1>

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
            value="<?php echo $movie['movie_id']; ?>">

                <?php echo $movie['title']; ?>

            </option>

            <?php } ?>

        </select>

    </div>

    <div class="form-group">

        <label>Show Date</label>

        <input type="date"
        name="show_date"
        required>

    </div>

    <div class="form-group">

        <label>Show Time</label>

        <input type="time"
        name="show_time"
        required>

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
        required>

    </div>

    <button type="submit"
    name="save"
    class="btn">

        Save Showtime

    </button>

</form>

</div>

<?php
include 'partials/footer.php';
?>