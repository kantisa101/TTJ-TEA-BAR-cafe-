<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/manageSales.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>ระบบขายสินค้า - TTJ TEA BAR Cafe'</title>
</head>

<body>
    <?php
    session_start();
    require_once('script/script.php');
    $db_handle = new myDBControl();
    // ตรวจสอบสิทธิ์เข้าใช้งาน
    include('check2.php');

    // ตรวจสอบ product
    $tsearch = '';
    if (isset($_GET['search'])) {
        $k = $_GET['search'];
        $tsearch = " AND (Product_name LIKE '%" . $k . "%' OR Category_id LIKE '%" . $k . "%')";
    } else {
        $tsearch = '';
    }

    // ดึงค่ามาไว้ในตัวแปร
    $id = $_SESSION['id'] ?? '';
    $fname = $_SESSION['fname'] ?? '';
    $lname = $_SESSION['lname'] ?? '';

    // ตรวจสอบ Member ที่รับจาก memberhistory ทาง url
    if (isset($_GET['Mem_id'], $_GET['Mem_fname'])) {
        $Mem_id = htmlspecialchars($_GET['Mem_id'], ENT_QUOTES, 'UTF-8');
        $Mem_fname = htmlspecialchars($_GET['Mem_fname'], ENT_QUOTES, 'UTF-8');
        $Mem_lname = htmlspecialchars($_GET['Mem_lname'], ENT_QUOTES, 'UTF-8');
        // echo "Mem_id: " . $Mem_id . "<br>";
        // echo "First Name: " . $Mem_fname . "<br>";
        // echo "Last Name: " . $Mem_lname . "<br>";
    } else {
        // echo "ไม่พบสมาชิก!";
        $Mem_id = "00000";
        $Mem_fname = "ไม่เป็นสมาชิก";
    }

    ?>

    <div class="container">
        <div class="product-section">
            <h1>🛒 ระบบขายสินค้า - TTJ TEA BAR Cafe'</h1>
            <p>รหัสสมาชิก: <?php echo htmlspecialchars($Mem_id); ?></p>
            <p id="cname"><?php echo htmlspecialchars($Mem_fname . " " . htmlspecialchars($Mem_lname)); ?></p>

            <input type="hidden" id="ename" name="ename" value="<?php echo ($fname . " " . ($lname)) ?>">

            <!-- <div class="section4">
                <div class="SLeft">
                    <input type="text" placeholder="ค้นหาสินค้า" id="keyword">
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
            </div> -->

            <div class="product">
                <?php
                $data = $db_handle->Textquery("SELECT * FROM Product_DATA WHERE 1=1" . $tsearch);
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
                            <p><b>ชื่อ:</b> <?php echo $data[$key]['New_name']; ?>...</p>
                            <p><b>ประเภท:</b> <?php echo $data[$key]['Category_name']; ?></p>
                            <p><b>ราคา:</b> <?php echo number_format($data[$key]['Product_price'], 2); ?> บาท</p>
                            <button
                                onclick="addToCart('<?= $data[$key]['Product_id']; ?>', '<?= htmlspecialchars($data[$key]['Product_name']); ?>', <?= $data[$key]['Product_price']; ?>)">เลือกซื้อ</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="cart-section">
            <div class="cart">
                <h2>🛍️ ตะกร้าสินค้า</h2>
                <ul id="cart-list"></ul>
                <h3>💰 ยอดรวม: <span id="total">0</span> บาท</h3>
                <h3>ส่วนลด: <span id="discount">0</span> บาท</h3>
                <h3>รวมจ่ายทั้งสิ้น: <span id="pay">0</span> บาท</h3>
                <label for="payment-buttons">ช่องทางการชำระเงิน : </label>
                <select id="payment-buttons">
                    <option value="QR Code" onclick="payWithQR()">QR Code</option>
                    <option value="เงินสด" onclick="payWithCash()">เงินสด</option>
                </select>
                <br>
                <!-- <label for="payment-buttons">โปรโมชั่น : </label> -->
                <div class="SRight">
                    <?php $Typedetail = $db_handle->Textquery("SELECT * FROM Promotionlist;") ?>
                    <!-- เช็คตรงนี้เมื่อไม่เป็นสมาชิก -->

                    <select id="Stype" onchange="applyPromotion()"

                        <?php if ($Mem_id == "00000") {
                            echo "disabled";
                        } ?>> <!-- ใช้ applyPromotion() เมื่อเลือกโปรโมชั่น -->
                        <?php if (empty($Typedetail)) { ?>
                            <option value="0" selected>ไม่มีโปรโมชั่น</option>
                        <?php } else { ?>
                            <option value="0" selected>เลือกโปรโมชั่น</option> <!-- ค่าเริ่มต้น (ไม่มีส่วนลด) -->
                            <?php foreach ($Typedetail as $key => $value) { ?>
                                <option value="<?php echo $Typedetail[$key]["Pmo_discount"]; ?>">
                                    <?php echo $Typedetail[$key]["Pmo_id"] . " "; ?>
                                    <?php echo $Typedetail[$key]["Pmo_name"]; ?> - ลด
                                    <?php echo $Typedetail[$key]["Pmo_discount"]; ?>%
                                </option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <p id="sale-date"></p>
                <button class="pay-btn" onclick="saveAndPrintReceipt()">พิมพ์ใบเสร็จ</button>
                <button class="logout-btn" onclick="logout()">🚪 กลับหน้าสมาชิก</button>
            </div>
            <form>
                <div id="receipt">
                    <h2>ใบเสร็จรับเงิน</h2>
                    <p>ร้าน TTJ T BAR Cafe'</p>
                    <p><strong>วันที่ขาย:</strong> <span id="receipt-date"></span></p>
                    <hr>
                    <ul id="receipt-items"></ul>
                    <p><strong>ยอดรวม:</strong> <span id="receipt-total"></span> บาท</p>
                    <p>ขอบคุณที่ใช้บริการ!</p>
                </div>
            </form>
        </div>
    </div>

    <script>
        let cart = []; //เก็บสินค้าที่ถูกเลือก
        let discountRate = 0; //เก็บค่าส่วนลด
        let Pmo = "0000"; //เมื่อไม่มีการเลือกโปรโมชั่นเก็บเป็น 0000

        // function addToCart(productId, productName, productPrice) {
        //     const product = {
        //         id: productId,
        //         name: productName,
        //         price: productPrice,
        //         quantity: 1
        //     };
        //     cart.push(product);
        //     updateCart();
        // }

        function addToCart(productId, productName, productPrice) {
            // หา index ของสินค้านี้ในรถเข็น (ถ้ามีอยู่แล้ว)
            const index = cart.findIndex(item => item.id === productId);

            if (index !== -1) {
                // มีอยู่ในตะกร้าแล้ว → เพิ่มจำนวน
                cart[index].quantity += 1;
            } else {
                // ยังไม่มี → สร้างรายการใหม่
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    quantity: 1
                });
            }

            updateCart(); // ฟังก์ชันแสดงผล / คำนวณใหม่ตามที่คุณมีอยู่แล้ว
        }

        function updateCart() {
            const cartList = document.getElementById('cart-list');
            const totalElement = document.getElementById('total');
            const discountElement = document.getElementById('discount');
            const payElement = document.getElementById('pay');
            cartList.innerHTML = '';
            let total = 0;

            cart.forEach(product => {
                const li = document.createElement('li');
                li.innerHTML = `${product.name} - ${product.price.toFixed(2)} บาท - ${product.quantity}`;
                cartList.appendChild(li);
                total += product.quantity * product.price;
            });

            const totalDisc = (total * discountRate) / 100;
            const pay = total - totalDisc;

            totalElement.innerHTML = total.toFixed(2);
            discountElement.innerHTML = totalDisc.toFixed(2);
            payElement.innerHTML = pay.toFixed(2);
        }

        function applyPromotion() {
            const promoSelect = document.getElementById('Stype');
            console.log(promoSelect);
            discountRate = parseFloat(promoSelect.value);
            Pmo = promoSelect.options[promoSelect.selectedIndex].text.substring(0, 6);
            console.log(discountRate);
            console.log(promoSelect.selectedIndex);
            console.log(promoSelect.options[promoSelect.selectedIndex].text);
            console.log(Pmo);
            if (isNaN(discountRate)) discountRate = 0;
            updateCart();
        }

        function saveAndPrintReceipt() {
            if (cart.length === 0) {
                alert('กรุณาเลือกซื้อสินค้าอย่างน้อย 1 รายการ');
                return; // หยุดฟังก์ชันทันทีหากตะกร้าว่าง
            }
            const date = new Date();
            const receiptDate = `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')} ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}:${date.getSeconds().toString().padStart(2, '0')}`;

            const memId = "<?= $Mem_id; ?>"; // รับค่าจาก PHP
            const empId = "<?= $id; ?>"; // รับค่าจาก PHP

            if (!memId) {
                alert("ไม่พบข้อมูลสมาชิก!");
                return;
            }

            // สร้างข้อมูลเพื่อส่งไป PHP
            if (!Pmo) {
                alert("ไม่พบข้อมูลPMO!");
                return;
            }
            const saleData = {
                Sales_datetime: receiptDate,
                Mem_id: memId,
                Emp_id: empId,
                Pmo_id: Pmo,
                Products: cart.map(product => ({
                    Product_id: product.id,
                    Quantity: product.quantity,
                    Price: product.price
                })),
                Sales_discount: parseFloat(document.getElementById('discount').innerText),
                Sales_total: parseFloat(document.getElementById('pay').innerText),
                Sales_Payment_channels: document.getElementById('payment-buttons').value
            };

            console.log("ส่งข้อมูลไปยังเซิร์ฟเวอร์:", saleData);

            // เรียก API
            fetch('saveReceipt.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(saleData)
                })
                .then(response => response.json())
                .then(data => {
                    console.log("ผลลัพธ์จากเซิร์ฟเวอร์:", data);
                    if (data.success) {
                        alert('บันทึกรายการขายสำเร็จ! เลขที่ใบเสร็จ: ' + data.Sales_id);
                        // alert('ok 1');
                        printReceipt(data.Sales_id);
                    } else {
                        alert('เกิดข้อผิดพลาด: ' + data.message);
                    }
                })
            // .catch(error => {
            //     console.error('Error:', error);
            //     alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล!');
            // });
        }

        function printReceipt(salesId) {
            // alert('ok 2');

            const date = new Date().toLocaleString('th-TH');
            const total = document.getElementById('pay').innerText;
            const cname = document.getElementById('cname').innerText;
            const ename = document.getElementById('ename').value;
            // alert('ok 3');


            const receiptContent = `
        <h2>ใบเสร็จรับเงิน</h2>
        <p>ร้าน TTJ T BAR Cafe'</p>
        <p><strong>เลขที่ใบเสร็จ:</strong> ${salesId}</p>
        <p><strong>วันที่:</strong> ${date}</p>
        <p><strong>ชื่อลูกค้า:</strong> ${cname}</p>
        <hr>
        <ul>
            ${cart.map(item => `<li>${item.name} x ${item.quantity} = ${(item.price * item.quantity).toFixed(2)} บาท</li>`).join('')}
        </ul>
        <hr>
        <p><strong>รวมทั้งสิ้น:</strong> ${total} บาท</p>
        <p><strong>พนักงานขาย:</strong> ${ename}</p>
        <p>ขอบคุณที่ใช้บริการ!</p>
    `;
            // alert(receiptContent);

            const printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>ใบเสร็จรับเงิน</title></head><body>');
            printWindow.document.write(receiptContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }

        function logout() {
            window.location = 'memberhistory.php';
        }
    </script>

</body>

</html>