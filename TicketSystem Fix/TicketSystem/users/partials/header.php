<?php
$sidebar_enabled = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Booking System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="main-layout">
    <?php if($sidebar_enabled) include 'sidebar.php'; ?>

    <div class="main-content">