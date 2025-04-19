<?php
session_start(); // MEMULAI SESSION UNTUK MENJALANKAN SESSION PADA HALAMAN INI
include 'database/db.php'; // MENYERTAKAN KONEKSI KE DATABASE

// CEK JIKA PENGGUNA SUDAH LOGIN (JIKA SESSION 'user_id' ADA)
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php"); // JIKA SUDAH LOGIN, ARRAHKAN KE HALAMAN DASHBOARD
    exit(); // EXIT UNTUK MENGHENTIKAN PROSES PHP LANJUTAN
}

// CEK JIKA FORM LOGIN DISUBMIT (DENGAN METODE POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = isset($_POST['email']) ? $_POST['email'] : ''; // AMBIL EMAIL DARI FORM
        $password = isset($_POST['password']) ? $_POST['password'] : ''; // AMBIL PASSWORD DARI FORM

        // MENGAMBIL DATA PENGGUNA DARI DATABASE BERDASARKAN EMAIL
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email); // MENGIKAT PARAMETER EMAIL UNTUK QUERY
        $stmt->execute(); // MENJALANKAN QUERY
        $result = $stmt->get_result(); // MENDAPATKAN HASIL QUERY

        // JIKA EMAIL DITEMUKAN DI DATABASE
        if ($result->num_rows > 0) {
            // AMBIL DATA PENGGUNA DARI DATABASE
            $user = $result->fetch_assoc(); // MENGAMBIL DATA PENGGUNA DARI HASIL QUERY
        }

    // CEK JIKA USER DITEMUKAN DAN PASSWORD YANG DIMASUKKAN COOK DENGAN PASSWORD HASH DI DATABASE
    if ($user && password_verify($password, $user['password'])) { 
        $_SESSION['user_email'] = $email; // SIMPAN EMAIL PENGGUNA KE SESSION
        $_SESSION['user_name'] = $user['name']; // SIMPAN NAMA PENGGUNA KE SESSION
        header("Location: dashboard.php"); // REDIRECT KE HALAMAN DASHBOARD
    } else {
        $error = "email atau password salah!"; // TAMPILKAN PESAN ERROR JIKA PASSWORD ATAU EMAIL SALAH
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="container">
        <div class="containerForm">
            <form action="index.php" method="POST" class="form">
                <!-- icon login -->
                <div class="iconLogin">
                    <i class="fa-solid fa-users"></i>
                </div>
    
                <!-- input Email -->
                <div class="email">
                    <div class="iconUser">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <input type="email" name="email" placeholder="Email Pengguna" required>
                </div>
    
                <!-- input kata sandi -->
                <div class="password">
                    <div class="iconPass">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" id="password" name="password" placeholder="Kata Sandi" required>
                    <span class="showHide"> 
                        <i id="toggleIcon" class="fa-solid fa-eye"></i>
                    </span>
                </div>
    
                <!-- Tampilkan pesan error jika login gagal -->
                <?php if (isset($error_message)): ?>
                    <div class="error-message">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <!-- button masuk -->
                <button type="submit">Masuk</button>
            </form>

            <div style="display: flex; align-items: center; width: 280px; text-align: center;">
                <hr style="flex-grow: 1; height: 1px; background-color: #000; border: none;">
                <span style="padding: 0 10px; font-weight: 500;">ATAU</span>
                <hr style="flex-grow: 1; height: 1px; background-color: #000; border: none;">
            </div>

            <!-- Tombol login dengan Google (ini hanya tombol, belum ada fungsionalitas) -->
            <div class="btnGoogle">
                <button type="submit"> <i class="fa-brands fa-google"></i> Masuk</button>
            </div>
        </div>

        <div class="containerRegist">
            <p>Belum punya akun? <a href="register.php">Buat akun</a></p>
        </div>
    </div>

    <script src="js/hide.js"></script>
</body>
</html>
