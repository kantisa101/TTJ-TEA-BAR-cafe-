<?php
require_once('script/script.php');
$db_handle = new myDBControl();

$st = $_REQUEST["st"];
if ($st=='add'){
    $Pid        = trim($_POST["Pid"]);
    $Pname      = trim($_POST["Pname"]);
    $PCatid     = trim($_POST["PCatid"]);
    $price      = trim($_POST["price"]);
    $status     = trim($_POST["status"]);
    $img        = "img/Product/".$Pid.".jpg";

    // var_dump($tel);
    // exit();

    // ตรวจสอบว่าค่าต่างๆ ไม่เป็นค่าว่าง
    if (
        empty($_POST["Pid"]) || empty($_POST["Pname"]) || empty($_POST["PCatid"]) ||
        empty($_POST["price"]) || empty($_POST["status"])
    ) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบทุกช่อง'); window.history.back();</script>";
        exit();
    }

    // ตรวจสอบรูปแบบของรหัสสมาชิก (ต้องเป็นตัวเลข 8 หลัก)
    if (!preg_match("/^[A-Za-z0-9]{1,8}$/", $Pid)) {
        echo "<script>alert('รหัสสินค้าต้องเป็นตัวอักษรหรือตัวเลข และไม่เกิน 8 ตัว'); window.history.back();</script>";
        exit();
    }

    // ตรวจสอบซ้ำว่า Member ID หรือ Username ซ้ำหรือไม่
    $tcheck     = "SELECT * FROM Product WHERE (Product_id = '$Pid')";
    $check      =$db_handle->Textquery($tcheck);

    if (empty($check)) {
        $tquery = "INSERT INTO Product VALUES('$Pid', '$Pname', '$PCatid ', '$price', '$status', '$img')";
        $check      =$db_handle->Execquery($tquery);

        //สร้างแหล่งที่จะ upload file เข้าไปเก็บ
        if (isset($_FILES['Product_picture']) && $_FILES['Product_picture']['error'] == 0) {
            move_uploaded_file($_FILES['Product_picture']['tmp_name'], $img);
        } else {
            echo "<script>alert('ไม่พบ Image file หรือเกิดข้อผิดพลาดในการอัปโหลด');</script>";
        }

        echo "<script type='text/javascript'>";
        echo "alert('สินค้ารหัส " . $Pid . " ได้ถูกบันทึกข้อมูลแล้ว');";
        echo "window.location = 'product.php';";
        echo "</script>";
    }else{
        echo "<script type='text/javascript'>";
        echo "alert('ข้อมูลสินค้ามีอยู่แล้ว');";
        echo "window.history.back();";
        echo "</script>";
    }

    // //สร้างแหล่งที่จะ upload file เข้าไปเก็บ
    // if (isset($_FILES['ProImg'])) {
    //     //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์ => Host
    //     move_uploaded_file($_FILES['ProImg']['tmp_name'], $img);
    // } else {
    //     echo "<script type='text/javascript'>";
    //     echo "alert('ไม่พบ Image file " . $_FILES['ProImg']['name'] . "');";
    //     echo "</script>";
    // }
}

if ($st == 'edit'){
    $Pid        = trim($_POST["Pid"]);
    $Pname      = $_POST["Pname"];
    $PCatid      = $_POST["PCatid"];
    $price        = $_POST["price"];
    $status      = $_POST["status"];
    $img        = "img/Product/".$Pid.".jpg";

    $tquery     = "UPDATE Product SET 
        Product_id      ='$Pid',
        Product_name  ='$Pname',
        Category_id   ='$PCatid',
        Product_price   ='$price',
        Product_status   ='$status'
    WHERE (Product_id  = '$Pid')";
    echo $tquery;
    $UpData      =$db_handle->Execquery($tquery);

    //สร้างแหล่งที่จะ upload file เข้าไปเก็บ
    if (isset($_FILES['Product_picture']) && $_FILES['Product_picture']['error'] == 0) {
        move_uploaded_file($_FILES['Product_picture']['tmp_name'], $img);
    }

    echo "<script type='text/javascript'>";
    echo "alert('สินค้ารหัส " . $Pid . " ได้บันทึกข้อมูล');";
    echo "window.location = 'product.php';";
    echo "</script>";
}

if ($st == 'del') {
    $Pid        = $_GET["Product_id"];
    $img = "img/Product/" . $Pid . ".jpg";
    unlink($img); //ลบไฟล์เดิมก่อน    
    
    $tquery = "DELETE FROM Product WHERE (Product_id = '$Pid')";
    echo $tquery;
    $delData    = $db_handle->Execquery($tquery);
    echo "<script type='text/javascript'>";
    echo "alert('สินค้ารหัส " . $Pid . " ได้ถูกลบข้อมูลแล้ว');";
    echo "window.location = 'product.php';";
    echo "</script>";
}
?>