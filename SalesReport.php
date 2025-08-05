<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/SalesReport.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>ระบบรายงานยอดขายสินค้า</title>
</head>

<body>
    <?php
    session_start();
    require_once('script/script.php');
    $db_handle = new myDBControl();
    include('check1.php');


    $date = '';
    $tsearch = '';
    if (isset($_GET['date']) && $_GET['date'] != '') {
        $date = $_GET['date'];
        $startDate = $date . '-01';
        $endDate = date('Y-m-t', strtotime($startDate));
        $tsearch = " WHERE Sales_datetime BETWEEN '$startDate' AND '$endDate'";
    }

    $limit = 7;
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $offset = ($page - 1) * $limit;

    // ดึงข้อมูลหน้าปัจจุบัน
    $sql = "SELECT * FROM Sales";
    if (!empty($tsearch)) {
        $sql .= " $tsearch";
    }
    $sql .= " ORDER BY Sales_datetime DESC LIMIT $limit OFFSET $offset";
    $data = $db_handle->Textquery($sql);

    // นับจำนวนแถวทั้งหมด
    $count_sql = "SELECT COUNT(*) as total FROM Sales" . $tsearch;
    $total_rows = $db_handle->Textquery($count_sql)[0]['total'];
    $total_pages = ceil($total_rows / $limit);

    // ดึงยอดขายรวมทั้งสิ้น
    $total_sql = "SELECT SUM(Sales_total) as total FROM Sales" . $tsearch;
    $total = $db_handle->Textquery($total_sql)[0]['total'] ?? 0;

    $sql_all = "SELECT * FROM Sales" . $tsearch . " ORDER BY Sales_datetime DESC";
    $all_data = $db_handle->Textquery($sql_all);
    ?>

    <div class="container">
        <?php include('sidebar.php'); ?>

        <main class="main-content">
            <header class="header">
                <span>: ระบบรายงานยอดขายสินค้า <?php echo $_SESSION['title'] ?></span>
                <button class="printreport" onclick="printReport()">พิมพ์รายงาน</button>
            </header>

            <section class="table-container">
                <div class="search">
                    เลือกเดือน/ปี
                    <input type="month" name="date" id="date" class="filter-input"
                        value="<?php echo htmlspecialchars($date); ?>" placeholder="yyyy-mm">
                    <button class="search-btn" onclick="dateClick();">ค้นหา</button>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>รหัสการขาย</th>
                            <th>วัน/เดือน/ปี</th>
                            <th>รหัสสมาชิก</th>
                            <th>ส่วนลด</th>
                            <th>เงินรวม</th>
                            <th>ช่องทางการชำระเงิน</th>
                            <th>รหัสพนักงาน</th>
                            <th>รหัสโปรโมชั่น</th>
                        </tr>
                    </thead>
                    <?php
                    if (!empty($data)) {
                        foreach ($data as $value) {
                            echo "<tr>
            <td>{$value['Sales_id']}</td>
            <td>{$value['Sales_datetime']}</td>
            <td>{$value['Mem_id']}</td>
            <td>{$value['Sales_discount']}</td>
            <td>{$value['Sales_total']}</td>
            <td>{$value['Sales_Payment_channels']}</td>
            <td>{$value['Emp_id']}</td>
            <td>{$value['Pmo_id']}</td>
        </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>ไม่พบข้อมูลในช่วงวันที่ที่ค้นหา</td></tr>";
                    }
                    ?>

                </table>
                <div class="footer">
                    <div class="sum">
                        ยอดขายรวมทั้งสิ้น <input type="text" value="<?php echo number_format($total, 2); ?>" readonly>
                        บาท
                    </div>
                </div>

                <div class="pagination">
                    <?php
                    $window_size = 4;

                    // หาจำนวนกลุ่มหน้าทั้งหมด
                    $total_windows = ceil($total_pages / $window_size);

                    // หาหมายเลขกลุ่มของหน้าปัจจุบัน
                    $current_window = ceil($page / $window_size);

                    // หาหน้าเริ่มและจบของกลุ่มปัจจุบัน
                    $start_page = ($current_window - 1) * $window_size + 1;
                    $end_page = min($start_page + $window_size - 1, $total_pages);

                    // เรียกพารามิเตอร์ search ถ้ามี
                    $searchParam = isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '';
                    ?>
                    <div class="pagination">
                        <?php if ($current_window > 1): ?>
                            <a href="?page=<?php echo $start_page - 1 . $searchParam; ?>">«</a>
                        <?php endif; ?>

                        <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                            <a href="?page=<?php echo $i; ?><?php echo ($date ? '&date=' . $date : ''); ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                                <?php echo $i; ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($end_page < $total_pages): ?>
                            <a href="?page=<?php echo $end_page + 1 . $searchParam; ?>">»</a>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </main>

        <div id="print-section" style="display:none;">
            <h2>รายงานยอดขาย <?php echo $_SESSION['title']; ?></h2>
            <table>
                <thead>
                    <tr>
                        <th>รหัสการขาย</th>
                        <th>วัน/เดือน/ปี</th>
                        <th>รหัสสมาชิก</th>
                        <th>ส่วนลด</th>
                        <th>เงินรวม</th>
                        <th>ช่องทางการชำระเงิน</th>
                        <th>รหัสพนักงาน</th>
                        <th>รหัสโปรโมชั่น</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_data as $value): ?>
                        <tr>
                            <td><?= $value['Sales_id'] ?></td>
                            <td><?= $value['Sales_datetime'] ?></td>
                            <td><?= $value['Mem_id'] ?></td>
                            <td><?= $value['Sales_discount'] ?></td>
                            <td><?= $value['Sales_total'] ?></td>
                            <td><?= $value['Sales_Payment_channels'] ?></td>
                            <td><?= $value['Emp_id'] ?></td>
                            <td><?= $value['Pmo_id'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p>ยอดขายรวมทั้งสิ้น: <?= number_format($total, 2); ?> บาท</p>
        </div>

        <script>
            function dateClick() {
                let Tdate = document.getElementById('date').value;
                if (Tdate) {
                    window.location = 'SalesReport.php?date=' + Tdate;
                } else {
                    alert('กรุณาเลือกเดือน/ปีที่ต้องการค้นหา');
                }
            }

            function printReport() {
                let originalContent = document.body.innerHTML;
                let printContent = document.getElementById('print-section').innerHTML;

                document.body.innerHTML = printContent;
                window.print();
                document.body.innerHTML = originalContent;
                location.reload(); // เพื่อให้กลับมาทำงานต่อหลังพิมพ์
            }
        </script>
    </div>

</body>

</html>