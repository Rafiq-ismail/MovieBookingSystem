<?php
include 'connectdb.php';

if(isset($_POST['register'])){

    $name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    mysqli_query($conn, "INSERT INTO users(full_name, username, email, password)
    VALUES('$name', '$username', '$email', '$password')");


    echo "<script>
        alert('Registration Successful');
        window.location.href='index.php';
    </script>";
}
?>

<?php include 'header.php'; ?>

<div class="form-box">

    <h2>Create Account</h2>

    <form method="POST">

        <div class="input-group">
            <label>Full Name</label>
            <input type="text" name="full_name" required>
        </div>

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" name="register" class="btn" style="width:100%; border:none;">
            Register
        </button>

    </form>

</div>