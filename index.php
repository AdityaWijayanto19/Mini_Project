<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
    
    <div class="container">
        <div class="containerForm">
            <form action="index.php" class="form">
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
                <div class ="password">
                    <div class= "iconPass">
                        <i class = "fa-solid fa-lock"></i>
                    </div>
                        <input type="password" id ="inputPass" name ="password" placeholder ="Kata Sandi" required>
                        <span class= "showHide">
                            <i id = "toggleIcon" class="fa-solid fa-eye"></i>
                        </span>
                </div>
    
                <!-- button masuk -->
                <button type="submit">Masuk</button>
                </form>

                <div style="display: flex; align-items: center; width: 280px; text-align: center;">
                    <hr style="flex-grow: 1; height: 1px; background-color: #000; border: none;">
                    <span style="padding: 0 10px; font-weight: 500;">ATAU</span>
                    <hr style="flex-grow: 1; height: 1px; background-color: #000; border: none;">
                </div>

                <div class="btnGoogle">
                    <button type="submit"> <i class="fa-brands fa-google"></i> Masuk</button>
                </div>

        </div>

        <div class = "containerRegist">
            <p>Belum punya akun? <a href="register.php">Buat akun</a></p>
        </div>
    </div>
    <script src="js/hide.js"></script>
</body>
</html>