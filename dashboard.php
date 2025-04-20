<?php
session_start(); // Mulai session

// Cek apakah pengguna sudah login dan role yang benar
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Jika belum login, arahkan ke login
    exit();
}

// Ambil nama pengguna dan role dari session
$user_name = $_SESSION['user_name'];
$user_role = $_SESSION['user_role']; // Role admin (1) atau user (2)
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
    <div class="container">
        <?php
        // Cek role pengguna dan tampilkan pesan selamat datang yang berbeda
        if ($user_role == 1) {
            // Jika admin, tampilkan pesan dan fitur admin
            echo "<p>Hai, Admin " . $user_name . "!</p>";
            echo "<p>Ini adalah halaman dashboard untuk Admin.</p>";
            // Fitur khusus untuk admin (misalnya, akses ke fitur admin)
            echo "<p><a href='manage_users.php'>Kelola Pengguna</a></p>";
            echo "<p><a href='view_reports.php'>Lihat Laporan</a></p>";
        } else {
            // Jika user biasa, tampilkan pesan dan fitur untuk user biasa
            echo "<p>Hai, User " . $user_name . "!</p>";
            echo "<p>Ini adalah halaman dashboard untuk User biasa.</p>";
            // Fitur terbatas untuk user biasa
            echo "<p><a href='view_profile.php'>Lihat Profil</a></p>";
            echo "<p><a href='edit_profile.php'>Edit Profil</a></p>";
        }
        ?>
    </div>
    <a href="logout.php">Logout</a>
</body>
</html>
