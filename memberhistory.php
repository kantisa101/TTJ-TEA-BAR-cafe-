<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>ประวัติการสั่งซื้อของสมาชิก</title>
    <link rel="stylesheet" href="css/memberhistory.css">
</head>

<body>
    <?php
    session_start();
    require_once('script/script.php');
    $db_handle = new myDBControl();
    include('check2.php');

    $id = $_SESSION['id'] ?? '';
    $fname = $_SESSION['Fname'] ?? '';

    $limit = 5;
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $offset = ($page - 1) * $limit;
    $search = $_GET['search'] ?? '';

    $query = "SELECT * FROM Member";
    if ($search) {
        $query .= " WHERE Mem_id LIKE '%$search%' OR Mem_fname LIKE '%$search%' OR Mem_lname LIKE '%$search%'";
    }
    $query .= " LIMIT $limit OFFSET $offset";
    $data = $db_handle->Textquery($query);

    // นับจำนวนทั้งหมด
    $count_query = "SELECT COUNT(*) AS total FROM Member";
    if ($search) {
        $count_query .= " WHERE Mem_id LIKE '%$search%' OR Mem_fname LIKE '%$search%' OR Mem_lname LIKE '%$search%'";
    }
    $total_result = $db_handle->Textquery($count_query);
    $total_rows = $total_result[0]['total'] ?? 0;
    $total_pages = ceil($total_rows / $limit);

    // กำหนดจำนวนเลขหน้าที่แสดง (เช่น แสดง 5 หน้า)
    $page_range = 5;
    $start_page = max(1, $page - floor($page_range / 2));
    $end_page = min($total_pages, $start_page + $page_range - 1);

    // หาก $end_page ไปไกลเกิน max ให้เลื่อน $start_page กลับมา
    $start_page = max(1, $end_page - $page_range + 1);

    // เตรียม search param เพื่อใช้กับลิงก์
    $searchParam = ($search) ? '&search=' . urlencode($search) : '';

    ?>

    <div class="table-container">
        <h2>📜 ประวัติการสั่งซื้อของสมาชิก</h2>
        <div class="search-container">
            <input type="text" placeholder="🔍ค้นหารหัสสมาชิกและชื่อเท่านั้น" id="keyword">
            <button type="button" onclick="searchClick()">🔍ค้นหา</button>
            <button type="button">
                <a
                    href="manageSales.php?Mem_id=00000&Mem_fname=<?= htmlspecialchars('ไม่เป็นสมาชิก', ENT_QUOTES, 'UTF-8'); ?>">
                    <i class="fas fa-user-times"></i> ไม่เป็นสมาชิก
                </a>
            </button>

            <button type="button"><a href="manager.php"><i class="fas fa-cog"></i> ระบบจัดการ</a></button>
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
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // $search = $_GET['search'] ?? '';
                // $query = "SELECT * FROM Member";
                // if ($search) {
                //     $query .= " WHERE Mem_id LIKE '%$search%' OR Mem_fname LIKE '%$search%' OR Mem_lname LIKE '%$search%'";
                // }
                // $data = $db_handle->Textquery($query);
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
                            <td>
                                <button class="btn-manage">
                                    <a
                                        href="manageSales.php?Mem_id=<?= isset($value['Mem_id']) ? htmlspecialchars($value['Mem_id'], ENT_QUOTES) : ''; ?>&Mem_fname=<?= isset($value['Mem_fname']) ? htmlspecialchars($value['Mem_fname'], ENT_QUOTES) : ''; ?>&Mem_lname=<?= isset($value['Mem_lname']) ? htmlspecialchars($value['Mem_lname'], ENT_QUOTES) : ''; ?>">
                                        <i class="fas fa-check"></i>
                                    </a>
                                </button>

                            </td>
                        </tr>
                <?php }
                } else {
                    echo "<tr><td colspan='8' style='text-align:center;'>ไม่พบสมาชิกในปัจจุบัน...</td></tr>";
                } ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 . $searchParam ?>">«</a>
            <?php endif; ?>

            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                <a href="?page=<?= $i . $searchParam ?>" class="<?= ($i == $page) ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?= $page + 1 . $searchParam ?>">»</a>
            <?php endif; ?>
        </div>


    </div>

    <script>
        function searchClick() {
            let kword = document.getElementById('keyword').value;
            window.location = 'memberhistory.php?page=1&search=' + encodeURIComponent(kword);
        }
    </script>
</body>

</html>