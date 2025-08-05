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
    <title>ระบบจัดการข้อมูลโปรโมชั่น</title>
</head>

<body>
    <?php
    session_start();
    require_once('script/script.php');
    $db_handle = new myDBControl();
    include('check1.php');

    $id = $_SESSION['id'] ?? '';
    $fname = $_SESSION['Fname'] ?? '';
    ?>

    <div class="container">
        <?php include('sidebar.php'); ?>

        <main class="main-content">
            <header class="header">
                <span>: ระบบจัดการข้อมูลโปรโมชั่น</span>
                <button class="add-employee" onclick="InsertClick()">➕ เพิ่มข้อมูลโปรโมชั่น</button>
            </header>

            <section class="table-container">
                <h3>ข้อมูลโปรโมชั่น</h3>
                <table>
                    <thead>
                        <tr>
                            <th>รหัสโปรโมชั่น</th>
                            <th>ชื่อโปรโมชั่น</th>
                            <th>รายละเอียดโปรโมชั่น</th>
                            <th>วันที่เริ่มใช้</th>
                            <th>วันที่สิ้นสุด</th>
                            <th>วันหมดอายุ</th>
                            <th>การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = $db_handle->Textquery("SELECT *, DATEDIFF(`Pmo_Enddate`, CURDATE()) AS Expired FROM Promotion;");
                        if (!empty($data)) {
                            foreach ($data as $key => $value) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($value['Pmo_id'], ENT_QUOTES); ?></td>
                                    <td><?= htmlspecialchars($value['Pmo_name'], ENT_QUOTES); ?></td>
                                    <td><?= htmlspecialchars($value['Pmo_Description'], ENT_QUOTES); ?></td>
                                    <td><?= htmlspecialchars($value['Pmo_startdate'], ENT_QUOTES); ?></td>
                                    <td><?= htmlspecialchars($value['Pmo_Enddate'], ENT_QUOTES); ?></td>
                                    <td>
                                        <?php if ($value['Expired'] < 0): ?>
                                            <span style="color:red;">หมดอายุแล้ว</span>
                                        <?php else: ?>
                                            เหลืออีก <?= $value['Expired']; ?> วัน
                                        <?php endif; ?>
                                    </td>

                                    <!-- <td><?= htmlspecialchars($value['Expired'], ENT_QUOTES); ?></td> -->
                                    <td>
                                        <button type="button" class="edit-button"
                                            onclick="editClick(<?= $key; ?>, '<?= htmlspecialchars(json_encode($value), ENT_QUOTES); ?>')">
                                            แก้ไขข้อมูล
                                        </button>
                                        <button type="button" class="delete-button"
                                            onclick="if(confirm('กรุณายืนยันการลบข้อมูล ?')) location.href='PromotionProcess.php?st=del&Pmo_id=<?= $value['Pmo_id']; ?>'">
                                            ลบข้อมูล
                                        </button>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            echo "<tr><td colspan='6' style='text-align:center;'>ไม่พบโปรโมชั่นในปัจจุบัน...</td></tr>";
                        } ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <form action="PromotionProcess.php" method="post" enctype="multipart/form-data">
        <div id="info1" class="info_Member" style="display: none;">
            <div class="info_Detail">
                <div class="infoLeft">
                    <h4 id="topicname">เพิ่มข้อมูลโปรโมชั่นใหม่</h4>
                    <input type="hidden" id="st" name="st">
                    <div class="row">
                        <label>รหัสโปรโมชั่น</label>
                        <input type="text" id="Pmoid" name="Pmoid" maxlength="8" placeholder="รหัสโปรโมชั่น">
                    </div>
                    <div class="row">
                        <label>ชื่อโปรโมชั่น</label>
                        <input type="text" id="Pmoname" name="Pmoname" maxlength="255" placeholder="ชื่อโปรโมชั่น">
                    </div>
                    <div class="row">
                        <label>รายละเอียดโปรโมชั่น</label>
                        <input type="text" id="Pmodes" name="Pmodes" maxlength="255" placeholder="รายละเอียดโปรโมชั่น">
                    </div>
                    <div class="row">
                        <label>วันที่เริ่มใช้</label>
                        <input type="date" id="PmoStart" name="PmoStart" maxlength="20" placeholder="วันที่เริ่มใช้">
                    </div>
                    <div class="row">
                        <label>วันที่สิ้นสุด</label>
                        <input type="date" id="PmoEnddate" name="PmoEnddate" maxlength="20" placeholder="วันที่สิ้นสุด">
                    </div>
                    <div class="row">
                        <label>เงื่อนไขการใช้งาน</label>
                        <input type="text" id="Pmocon" name="Pmocon" maxlength="255" placeholder="เงื่อนไขการใช้งาน">
                    </div>
                    <div class="row">
                        <label>ส่วนลด</label>
                        <input type="text" id="Pmodiscount" name="Pmodiscount" placeholder="ส่วนลด">
                    </div>
                    <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                    <button type="button" class="btn btn-secondary" onclick="cancelClick()">ยกเลิก</button>
                </div>

            </div>
        </div>
    </form>

    <script>
        function InsertClick() {
            document.getElementById("info1").style.display = "flex";
            document.getElementById("topicname").innerText = "เพิ่มข้อมูลโปรโมชั่นใหม่";
            document.getElementById("st").value = 'add';
            document.querySelector("form").reset();
            document.getElementById("profileImg").src = "img/p2.jpg";
        }

        function cancelClick() {
            document.getElementById("info1").style.display = "none";
        }

        function editClick(index, dataJson) {
            let data = JSON.parse(dataJson);
            document.getElementById("info1").style.display = "flex";
            document.getElementById("topicname").innerText = "แก้ไขข้อมูลโปรโมชั่น";
            document.getElementById("st").value = 'edit';
            document.getElementById("Pmoid").value = data.Pmo_id;
            document.getElementById("Pmoname").value = data.Pmo_name;
            document.getElementById("Pmodes").value = data.Pmo_Description;
            document.getElementById("PmoStart").value = data.Pmo_startdate;
            document.getElementById("PmoEnddate").value = data.Pmo_Enddate;
            document.getElementById("Pmocon").value = data.Pmo_condition;
            document.getElementById("Pmodiscount").value = data.Pmo_discount;
        }
    </script>
</body>

</html>