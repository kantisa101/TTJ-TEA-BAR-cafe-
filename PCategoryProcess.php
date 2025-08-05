<?php
require_once('script/script.php');
$db_handle = new myDBControl();

$st = $_REQUEST["st"];
if ($st == 'add') {
    $Catid        = trim($_POST["Catid"]);
    $Catname      = trim($_POST["Catname"]);
    $Catdes      = trim($_POST["Catdes"]);
    $img        = "img/ProCat/" . $Catid . ".jpg";

    // var_dump($tel);
    // exit();

    // ตรวจสอบว่าค่าต่างๆ ไม่เป็นค่าว่าง
    if (
        empty($_POST["Catid"]) || empty($_POST["Catname"]) || empty($_POST["Catdes"])
    ) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบทุกช่อง'); window.history.back();</script>";
        exit();
    }

    // ตรวจสอบรูปแบบของรหัสสมาชิก (ต้องเป็นตัวเลข 8 หลัก)
    if (!preg_match("/^[A-Za-z0-9]{1,8}$/", $Catid)) {
        echo "<script>alert('รหัสหมวดหมู่สินค้าต้องเป็นตัวอักษรหรือตัวเลข และไม่เกิน 8 ตัว'); window.history.back();</script>";
        exit();
    }


    // ตรวจสอบซ้ำว่า Member ID หรือ Username ซ้ำหรือไม่
    $tcheck     = "SELECT * FROM ProductCategory WHERE (Category_id = '$Catid')";
    $check      = $db_handle->Textquery($tcheck);

    if (empty($check)) {
        $tquery = "INSERT INTO ProductCategory VALUES('$Catid', '$Catname', '$Catdes','$img')";
        $check      = $db_handle->Execquery($tquery);

        //สร้างแหล่งที่จะ upload file เข้าไปเก็บ
        if (isset($_FILES['Category_picture']) && $_FILES['Category_picture']['error'] == 0) {
            move_uploaded_file($_FILES['Category_picture']['tmp_name'], $img);
        } else {
            echo "<script>alert('ไม่พบ Image file หรือเกิดข้อผิดพลาดในการอัปโหลด');</script>";
        }

        echo "<script type='text/javascript'>";
        echo "alert('หมวดหมู่สินค้ารหัส " . $Catid . " ได้ถูกบันทึกข้อมูลแล้ว');";
        echo "window.location = 'ProductCategory.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('ข้อมูลหมวดหมู่สินค้ามีอยู่แล้ว');";
        echo "window.history.back();";
        echo "</script>";
    }
}

if ($st == 'edit') {
    $Catid        = trim($_POST["Catid"]);
    $Catname      = $_POST["Catname"];
    $Catdes      = $_POST["Catdes"];
    $img        = "img/ProCat/" . $Catid . ".jpg";

    $tquery     = "UPDATE ProductCategory SET 
        Category_id      ='$Catid',
        Category_name  ='$Catname',
        Category_Description   ='$Catdes'
    WHERE (Category_id  = '$Catid')";
    echo $tquery;
    $UpData      = $db_handle->Execquery($tquery);

    //สร้างแหล่งที่จะ upload file เข้าไปเก็บ
    if (isset($_FILES['Category_picture']) && $_FILES['Category_picture']['error'] == 0) {
        move_uploaded_file($_FILES['Category_picture']['tmp_name'], $img);
    }

    echo "<script type='text/javascript'>";
    echo "alert('หมวดหมู่สินค้ารหัส " . $Catid . " ได้บันทึกข้อมูล');";
    echo "window.location = 'ProductCategory.php';";
    echo "</script>";
}

if ($st == 'del') {
    $Catid        = $_GET["Category_id"];
    $img = "img/ProCat/" . $Catid . ".jpg";
    unlink($img); //ลบไฟล์เดิมก่อน    

    $tquery = "DELETE FROM ProductCategory WHERE (Category_id = '$Catid')";
    echo $tquery;
    $delData    = $db_handle->Execquery($tquery);
    echo "<script type='text/javascript'>";
    echo "alert('หมวดหมู่สินค้ารหัส " . $Catid . " ได้ถูกลบข้อมูลแล้ว');";
    echo "window.location = 'ProductCategory.php';";
    echo "</script>";
}
