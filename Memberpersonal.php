<?php
session_start();

require_once('script/script.php');
$db_handle = new myDBControl();
include('check3.php');

$id = $_SESSION['id'] ?? '';
$fname = $_SESSION['Fname'] ?? '';

$data = $db_handle->Textquery("SELECT * FROM Member WHERE Mem_id = '$id'");
$member = !empty($data) ? $data[0] : null;
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Memberpersonal.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>ข้อมูลส่วนตัว</title>
</head>

<body>
    <div class="container">
        <?php include('sidebar.php'); ?>
        <main class="main-content">
            <header class="header">
                <span>: ข้อมูลส่วนตัว <?php echo $member['Mem_fname'] . ' ' . $member['Mem_lname']; ?> </span>
            </header>

            <div class="info_Member">
                <div class="info_Detail">
                    <div class="infoLeft">

                        <div class="row"><strong>รหัสสมาชิก:</strong> <?php echo $member['Mem_id'] ?? ''; ?></div>
                        <div class="row"><strong>ชื่อ:</strong> <?php echo $member['Mem_fname'] ?? ''; ?></div>
                        <div class="row"><strong>นามสกุล:</strong> <?php echo $member['Mem_lname'] ?? ''; ?></div>
                        <div class="row"><strong>เบอร์โทร:</strong> <?php echo $member['Mem_tel'] ?? ''; ?></div>
                        <div class="row"><strong>ที่อยู่:</strong> <?php echo $member['Mem_address'] ?? ''; ?></div>
                        <div class="row"><strong>วันสมัครสมาชิก:</strong> <?php echo $member['Mem_day'] ?? ''; ?></div>
                        <div class="row"><strong>แต้มสะสม:</strong> <?php echo $member['Mem_stamp'] ?? 0; ?></div>
                        <div class="row"><strong>Username:</strong> <?php echo $member['Mem_username'] ?? ''; ?></div>
                    </div>

                    <div class="infoRight">
                        <p><strong>รูปโปรไฟล์</strong></p>
                        <img src="<?php echo $member['Mem_image']; ?> " alt="รูปสมาชิก" id="profileImg">
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>