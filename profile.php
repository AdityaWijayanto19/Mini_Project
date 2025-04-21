<?php
session_start(); // Mulai session

// Ambil nama pengguna dan role dari session
$user_name = $_SESSION['user_name'];
$user_role = $_SESSION['user_role']; // Role admin (1) atau user (2)
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="layout/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
</head>
<body>
    <?php include "layout/header.php";?>
    <h2>Profile</h2>

    <!-- Menampilkan Foto Profil atau Ikon Default -->   
        <i class="fas fa-user-circle profile-icon"></i>

    <div class = namaUser>
        <?php
            echo "<p>" . htmlspecialchars($user_name) . "</p>";
        ?>
    </div>

    <form id="postForm" method="POST" enctype="multipart/form-data">
        <div class="file-button-container">
            <label class="custom-file-label">
                <i class="fas fa-upload"></i> Upload Gambar
                <input type="file" name="image" class="file-input" accept="image/*" id="fileInput" required>
            </label>
            <span class="file-name" id="fileName">Tidak ada file</span>
        </div>
        <div class = "buttonChangeProfile">
            <button type="submit">Change Profile Picture</button>
        </div>
    </form>
</body>
</html>
