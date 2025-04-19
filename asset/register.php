<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div class="container">
        <div class="containerForm">
            <form action="register.php" class="form">
                <!-- icon login -->
                <div class = "iconLogin">
                    <i class="fa-solid fa-users"></i>
                </div>
    
                <!-- input username -->
                <div class="username">
                    <div class = "iconUser">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <input type="text" placeholder="Nama pengguna">
                </div>
    
                <!-- input kata sandi -->
                <div class="password">
                    <div class = "iconUser">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" name="password" placeholder="Kata sandi" id="inputPass" required>
                    <span class="showHide"> 
                        <i id = "toggleIcon" class="fa-solid fa-eye"></i>
                    </span>
                </div>
    
                <!-- button masuk -->
                <button type="submit">Daftar</button>
            </form>
        </div>
        <div class = "containerLogin">
            <p>Sudah punya akun? <a href="index.php">Masuk Akun</a></p>
        </div>
    </div>
    <Script src="js/hide.js"></Script>
</body>
</html>