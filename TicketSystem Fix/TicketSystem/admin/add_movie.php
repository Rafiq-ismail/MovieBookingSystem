<?php
include 'partials/header.php';
include '../connectdb.php';

if(isset($_POST['save'])){

    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $duration = $_POST['duration'];
    $language = $_POST['language'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $poster = $_FILES['poster']['name'];

    move_uploaded_file(
        $_FILES['poster']['tmp_name'],
        "../uploads/".$poster
    );

    mysqli_query($conn,

    "INSERT INTO movies
    (title,genre,duration,language,description,poster,status)

    VALUES

    ('$title','$genre','$duration','$language','$description','$poster','$status')");

    header("Location: movies.php");
}
?>

<h1>Add Movie</h1>

<div class="table-container">

<form method="POST" enctype="multipart/form-data">

    <div class="form-group">

        <label>Movie Name</label>

        <input type="text"
        name="title"
        required>

    </div>

    <div class="form-group">

        <label>Genre</label>

        <input type="text"
        name="genre"
        required>

    </div>

    <div class="form-group">

        <label>Duration</label>

        <input type="text"
        name="duration"
        placeholder="2h 30m"
        required>

    </div>

    <div class="form-group">

        <label>Language</label>

        <input type="text"
        name="language"
        required>

    </div>

    <div class="form-group">

        <label>Description</label>

        <textarea
        name="description"></textarea>

    </div>

    <div class="form-group">

        <label>Poster</label>

        <input type="file"
        name="poster"
        required>

    </div>

    <div class="form-group">

        <label>Status</label>

        <select name="status">

            <option>Active</option>
            <option>Inactive</option>

        </select>

    </div>

    <button type="submit"
    name="save"
    class="btn">
        Save Movie
    </button>

</form>

</div>

<?php
include 'partials/footer.php';
?>