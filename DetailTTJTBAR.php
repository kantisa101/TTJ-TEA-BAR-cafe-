<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/manager.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>ระบบจัดการข้อมูลประชาสัมพันธ์</title>
</head>

<body>
    <?php
    session_start();
    require_once('script/script.php');
    $db_handle = new myDBControl();
    include('check2.php');

    $id = $_SESSION['id'] ?? '';
    $fname = $_SESSION['Fname'] ?? '';
    ?>

    <div class="container">
        <?php include('sidebar.php'); ?>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <span>: ระบบจัดการข้อมูลประชาสัมพันธ์</span>
                <button class="add-employee" onclick="InsertClick()">➕ เพิ่มข้อมูลประชาสัมพันธ์</button>
            </header>

            <section class="table-container">
                <h3>งานข้อมูลประชาสัมพันธ์</h3>
                <table>
                    <thead>
                        <tr>
                            <th>รหัสร้านค้า</th>
                            <th>หัวข้อ</th>
                            <th>รายละเอียด</th>
                            <th>ที่อยู่ร้านค้า</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th>รูปภาพ1</th>
                            <th>รูปภาพ2</th>
                            <th>รูปภาพ3</th>
                            <th>การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = $db_handle->Textquery("SELECT * FROM DetailTTJ_T_BAR");
                        if (!empty($data)) {
                            foreach ($data as $key => $value) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($value['Detail_id'], ENT_QUOTES); ?></td>
                                    <td><?= htmlspecialchars($value['Detail_topic'], ENT_QUOTES); ?></td>
                                    <td><?= htmlspecialchars($value['Detail_info'], ENT_QUOTES); ?></td>
                                    <td><?= htmlspecialchars($value['Detail_address'], ENT_QUOTES); ?></td>
                                    <td><?= htmlspecialchars($value['Detail_tel'], ENT_QUOTES); ?></td>
                                    <td><img src="<?= htmlspecialchars($value['Detail_banner1'], ENT_QUOTES); ?>" alt="Image 1">
                                    </td>
                                    <td><img src="<?= htmlspecialchars($value['Detail_banner2'], ENT_QUOTES); ?>" alt="Image 2">
                                    </td>
                                    <td><img src="<?= htmlspecialchars($value['Detail_banner3'], ENT_QUOTES); ?>" alt="Image 3">
                                    </td>
                                    <td>
                                        <button type="button" class="edit-button"
                                            onclick="editClick(<?= $key; ?>, '<?= htmlspecialchars(json_encode($value), ENT_QUOTES); ?>')">
                                            แก้ไขข้อมูล
                                        </button>
                                        <!-- <button type="button" class="delete-button"
                                            onclick="if(confirm('กรุณายืนยันการลบข้อมูล ?')) location.href='DetailProcess.php?st=del&Detail_id=<?= $value['Detail_id']; ?>'">
                                            ลบข้อมูล
                                        </button> -->
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            echo "<tr><td colspan='6' style='text-align:center;'>ไม่พบข้อมูลประชาสัมพันธ์ในปัจจุบัน...</td></tr>";
                        } ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <form action="DetailProcess.php" method="post" enctype="multipart/form-data">
        <div id="info1" class="info_Member" style="display: none;">
            <div class="info_Detail">
                <div class="infoLeft">
                    <h4 id="topicname">เพิ่มข้อมูลประชาสัมพันธ์</h4>
                    <input type="hidden" id="st" name="st">
                    <div class="row">
                        <label>รหัสร้านค้า</label>
                        <input type="text" id="Detail_id" name="Detail_id" maxlength="8" placeholder="รหัสร้านค้า">
                    </div>
                    <div class="row">
                        <label>หัวข้อ</label>
                        <input type="text" id="Detail_topic" name="Detail_topic" maxlength="100" placeholder="หัวข้อ">
                    </div>
                    <div class="row">
                        <label>รายละเอียด</label>
                        <input type="text" id="Detail_info" name="Detail_info" maxlength="500" placeholder="รายละเอียด">
                    </div>
                    <div class="row">
                        <label>ที่อยู่ร้านค้า</label>
                        <textarea id="Detail_address" name="Detail_address" maxlength="255"
                            placeholder="ที่อยู่ร้านค้า"></textarea>
                    </div>
                    <div class="row">
                        <label>เบอร์โทรศัพท์</label>
                        <input type="text" id="Detail_tel" name="Detail_tel" maxlength="11" placeholder="เบอร์โทรศัพท์">
                    </div>
                </div>
                <div class="infoRight">
                    <p>รูปภาพ Banner</p>
                    <label id="Detail_banner1_label"></label>
                    <input type="file" name="Detail_image1" accept="image/jpeg/png">
                    <label id="Detail_banner2_label"></label>
                    <input type="file" name="Detail_image2" accept="image/jpeg/png">
                    <label id="Detail_banner3_label"></label>
                    <input type="file" name="Detail_image3" accept="image/jpeg/png">
                    <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                    <button type="button" class="btn btn-secondary" onclick="cancelClick()">ยกเลิก</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        function InsertClick() {
            document.getElementById("info1").style.display = "flex";
            document.getElementById("topicname").innerText = "เพิ่มข้อมูลประชาสัมพันธ์";
            document.getElementById("st").value = 'add';
            document.querySelector("form").reset();
        }

        function cancelClick() {
            document.getElementById("info1").style.display = "none";
        }

        function editClick(index, dataJson) {
            let data = JSON.parse(dataJson);
            document.getElementById("info1").style.display = "flex";
            document.getElementById("topicname").innerText = "แก้ไขข้อมูลประชาสัมพันธ์";
            document.getElementById("st").value = 'edit';

            // กำหนดค่าในฟิลด์
            document.getElementById("Detail_id").value = data.Detail_id;
            document.getElementById("Detail_topic").value = data.Detail_topic;
            document.getElementById("Detail_info").value = data.Detail_info;
            document.getElementById("Detail_address").value = data.Detail_address;
            document.getElementById("Detail_tel").value = data.Detail_tel;

            // แสดงชื่อไฟล์รูปภาพ
            document.getElementById("Detail_banner1_label").innerText = `File: ${data.Detail_banner1}`;
            document.getElementById("Detail_banner2_label").innerText = `File: ${data.Detail_banner2}`;
            document.getElementById("Detail_banner3_label").innerText = `File: ${data.Detail_banner3}`;
        }
    </script>
</body>

</html>