<?php 
    // MEMASUKKAN FILE KONEKSI KE DATABASE
    include ('database/db.php');

    // AMBIL EMAIL PENGGUNA YANG SUDAH LOGIN (Contoh, email statis untuk testing)
    $email = 'user@example.com'; 

    // SUBMIT DENGAN METODE POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // AMBIL DATA DARI FORM ATAU REQUEST USER
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // VALIDASI INPUT
        if (empty($name) || empty($email) || empty($password)) {
            die("Semua kolom harus diisi!");
        }

        // PASSWORD ENKRIPSI
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Cek apakah email sudah terdaftar
        $stmt_check_email = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt_check_email->bind_param("s", $email);
        $stmt_check_email->execute();
        $result = $stmt_check_email->get_result();

        // JIKA EMAIL SUDAH ADA MENAMPILKAN PESAN KESALAHAN
        if ($result->num_rows > 0) {
            die("Email sudah terdaftar. Silakan gunakan email yang lain.");
        }

        // MENAMBAHKAN DATA FORM KEDALAM TABEL USER DI DATABASE 'mini_project'
        $stmt = $conn->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        // CEK JIKA QUERY BERHASIL
        if ($stmt->execute()) {
            // Menyimpan status untuk menampilkan notifikasi SweetAlert
            $success = true;
        } else {
            $error = "Terjadi Kesalahan: " . $conn->error;
        }

        // MENUTUP KONEKSI
        $stmt->close();
        $conn->close();
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.10/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div class="container">
        <div class="containerForm">
            <form action="register.php" class="form" method="POST">
                <!-- icon login -->
                <div class="iconLogin">
                    <i class="fa-solid fa-users"></i>
                </div>
    
                <!-- input username -->
                <div class="name">
                    <div class="iconUser">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <input type="text" id="name" name="name" placeholder="Nama pengguna" required>
                </div>

                <!-- input email -->
                <div class="email">
                    <div class="iconUser">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <input type="email" id="email" name="email" placeholder="Email Pengguna" required>
                </div>
    
                <!-- input kata sandi -->
                <div class="password">
                    <div class="iconUser">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" name="password" placeholder="Kata sandi" id="password" required>
                    <span class="showHide"> 
                        <i id="toggleIcon" class="fa-solid fa-eye"></i>
                    </span>
                </div>
    
                <!-- button masuk -->
                <button type="submit">Daftar</button>
            </form>
        </div>
        <div class="containerLogin">
            <p>Sudah punya akun? <a href="index.php">Masuk Akun</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.10/dist/sweetalert2.all.min.js"></script>

    <script>
        // Jika pendaftaran berhasil, tampilkan SweetAlert
        <?php if (isset($success) && $success): ?>
            Swal.fire({
                icon: 'success',
                title: 'Pendaftaran Berhasil!',
                text: 'Akun Anda telah berhasil didaftarkan!',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location = 'index.php'; // Ganti dengan halaman yang sesuai setelah berhasil daftar
            });
        <?php endif; ?>

        // Jika terjadi kesalahan
        <?php if (isset($error)): ?>
            alert("<?php echo $error; ?>");
        <?php endif; ?>
    </script>

    <script src="js/hide.js"></script>
</body>
</html>
