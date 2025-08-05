<?php
require_once('script/script.php');
$db_handle = new myDBControl();

$st = $_REQUEST["st"];
if ($st == 'add') {
    $MBid     = trim($_POST["MBid"]);
    $fname    = trim($_POST["fname"]);
    $lname    = trim($_POST["lname"]);
    $tel      = trim($_POST["tel"]);
    $address  = trim($_POST["address"]);
    $Memday   = trim($_POST["Memday"]);
    $stamp    = trim($_POST["Mem_stamp"]);
    $un       = trim($_POST["Mem_username"]);
    $pw       = trim($_POST["Mem_password"]);
    $img      = "img/Mem/" . $MBid . ".jpg";

    // var_dump($tel);
    // exit();
    $tel = preg_replace("/[^0-9]/", "", $_POST["tel"]); // รับเฉพาะตัวเลข

    // ตรวจสอบว่าค่าต่างๆ ไม่เป็นค่าว่าง
    if (
        empty($_POST["MBid"]) || empty($_POST["fname"]) || empty($_POST["lname"]) ||
        empty($_POST["tel"]) || empty($_POST["address"]) || empty($_POST["Memday"]) ||
        empty($_POST["Mem_username"]) || empty($_POST["Mem_password"])
    ) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบทุกช่อง'); window.history.back();</script>";
        exit();
    }

    // ตรวจสอบรูปแบบของรหัสสมาชิก (ต้องเป็นตัวเลข 8 หลัก)
    if (!preg_match("/^[A-Za-z0-9]{1,8}$/", $MBid)) {
        echo "<script>alert('รหัสสมาชิกต้องเป็นตัวอักษรหรือตัวเลข และไม่เกิน 8 ตัว'); window.history.back();</script>";
        exit();
    }

    // ตรวจสอบรูปแบบของเบอร์โทรศัพท์ (ต้องเป็นตัวเลข 10 หลัก)
    if (!preg_match("/^\d{10,20}$/", $tel)) {
        echo "<script>alert('เบอร์โทรต้องเป็นตัวเลข และมีความยาวระหว่าง 10-20 ตัวอักษร'); window.history.back();</script>";
        exit();
    }

    // // ตรวจสอบความยาวของรหัสผ่าน (ต้องมีอย่างน้อย 8 ตัวอักษร)
    if (strlen($pw) < 5 || strlen($pw) > 10) {
        echo "<script>alert('รหัสผ่านต้องมีระหว่าง 5-10 ตัวอักษร'); window.history.back();</script>";
        exit();
    }

    // ตรวจสอบซ้ำว่า Member ID หรือ Username ซ้ำหรือไม่
    $tcheck = "SELECT * FROM Member WHERE Mem_id = '$MBid' OR Mem_username = '$un'";
    $check = $db_handle->Textquery($tcheck);

    if (!empty($check)) {
        echo "<script>alert('รหัสสมาชิกหรือชื่อผู้ใช้นี้มีอยู่แล้วในระบบ'); window.history.back();</script>";
        exit();
    }

    // เพิ่มข้อมูลลงฐานข้อมูล
    $tquery = "INSERT INTO Member VALUES('$MBid', '$fname', '$lname', '$tel', '$address', '$Memday', '$stamp', '$un', '$pw', '$img')";
    $result = $db_handle->Execquery($tquery);

    //สร้างแหล่งที่จะ upload file เข้าไปเก็บ
        if (isset($_FILES['Mem_image']) && $_FILES['Mem_image']['error'] == 0) {
            move_uploaded_file($_FILES['Mem_image']['tmp_name'], $img);
        } else {
            echo "<script>alert('ไม่พบ Image file หรือเกิดข้อผิดพลาดในการอัปโหลด');</script>";
        }


    echo "<script>alert('สมาชิกรหัส $MBid ได้ถูกบันทึกข้อมูลแล้ว'); window.location = 'manageMember.php';</script>";
    exit();
}

if ($st == 'edit') {
    $MBid        = trim($_POST["MBid"]);
    $fname      = $_POST["fname"];
    $lname      = $_POST["lname"];
    $tel        = $_POST["tel"];
    $address      = $_POST["address"];
    $Memday        = $_POST["Memday"];
    $stamp        = $_POST["Mem_stamp"];
    $un         = $_POST["un"];
    $pw         = $_POST["pw"];
    $img        = "img/Mem/" . $MBid . ".jpg";

    $tquery     = "UPDATE Member SET 
        Mem_id     ='$MBid',
        Mem_fname  ='$fname',
        Mem_lname   ='$lname',
        Mem_tel     ='$tel',
        Mem_address      ='$address',
        Mem_day      ='$Memday',
        Mem_stamp      ='$stamp'
    WHERE (Mem_id  = '$MBid')";
    echo $tquery;
    $UpData      = $db_handle->Execquery($tquery);

    //สร้างแหล่งที่จะ upload file เข้าไปเก็บ
    if (isset($_FILES['Mem_image']) && $_FILES['Mem_image']['error'] == 0) {
        move_uploaded_file($_FILES['Mem_image']['tmp_name'], $img);
    }

    echo "<script type='text/javascript'>";
    echo "alert('สมาชิกรหัส " . $MBid . " ได้บันทึกข้อมูล');";
    echo "window.location = 'manageMember.php';";
    echo "</script>";
}

if ($st == 'del') {
    $MBid        = $_GET["Mem_id"];
    $img = "img/Mem/" . $MBid . ".jpg";
    unlink($img); //ลบไฟล์เดิมก่อน    

    $tquery = "DELETE FROM Member WHERE (Mem_id = '$MBid')";
    echo $tquery;
    $delData    = $db_handle->Execquery($tquery);
    echo "<script type='text/javascript'>";
    echo "alert('สมาชิกรหัส " . $MBid . " ได้ถูกลบข้อมูลแล้ว');";
    echo "window.location = 'manageMember.php';";
    echo "</script>";
}
