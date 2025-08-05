<?php
session_start();

require_once('script/script.php');
$db_handle = new myDBControl();
include('check3.php');

$id = $_SESSION['id'] ?? '';
$fname = $_SESSION['Fname'] ?? '';


// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';


$data = $db_handle->Textquery("SELECT * FROM Sales WHERE Mem_id = '$id';");
$member = !empty($data) ? $data[0] : null;

?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Memberpersonalhistory.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>ประวัติการสั่งซื้อ</title>
</head>

<body>

    <div class="container">
        <?php include('sidebar.php'); ?>
        <main class="main-content">
            <header class="header">
                <span>: ประวัติการสั่งซื้อ <?php echo $fname; ?> </span>
            </header>

            <?php if (!empty($data)) : ?>
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>รหัสสั่งซื้อ</th>
                            <th>วันที่สั่งซื้อ</th>
                            <th>ส่วนลด</th>
                            <th>ยอดรวม</th>
                            <th>ช่องทางชำระเงิน</th>
                            <th>รหัสพนักงานขาย</th>
                            <th>รหัสโปรโมชั่น</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row): ?>
                            <tr>
                                <td><?php echo $row['Sales_id']; ?></td>
                                <td><?php echo date("d/m/Y H:i", strtotime($row['Sales_datetime'])); ?></td>
                                <td><?php echo number_format($row['Sales_discount'], 2); ?> บาท </td>
                                <td><?php echo number_format($row['Sales_total'], 2); ?> บาท </td>
                                <td><?php echo $row['Sales_Payment_channels']; ?></td>
                                <td><?php echo $row['Emp_id']; ?></td>
                                <td><?php echo $row['Pmo_id']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>ยังไม่มีประวัติการสั่งซื้อ</p>
            <?php endif; ?>
        </main>
    </div>

</body>

</html>