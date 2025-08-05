<?php
require_once('script/script.php');
$db_handle = new myDBControl();

$st = $_REQUEST["st"];
if ($st == 'add') {
    // รับค่าจากฟอร์ม
    $Detail_id = trim($_POST["Detail_id"]);
    $Detail_topic = trim($_POST["Detail_topic"]);
    $Detail_info = trim($_POST["Detail_info"]);
    $Detail_address = trim($_POST["Detail_address"]);
    $Detail_tel = trim($_POST["Detail_tel"]);

    $Detail_tel = preg_replace("/[^0-9]/", "", $_POST["Detail_tel"]); // รับเฉพาะตัวเลข

    // ตรวจสอบว่าค่าต่างๆ ไม่เป็นค่าว่าง
    if (
        empty($_POST["Detail_id"]) || empty($_POST["Detail_topic"]) || empty($_POST["Detail_info"]) ||
        empty($_POST["Detail_address"]) || empty($_POST["Detail_tel"])
    ) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบทุกช่อง'); window.history.back();</script>";
        exit();
    }

    // ตรวจสอบรูปแบบของรหัสสมาชิก (ต้องเป็นตัวเลข 8 หลัก)
    if (!preg_match("/^[A-Za-z0-9]{1,8}$/", $Detail_id)) {
        echo "<script>alert('รหัสข้อมูลประชาสัมพันธ์ต้องเป็นตัวอักษรหรือตัวเลข และไม่เกิน 8 ตัว'); window.history.back();</script>";
        exit();
    }

    // ตรวจสอบรูปแบบของเบอร์โทรศัพท์ (ต้องเป็นตัวเลข 10 หลัก)
    if (!preg_match("/^\d{10,20}$/", $Detail_tel)) {
        echo "<script>alert('เบอร์โทรต้องเป็นตัวเลข และมีความยาวระหว่าง 10-20 ตัวอักษร'); window.history.back();</script>";
        exit();
    }


    // เตรียม path สำหรับรูปภาพ
    $folder = "img/Detail/";
    $banner1 = $folder . $Detail_id . "1.jpg";
    $banner2 = $folder . $Detail_id . "2.jpg";
    $banner3 = $folder . $Detail_id . "3.jpg";

    $uploadSuccess = true;

    // อัปโหลดรูปภาพที่ 1
    if (isset($_FILES['Detail_image1']) && $_FILES['Detail_image1']['error'] == 0) {
        $uploadSuccess = $uploadSuccess && move_uploaded_file($_FILES['Detail_image1']['tmp_name'], $banner1);
    }

    // อัปโหลดรูปภาพที่ 2
    if (isset($_FILES['Detail_image2']) && $_FILES['Detail_image2']['error'] == 0) {
        $uploadSuccess = $uploadSuccess && move_uploaded_file($_FILES['Detail_image2']['tmp_name'], $banner2);
    }

    // อัปโหลดรูปภาพที่ 3
    if (isset($_FILES['Detail_image3']) && $_FILES['Detail_image3']['error'] == 0) {
        $uploadSuccess = $uploadSuccess && move_uploaded_file($_FILES['Detail_image3']['tmp_name'], $banner3);
    }

    // ตรวจสอบว่ารหัสนี้ยังไม่มีในฐานข้อมูล
    $checkQuery = "SELECT * FROM DetailTTJ_T_BAR WHERE Detail_id = '$Detail_id'";
    $check = $db_handle->Textquery($checkQuery);

    if (empty($check)) {
        // ถ้ารหัสยังไม่ซ้ำ และอัปโหลดรูปสำเร็จ
        if ($uploadSuccess) {
            $insertQuery = "INSERT INTO DetailTTJ_T_BAR 
                (Detail_id, Detail_topic, Detail_info, Detail_address, Detail_tel, 
                Detail_banner1, Detail_banner2, Detail_banner3) 
                VALUES (
                    '$Detail_id', '$Detail_topic', '$Detail_info', 
                    '$Detail_address', '$Detail_tel', 
                    '$banner1', '$banner2', '$banner3'
                )";

            $db_handle->Execquery($insertQuery);

            echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.location='DetailTTJTBAR.php';</script>";
        } else {
            echo "<script>alert('อัปโหลดรูปภาพไม่สำเร็จ กรุณาตรวจสอบไฟล์'); history.back();</script>";
        }
    } else {
        echo "<script>alert('มีรหัสนี้อยู่แล้วในระบบ'); history.back();</script>";
    }
}
if ($st == 'edit') {
    // รับค่าจากฟอร์ม
    $Detail_id = trim($_POST["Detail_id"]);
    $Detail_topic = htmlspecialchars($_POST["Detail_topic"], ENT_QUOTES);
    $Detail_info = htmlspecialchars($_POST["Detail_info"], ENT_QUOTES);
    $Detail_address = htmlspecialchars($_POST["Detail_address"], ENT_QUOTES);
    $Detail_tel = htmlspecialchars($_POST["Detail_tel"], ENT_QUOTES);

    // ดึงข้อมูลเก่าเพื่อลบรูปเดิม (ถ้ามี)
    $oldQuery = "SELECT * FROM DetailTTJ_T_BAR WHERE Detail_id = '$Detail_id'";
    $oldData = $db_handle->Textquery($oldQuery);

    if (!empty($oldData)) {
        $old = $oldData[0]; // เก็บข้อมูลรูปเดิม

        // เตรียม path สำหรับรูปใหม่
        $folder = "img/Detail/";
        $banner1 = $folder . $Detail_id . "1.jpg";
        $banner2 = $folder . $Detail_id . "2.jpg";
        $banner3 = $folder . $Detail_id . "3.jpg";

        // อัปโหลดและลบรูปเก่า (เฉพาะเมื่อมีการอัปโหลดใหม่เข้ามา)
        if (isset($_FILES['Detail_image1']) && $_FILES['Detail_image1']['error'] == 0) {
            if (file_exists($old["Detail_banner1"])) unlink($old["Detail_banner1"]);
            move_uploaded_file($_FILES['Detail_image1']['tmp_name'], $banner1);
        } else {
            $banner1 = $old["Detail_banner1"]; // ใช้รูปเดิม
        }

        if (isset($_FILES['Detail_image2']) && $_FILES['Detail_image2']['error'] == 0) {
            if (file_exists($old["Detail_banner2"])) unlink($old["Detail_banner2"]);
            move_uploaded_file($_FILES['Detail_image2']['tmp_name'], $banner2);
        } else {
            $banner2 = $old["Detail_banner2"];
        }

        if (isset($_FILES['Detail_image3']) && $_FILES['Detail_image3']['error'] == 0) {
            if (file_exists($old["Detail_banner3"])) unlink($old["Detail_banner3"]);
            move_uploaded_file($_FILES['Detail_image3']['tmp_name'], $banner3);
        } else {
            $banner3 = $old["Detail_banner3"];
        }

        // อัปเดตฐานข้อมูล
        $updateQuery = "UPDATE DetailTTJ_T_BAR SET 
            Detail_topic = '$Detail_topic',
            Detail_info = '$Detail_info',
            Detail_address = '$Detail_address',
            Detail_tel = '$Detail_tel',
            Detail_banner1 = '$banner1',
            Detail_banner2 = '$banner2',
            Detail_banner3 = '$banner3'
        WHERE Detail_id = '$Detail_id'";

        $db_handle->Execquery($updateQuery);

        echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว'); window.location='DetailTTJTBAR.php';</script>";
    } else {
        echo "<script>alert('ไม่พบรหัสนี้ในระบบ'); history.back();</script>";
    }
}



// if ($st == 'del') {
//     $Detail_id        = $_GET["Detail_id"];
//     $Detail_banner1 = "img/Detail/" . $Detail_id . ".png";
//     $Detail_banner2 = "img/Detail/" . $Detail_id . ".png";
//     $Detail_banner3 = "img/Detail/" . $Detail_id . ".png";
//     unlink($Detail_banner1); //ลบไฟล์เดิมก่อน    
//     unlink($Detail_banner2); //ลบไฟล์เดิมก่อน    
//     unlink($Detail_banner3); //ลบไฟล์เดิมก่อน    

//     $tquery = "DELETE FROM DetailTTJ_T_BAR WHERE (Detail_id = '$Detail_id')";
//     echo $tquery;
//     $delData    = $db_handle->Execquery($tquery);
//     echo "<script type='text/javascript'>";
//     echo "alert('ข้อมูลประชาสัมพันธ์รหัส " . $Detail_id . " ได้ถูกลบข้อมูลแล้ว');";
//     echo "window.location = 'DetailTTJTBAR.php';";
//     echo "</script>";
// }
