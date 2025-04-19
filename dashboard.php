<?php
    session_start(); // Mulai session

    // Jika belum login, arahkan kembali ke halaman login
    if (!isset($_SESSION['user_email'])) {
        header("Location: login.php"); // Ganti dengan halaman login
        exit;
    }

    // Ambil data user dari session
    $user_name = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="dashboard">
        <h1>Welcome, <?php echo $user_name; ?>!</h1>
        <p>Selamat datang di dashboard pengguna!</p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
