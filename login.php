<?php
session_start(); // Mulai session di bagian atas

// Menyertakan koneksi ke database
include 'database/db.php'; 

// Cek jika pengguna sudah login (jika session 'user_email' ada)
if (isset($_SESSION['user_email'])) {
    header("Location: dashboard.php"); // Jika sudah login, arahkan ke halaman dashboard
    exit(); // Hentikan eksekusi lebih lanjut
}

// Cek jika form login disubmit (dengan metode POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : ''; // Ambil email dari form
    $password = isset($_POST['password']) ? $_POST['password'] : ''; // Ambil password dari form

    // Mengambil data pengguna dari database berdasarkan email
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email); // Mengikat parameter email untuk query
    $stmt->execute(); // Menjalankan query
    $result = $stmt->get_result(); // Mendapatkan hasil query

    // Inisialisasi variabel $user
$user = null;

    // Jika email ditemukan di database
    if ($result->num_rows > 0) {
        // Ambil data pengguna dari database
        $user = $result->fetch_assoc(); // Mengambil data pengguna dari hasil query
    }

    // Cek jika user ditemukan dan password yang dimasukkan cocok dengan password hash di database
    if ($user && password_verify($password, $user['password'])) { 
        // Simpan data pengguna ke session
        $_SESSION['user_id'] = $user['id']; // Simpan ID pengguna ke session
        $_SESSION['user_email'] = $email; // Simpan email pengguna ke session
        $_SESSION['user_name'] = $user['name']; // Simpan nama pengguna ke session
        $_SESSION['user_role'] = $user['role']; // Simpan role pengguna ke session

        // Arahkan ke dashboard sesuai role
        if ($_SESSION['user_role'] == 1) {
            header("Location: dashboard.php"); // Jika admin, arahkan ke dashboard admin
        } else {
            header("Location: dashboard.php"); // Jika user, arahkan ke dashboard user
        }
        exit(); // Hentikan eksekusi lebih lanjut
    } else {
        $error_message = "Email atau password salah!"; // Tampilkan pesan error jika password atau email salah
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
            <form action="login.php" method="POST" class="form">
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
