<!DOCTYPE html>
<?php

session_start();

?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;300;400;500;600;700&display=swap"
    rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    /* Sidebar */
    .sidebar {
      width: 250px;
      background: linear-gradient(to bottom, #49c4b6, #005690);
      color: #fff;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .sidebar h2 {
      font-size: 1.5rem;
      margin-bottom: 20px;
      text-align: center;
    }

    .sidebar img {
      border-radius: 50%;
      margin-bottom: 2px;
      width: 50px;
      height: 50px;
    }

    .sidebar p {
      font-size: 1rem;
      margin-bottom: 20px;
    }

    .sidebar nav {
      display: flex;
      flex-direction: column;
      gap: 10px;
      width: 100%;
    }

    .sidebar nav a {
      text-decoration: none;
      color: #ffffff;
      padding: 10px;
      border-radius: 8px;
      text-align: left;
      transition: background-color 0.3s ease;
    }

    .sidebar nav a:hover {
      background-color: #005f73;
    }

    .logout-button {
      margin-top: auto;
      padding: 10px 15px;
      background-color: #e53935;
      border: none;
      border-radius: 8px;
      color: #fff;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-top: 6px;
    }

    .logout-button:hover {
      background-color: #d32f2f;
    }
  </style>
</head>
<!-- Sidebar -->
<aside class="sidebar">
  <h2>TTJ TEA BAR Cafe'</h2>
  <p><?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?></p>
  <nav>
    <?php if ($_SESSION["status"] == '1') { ?>
      <a href="manager.php"><i class="fa-solid fa-user-tie"></i> เจ้าของ/พนักงาน</a>
    <?php } ?>
    <?php if ($_SESSION["status"] == '1' || $_SESSION["status"] == '2') { ?>
      <a href="manageMember.php"><i class="fa-solid fa-users"></i> สมาชิก</a>
    <?php } ?>
    <?php if ($_SESSION["status"] == '1') { ?>
      <a href="ProductCategory.php"><i class="fa-solid fa-layer-group"></i> หมวดหมู่สินค้า</a>
      <a href="product.php"><i class="fa-solid fa-mug-hot"></i> ข้อมูลสินค้า</a>
      <a href="Promotion.php"><i class="fa-solid fa-tags"></i> โปรโมชั่น</a>
      <a href="SalesReport.php"><i class="fa-solid fa-chart-line"></i> รายงานยอดขายสินค้า</a>
    <?php } ?>
    <?php if ($_SESSION["status"] == '1' || $_SESSION["status"] == '2') { ?>
      <a href="memberReport.php"><i class="fa-solid fa-id-card"></i> รายงานสมาชิกและยอดแก้วสะสม</a>
      <a href="DetailTTJTBAR.php"><i class="fa-solid fa-bullhorn"></i> จัดการข้อมูลประชาสัมพันธ์</a>
      <a href="memberhistory.php"><i class="fa-solid fa-cash-register"></i> จัดการขายสินค้า</a>
    <?php } ?>

    <?php if ($_SESSION["status"] == '3') { ?>
      <a href="Memberpersonal.php"><i class="fa-solid fa-user-tie"></i> ข้อมูลส่วนตัว</a>
      <a href="Memberpersonalhistory.php"><i class="fa-solid fa-cash-register"></i> ประวัติการสั่งซื้อ</a>
    <?php } ?>

  </nav>
  <a href="index.php"><button class="logout-button"><i class="fa-solid fa-sign-out-alt"></i> ออกจากระบบ</button></a>
</aside>