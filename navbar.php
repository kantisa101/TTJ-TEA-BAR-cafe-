<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        header {
            background: linear-gradient(to bottom, #49c4b6, #005690);
            color: white;
            padding: 20px;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            /* จัดให้องค์ประกอบในนี้อยู่กลางแนวตั้ง */
        }

        .header-left .logo {
            width: 80px;
            border-radius: 50%;
            margin-right: 15px;
            /* กำหนดระยะห่างระหว่างโลโก้และข้อความ */
        }

        .header-left h1 a{
            color: white;
            text-decoration: none;
            font-size: 1.6rem;
            /* ขนาดตัวอักษรของชื่อร้าน */
            margin: 0;
            /* เอาระยะห่างบนและล่างออก */
        }

        .header-right {
            display: flex;
            align-items: center;
            /* จัดให้องค์ประกอบในนี้อยู่กลางแนวตั้ง */
        }

        .navbar a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-size: 1rem;
        }

        .navbar a:hover {
            color: #ff9800;
        }

        .login-button {
            background-color: #ffdd00;
            color: #333;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            margin-left: 20px;
            /* เพิ่มระยะห่างระหว่างเมนูและปุ่ม Login */
        }

        .login-button:hover {
            background-color: #ff9800;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <div class="header-left">
                <a href="index.php"><img src="img/about/02.jpg" class="logo" alt="TTJ T BAR Logo"></a>
                <h1><a href="index.php"><?php echo $_SESSION['title'] ?></h1></a>
            </div>
            <div class="header-right">
                <nav class="navbar">
                    <a href="index.php">หน้าแรก</a>
                    <a href="menu.php">เมนู</a>
                    <a href="about.php">เกี่ยวกับ</a>
                    <a href="contact.php">ติดต่อ</a>
                </nav>
                <a href="login.php"><button class="login-button">Login</button></a>
            </div>
        </div>
    </header>
</body>

</html>