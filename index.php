<?php
session_start();
require_once('script/script.php');
$db_handle = new myDBControl();

$data = $db_handle->Textquery("SELECT * FROM DetailTTJ_T_BAR");
$bestProducts = $db_handle->Textquery("SELECT * FROM BestSellingProducts");


$_SESSION['title'] = $data[0]['Detail_topic'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/indexstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>TTJ TEA BAR Cafe'</title>
</head>

<body>
    <?php include('navbar.php'); ?>
    <section class="about-section">
        <div class="about-container">
            <div class="about-image">
                <?php if (!empty($data)) {
                    foreach ($data as $value) { ?>
                        <div class="slides">
                            <img src="<?= htmlspecialchars($value['Detail_banner1']); ?>" class="slide" alt="Banner 1">
                            <img src="<?= htmlspecialchars($value['Detail_banner2']); ?>" class="slide" alt="Banner 2">
                            <img src="<?= htmlspecialchars($value['Detail_banner3']); ?>" class="slide" alt="Banner 3">
                        </div>
                    <?php }
                } else { ?>
                    <p style="text-align:center;">ไม่พบข้อมูลประชาสัมพันธ์...</p>
                <?php } ?>
            </div>
            <div class="about-content">
                <?php if (!empty($data)) {
                    foreach ($data as $value) { ?>
                        <h2><?= htmlspecialchars($value['Detail_topic']); ?></h2>
                        <p><?= nl2br(htmlspecialchars($value['Detail_info'])); ?></p>
                        <p>ที่อยู่: <?= htmlspecialchars($value['Detail_address']); ?></p>
                        <p>โทร: <?= htmlspecialchars($value['Detail_tel']); ?></p>
                <?php }
                } ?>
            </div>
        </div>
    </section>

    <!-- โปรโมชั่น -->
    <section class="promo-section">
        <h2>โปรโมชั่น TTJ TEA BAR Cafe</h2>
        <table>
            <thead>
                <tr>
                    <th>รหัสโปรโมชั่น</th>
                    <th>ชื่อโปรโมชั่น</th>
                    <th>รายละเอียดโปรโมชั่น</th>
                    <th>วันที่เริ่มใช้</th>
                    <th>วันที่สิ้นสุด</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data = $db_handle->Textquery("SELECT * FROM Promotionlist;");
                if (!empty($data)) {
                    foreach ($data as $key => $value) { ?>
                        <tr>
                            <td><?= htmlspecialchars($value['Pmo_id'], ENT_QUOTES); ?></td>
                            <td><?= htmlspecialchars($value['Pmo_name'], ENT_QUOTES); ?></td>
                            <td><?= htmlspecialchars($value['Pmo_Description'], ENT_QUOTES); ?></td>
                            <td><?= htmlspecialchars($value['Pmo_startdate'], ENT_QUOTES); ?></td>
                            <td><?= htmlspecialchars($value['Pmo_Enddate'], ENT_QUOTES); ?></td>
                        </tr>
                <?php }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>ไม่พบโปรโมชั่นในปัจจุบัน...</td></tr>";
                } ?>
            </tbody>
        </table>
    </section>

    <!--เมนู -->
    <section class="menu-section">
        <h2>สินค้าขายดี 10 อันดับ</h2>
        <div class="menu">
            <?php
            if (!empty($bestProducts)) {
                foreach ($bestProducts as $product) {
                    // เก็บ path รูปภาพที่ได้จากฐานข้อมูล
                    $imagePath = $product['Product_picture'];

                    // ตรวจสอบว่าไฟล์รูปมีจริงไหม
                    if (file_exists($imagePath)) {
                        $imageToShow = $imagePath;
                    } else {
                        $imageToShow = 'img/about/02.jpg';
                    }
            ?>
                    <div class="menu-item">
                        <img class="productImg" src="<?= $imageToShow; ?>" alt="Product_picture">
                        <h4><?= $product['Product_name']; ?></h4>
                        <p>ราคา: <?= number_format($product['Product_price'], 2); ?> บาท</p>
                        <p>ประเภทสินค้า: <?= $product['Category_name']; ?></p>
                        <!-- <p>ขายไปแล้ว: <?= $product['total_sold']; ?> ชิ้น</p> -->
                    </div>
            <?php
                }
            } else {
                echo '<p style="text-align:center;">ไม่มีข้อมูลสินค้าขายดีในขณะนี้</p>';
            }
            ?>
        </div>

    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <p>ทีทีเจ ทีบาร์ โทร: 086 361 2553</p>
            <p>ที่อยู่: 144/3 ม.6 ต.ปงยางคก อ.ห้างฉัตร, Lampang, Thailand ❤️</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let currentIndex = 0;
            const slides = document.querySelector(".slides");
            const dots = document.querySelectorAll(".nav-dot");

            function showSlide(index) {
                currentIndex = index;
                const slideWidth = document.querySelector(".slide").clientWidth;
                slides.style.transform = `translateX(-${slideWidth * index}px)`;

                dots.forEach((dot, i) => {
                    dot.classList.toggle("active", i === index);
                });
            }

            function currentSlide(index) {
                showSlide(index - 1);
            }

            // Auto-slide
            setInterval(() => {
                currentIndex = (currentIndex + 1) % 3; // มี 3 ภาพ
                showSlide(currentIndex);
            }, 5000); // 5 วินาที

            // เพิ่ม Event Listener ให้ปุ่มนำทาง
            dots.forEach((dot, index) => {
                dot.addEventListener("click", () => currentSlide(index + 1));
            });
        });

        // โปรโมชั่น Slide
        document.addEventListener("DOMContentLoaded", () => {
            const promoSlides = document.querySelector(".promo-slides");
            let promoIndex = 0;

            setInterval(() => {
                promoIndex = (promoIndex + 1) % 4; // มี 4 รูป
                promoSlides.style.transform = `translateX(-${promoIndex * 25}%)`;
            }, 4000); // ทุก 4 วิ
        });
    </script>

</body>

</html>