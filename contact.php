<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>Contact Us - TTJ T BAR Cafe</title>
</head>

<body>
    <?php include('navbar.php'); ?>
    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-info">
            <h2>ข้อมูลการติดต่อ</h2>
            <p><strong>ที่อยู่:</strong> 144/3 ม.6 ต.ปงยางคก อ.ห้างฉัตร, จ.ลำปาง</p>
            <p><strong>โทร:</strong> 086-361-2553</p>
            <p><strong>Facebook:</strong> ทีทีเจ ทีบาร์2 </p>
            <p><strong>เวลาทำการ:</strong> ทุกวัน 10:00 - 17:30 น.</p>
            <p><strong>Google map:</strong><iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3788.653504550624!2d99.38370517464644!3d18.27169897673003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30d969e36b12d7d5%3A0x589f1f539b38808!2z4LiX4Li14LiX4Li14LmA4LiIIOC4l-C4teC4muC4suC4o-C5jDI!5e0!3m2!1sth!2sth!4v1738329792821!5m2!1sth!2sth"
                    width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe></p>
        </div>

        <div class="contact-form">
            <h2>ส่งข้อความหาเรา</h2>
            <form onsubmit="return sendMail();">
                <div class="form-group">
                    <label for="name">ชื่อ:</label>
                    <input type="text" id="name" name="name" placeholder="กรอกชื่อของคุณ" required>
                </div>
                <div class="form-group">
                    <label for="email">อีเมล:</label>
                    <input type="email" id="email" name="email" placeholder="กรอกอีเมลของคุณ" required>
                </div>
                <div class="form-group">
                    <label for="message">ข้อความ:</label>
                    <textarea id="message" name="message" rows="5" placeholder="กรอกข้อความของคุณ" required></textarea>
                </div>
                <button type="submit">ส่งข้อความ</button>
            </form>

        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <p>ทีทีเจ ทีบาร์ โทร: 086 361 2553</p>
            <p>ที่อยู่: 144/3 ม.6 ต.ปงยางคก อ.ห้างฉัตร, Amphoe Hang Chat, Thailand, Lampang ❤️</p>
        </div>
    </footer>

    <script>
        function sendMail() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var message = document.getElementById("message").value;

            var subject = encodeURIComponent("ข้อความจากลูกค้า: " + name);
            var body = encodeURIComponent("ชื่อ: " + name + "\nอีเมล: " + email + "\n\nข้อความ:\n" + message);

            var mailtoLink = "mailto:kantisakingkum0032@gmail.com?subject=" + subject + "&body=" + body;

            window.location.href = mailtoLink;

            return false;
        }
    </script>


</body>

</html>