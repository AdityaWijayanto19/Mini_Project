<?php 
    // Ambil nama pengguna dan role dari session

    $user_name = $_SESSION['user_name'];
    $user_role = $_SESSION['user_role']; // Role admin (1) atau user (2)
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="identitas">
                <?php  echo "<p>" . htmlspecialchars($user_name) . "</p>"; ?>
            </div>

            <!-- Link menu di tengah -->
            <div class="nav-links">
                <a href="dashboard.php">Home</a>
                <a href="profile.php">Profile</a>

                <?php
                    // Jika admin, tampilkan link untuk "Manage"
                    if ($user_role == 1) {
                        echo '<a href="manage_users.php">Manage</a>'; // Admin link
                    }
                ?>

                <a href="logout.php">Logout</a>
            </div>
        </div>
    </header>
</body>
</html>
