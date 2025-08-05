<?php
require_once('script/script.php');
$db_handle = new myDBControl();

$st = $_REQUEST["st"];
if ($st == 'add') {
    $EMPid        = trim($_POST["EMPid"]);
    $fname        = trim($_POST["fname"]);
    $lname        = trim($_POST["lname"]);
    $tel          = trim($_POST["tel"]);
    $address      = trim($_POST["address"]);
    $status       = trim($_POST["status"]);
    $un           = trim($_POST["un"]);
    $pw           = trim($_POST["pw"]);
    $img          = "img/Emp/" . $EMPid . ".jpg";

    // var_dump($tel);
    // exit();
    $tel = preg_replace("/[^0-9]/", "", $_POST["tel"]); // รับเฉพาะตัวเลข

    // ตรวจสอบว่าค่าต่างๆ ไม่เป็นค่าว่าง
    if (
        empty($_POST["EMPid"]) || empty($_POST["fname"]) || empty($_POST["lname"]) ||
        empty($_POST["tel"]) || empty($_POST["address"]) || empty($_POST["status"]) ||
        empty($_POST["un"]) || empty($_POST["pw"])
    ) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบทุกช่อง'); window.history.back();</script>";
        exit();
    }

    // ตรวจสอบรูปแบบของรหัสสมาชิก (ต้องเป็นตัวเลข 8 หลัก)
    if (!preg_match("/^[A-Za-z0-9]{1,8}$/", $EMPid)) {
        echo "<script>alert('รหัสพนักงานต้องเป็นตัวอักษรหรือตัวเลข และไม่เกิน 8 ตัว'); window.history.back();</script>";
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

    $tcheck     = "SELECT * FROM Employee WHERE (Emp_id = '$EMPid' AND Emp_username = '$un' AND Emp_password = '$pw')";
    $check      = $db_handle->Textquery($tcheck);

    if (empty($check)) {
        $tquery = "INSERT INTO Employee VALUES('$EMPid', '$fname', '$lname ', '$tel', '$address', '$status','$img','$un', '$pw')";
        $check      = $db_handle->Execquery($tquery);

        //สร้างแหล่งที่จะ upload file เข้าไปเก็บ
        if (isset($_FILES['Emp_image']) && $_FILES['Emp_image']['error'] == 0) {
            move_uploaded_file($_FILES['Emp_image']['tmp_name'], $img);
        } else {
            echo "<script>alert('ไม่พบ Image file หรือเกิดข้อผิดพลาดในการอัปโหลด');</script>";
        }

        echo "<script type='text/javascript'>";
        echo "alert('พนักงานรหัส " . $EMPid . " ได้ถูกบันทึกข้อมูลแล้ว');";
        echo "window.location = 'manager.php';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('ข้อมูลพนักงานมีอยู่แล้ว');";
        echo "window.history.back();";
        echo "</script>";
    }
}

if ($st == 'edit') {
    $EMPid        = trim($_POST["EMPid"]);
    $fname      = $_POST["fname"];
    $lname      = $_POST["lname"];
    $tel        = $_POST["tel"];
    $address      = $_POST["address"];
    $status        = $_POST["status"];
    $un         = $_POST["un"];
    $pw         = $_POST["pw"];
    $img        = "img/Emp/" . $EMPid . ".jpg";

    $tquery     = "UPDATE Employee SET 
        Emp_id     ='$EMPid',
        Emp_fname  ='$fname',
        Emp_lname   ='$lname',
        Emp_tel     ='$tel',
        Emp_address      ='$address',
        Emp_status      ='$status'
    WHERE (Emp_id  = '$EMPid')";
    echo $tquery;
    $UpData      = $db_handle->Execquery($tquery);

    //สร้างแหล่งที่จะ upload file เข้าไปเก็บ
    if (isset($_FILES['Emp_image']) && $_FILES['Emp_image']['error'] == 0) {
        move_uploaded_file($_FILES['Emp_image']['tmp_name'], $img);
    }

    echo "<script type='text/javascript'>";
    echo "alert('พนักงานรหัส " . $EMPid . " ได้บันทึกข้อมูล');";
    echo "window.location = 'manager.php';";
    echo "</script>";
}

if ($st == 'del') {
    $EMPid        = $_GET["Emp_id"];
    $img = "img/Emp/" . $EMPid . ".jpg";
    unlink($img); //ลบไฟล์เดิมก่อน    

    $tquery = "DELETE FROM Employee WHERE (Emp_id = '$EMPid')";
    echo $tquery;
    $delData    = $db_handle->Execquery($tquery);
    echo "<script type='text/javascript'>";
    echo "alert('พนักงานรหัส " . $EMPid . " ได้ถูกลบข้อมูลแล้ว');";
    echo "window.location = 'manager.php';";
    echo "</script>";
}
