<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/SalesReport.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>ระบบรายงานสมาชิกและยอดแก้วสะสม</title>
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

        <main class="main-content">
            <header class="header">
                <span>: ระบบรายงานสมาชิกและยอดแก้วสะสม <?php echo $_SESSION['title'] ?></span>
                <button class="printreport" onclick="printReport()">พิมพ์รายงาน</button>
            </header>

            <section class="table-container">
                <div class="search-container">
                    <input type="text" placeholder="🔍ค้นหารหัสสมาชิกและชื่อเท่านั้น" id="keyword">
                    <button type="button" onclick="searchClick()">🔍ค้นหา</button>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>รหัสสมาชิก</th>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>เบอร์โทร</th>
                            <th>ที่อยู่</th>
                            <th>วันที่เป็นสมาชิก</th>
                            <th>แก้วสะสม</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $search = $_GET['search'] ?? '';
                        $query = "SELECT * FROM Member WHERE Mem_stamp > 0";
                        if ($search) {
                            $query .= " AND (Mem_id LIKE '%$search%' OR Mem_fname LIKE '%$search%' OR Mem_lname LIKE '%$search%')";
                        }
                        
                        $data = $db_handle->Textquery($query);
                        if (!empty($data)) {
                            foreach ($data as $key => $value) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($value['Mem_id'], ENT_QUOTES); ?></td>
                                    <td><?= htmlspecialchars($value['Mem_fname'], ENT_QUOTES); ?></td>
                                    <td><?= htmlspecialchars($value['Mem_lname'], ENT_QUOTES); ?></td>
                                    <td><?= htmlspecialchars($value['Mem_tel'], ENT_QUOTES); ?></td>
                                    <td><?= htmlspecialchars($value['Mem_address'], ENT_QUOTES); ?></td>
                                    <td><?= htmlspecialchars($value['Mem_day'], ENT_QUOTES); ?></td>
                                    <td><?= htmlspecialchars($value['Mem_stamp'], ENT_QUOTES); ?></td>
                                </tr>
                        <?php }
                        } else {
                            echo "<tr><td colspan='8' style='text-align:center;'>ไม่พบสมาชิกในปัจจุบัน...</td></tr>";
                        } ?>
                    </tbody>
                </table>
                <!-- <div class="footer">
                    <div class="sum">
                        ยอดขายรวมทั้งสิ้น <input type="text" value="<?php echo number_format($total, 2); ?>" readonly>
                        บาท
                    </div>
                </div> -->
            </section>
        </main>
        <script>
            function printReport() {
                window.print();
            }

            function searchClick() {
                let kword = document.getElementById('keyword').value;
                window.location = 'memberReport.php?search=' + encodeURIComponent(kword);
            }
        </script>

</body>

</html>