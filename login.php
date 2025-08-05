<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/loginstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login TTJ T Bar Cafe</title>
</head>

<body>
    <div class="container">
        <div class="form-box login">
            <form action="loginProcess.php" method="post">
                <h1>ยินดีต้อนรับ!</h1>
                <div class="input-box">
                    <input type="text" name="Uname" placeholder="ชื่อผู้ใช้" value="EMP001">
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="Passwd" placeholder="Password" value="123456">
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="forgot-link">
                    <a href="#">Forgot password?</a>
                </div>
                <button type="submit" class="btn">เข้าสู่ระบบ</button>
                <p>or login with social platforms</p>
                <div class="social-icons">
                    <a href="#"><i class='bx bxl-google'></i></a>
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-github'></i></a>
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                </div>
            </form>
        </div>

        <div class="toggle-box">
            <div class="image-container">
                <img src="img/about/โลโก้ร้านกาแฟ.png" alt="">
            </div>
        </div>
    </div>
</body>

</html>