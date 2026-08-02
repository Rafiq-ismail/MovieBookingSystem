<?php
session_start();
include 'connectdb.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn,

    "SELECT * FROM users
    WHERE username='$username'
    AND password='$password'");

    if(mysqli_num_rows($query) > 0){

        $row = mysqli_fetch_assoc($query);

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        // ADMIN
        if($row['role'] == 'admin'){

            header("Location: admin/dashboard.php");
            exit();

        }

        // USER
        else{

            header("Location: users/dashboard.php");
            exit();

        }

    }

    else{

        echo "Invalid username or password";

    }

}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="form-box">

    <h2>Login to MovieBook</h2>

    <form method="POST">

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Enter username" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password" required>
        </div>

        <button type="submit" name="login" class="btn" style="width:100%; border:none;">
            Login
        </button>

    </form>

    <a href="register.php" class="btn" style="width:100%; margin-top:15px; text-align:center; display:block; color:white;">
        Register
    </a>

    <a href="guest/index.php" class="btn" style="width:100%; margin-top:15px; text-align:center; display:block; color:white;">
        Continue as Guest
    </a>

</div>

</body>
</html>