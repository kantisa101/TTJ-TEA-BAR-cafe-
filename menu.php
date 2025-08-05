<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>Menu - TTJ T BAR Cafe</title>
</head>

<body>
    <?php
    session_start();
    require_once('script/script.php');
    $db_handle = new myDBControl();

    $tsearch = '';
    if (isset($_GET['search'])) {
        $k = $_GET['search'];
        $tsearch = ' WHERE (Product_name LIKE "%' . $k . '%")OR
    (Category_id LIKE "' . $k . '")';
    }
    ?>

    <?php include('navbar.php'); ?>
    <!-- เมนู -->
    <main class="menu-section">

        <h3>เมนูของเรา</h3>
        <div class="section4">
            <div class="SLeft">
                <input type="text" placeholder="ระบุคำค้น" id="keyword">
                <button name="act" onclick="searchClick()">Search</button>
            </div>
            <div class="SRight">
                <?php $Typedetail = $db_handle->Textquery("SELECT * FROM ProductCategory;") ?>
                <select id="Stype" onchange="searchType()">
                    <?php if (empty($Typedetail)) { ?>
                        <option selected>ไม่มีประเภทสินค้า</option>
                    <?php } else { ?>
                        <option selected>เลือกประเภทสินค้า</option>
                        <?php foreach ($Typedetail as $key => $value) { ?>
                            <option value="<?php echo $Typedetail[$key]["Category_id"]; ?>">
                                <?php echo $Typedetail[$key]["Category_name"]; ?>
                            </option>
                        <?php }
                    } ?>
                </select>
            </div>
        </div>

        <div class="section5">
            <div class="product">
                <?php
                $data = $db_handle->Textquery("SELECT * FROM Product_DATA" . $tsearch);
                ?>
                <?php foreach ($data as $key => $value) { ?>
                    <div class="productBox boxSize_M">
                        <?php if (file_exists(htmlspecialchars($value['Product_picture'], ENT_QUOTES))) { ?>
                            <img class="productImg" src="<?= htmlspecialchars($value['Product_picture'], ENT_QUOTES); ?>"
                                alt="Product_picture">
                        <?php } else { ?>
                            <img class="productImg" src="img/about/02.jpg" alt="Product_picture">
                        <?php } ?>
                        <div class="productTxt">
                            <h6><b>รหัสสินค้า</b> <?php echo $data[$key]['Product_id']; ?></h6>
                            <p><b>ชื่อสินค้า:</b> <?php echo $data[$key]['Product_name']; ?></p>
                            <p><b>ประเภทสินค้า:</b> <?php echo $data[$key]['Category_name']; ?></p>
                            <p><b>ราคา:</b> <?php echo number_format($data[$key]['Product_price'], 2); ?> บาท</p>
                            <!-- <button onclick="alert('ฉันเลือกซื้อสินค้ารายการนี้....');">เลือกซื้อ</button> -->
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <p>ทีทีเจ ทีบาร์ โทร: 086 361 2553</p>
            <p>ที่อยู่: 144/3 ม.6 ต.ปงยางคก อ.ห้างฉัตร, Amphoe Hang Chat, Thailand, Lampang ❤️</p>
        </div>
    </footer>

    <script>
        
        function searchClick() {
            let kword = document.getElementById('keyword').value;
            window.location = 'menu.php?search=' + kword;
            console.log(kword);
        }
        function searchType() {
            var kword = document.getElementById('Stype').value;
            window.location = 'menu.php?search=' + kword;
            console.log('type id = ' + kword);
        }
    </script>
</body>

</html>