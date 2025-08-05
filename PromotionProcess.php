<?php
require_once('script/script.php');
$db_handle = new myDBControl();

$st = $_REQUEST["st"];
if ($st=='add'){
    $Pmoid        = trim($_POST["Pmoid"]);
    $Pmoname      = trim($_POST["Pmoname"]);
    $Pmodes      = trim($_POST["Pmodes"]);
    $PmoStart        = trim($_POST["PmoStart"]);
    $PmoEnddate      = trim($_POST["PmoEnddate"]);
    $Pmocon        = trim($_POST["Pmocon"]);
    $Pmodiscount    =trim($_POST["Pmodiscount"]);

    // ตรวจสอบว่าค่าต่างๆ ไม่เป็นค่าว่าง
    if (
        empty($_POST["Pmoid"]) || empty($_POST["Pmoname"]) || empty($_POST["Pmodes"]) ||
        empty($_POST["PmoStart"]) || empty($_POST["PmoEnddate"]) || empty($_POST["Pmocon"]) || empty ($_POST["Pmodiscount"])
    ) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบทุกช่อง'); window.history.back();</script>";
        exit();
    }

    // ตรวจสอบรูปแบบของรหัสสมาชิก (ต้องเป็นตัวเลข 8 หลัก)
    if (!preg_match("/^[A-Za-z0-9]{1,8}$/", $Pmoid)) {
        echo "<script>alert('รหัสโปรโมชั่นต้องเป็นตัวอักษรหรือตัวเลข และไม่เกิน 8 ตัว'); window.history.back();</script>";
        exit();
    }

    $tcheck     = "SELECT * FROM Promotion WHERE (Pmo_id = '$Pmoid')";
    $check      =$db_handle->Textquery($tcheck);

    if (empty($check)) {
        $tquery = "INSERT INTO Promotion VALUES('$Pmoid', '$Pmoname', '$Pmodes ', '$PmoStart', '$PmoEnddate', '$Pmocon', '$Pmodiscount')";
        $check      =$db_handle->Execquery($tquery);
        echo "<script type='text/javascript'>";
        echo "alert('โปรโมชั่นรหัส " . $Pmoid . " ได้ถูกบันทึกข้อมูลแล้ว');";
        echo "window.location = 'Promotion.php';";
        echo "</script>";
    }else{
        echo "<script type='text/javascript'>";
        echo "alert('ข้อมูลโปรโมชั่นมีอยู่แล้ว');";
        echo "window.history.back();";
        echo "</script>";
    }
}

if ($st == 'edit'){
    $Pmoid        = trim($_POST["Pmoid"]);
    $Pmoname      = $_POST["Pmoname"];
    $Pmodes      = $_POST["Pmodes"];
    $PmoStart        = $_POST["PmoStart"];
    $PmoEnddate      = $_POST["PmoEnddate"];
    $Pmocon        = $_POST["Pmocon"];
    $Pmodiscount    =$_POST["Pmodiscount"];

    $tquery     = "UPDATE Promotion SET 
        Pmo_id     ='$Pmoid',
        Pmo_name  ='$Pmoname',
        Pmo_Description   ='$Pmodes',
        Pmo_startdate     ='$PmoStart',
        Pmo_Enddate      ='$PmoEnddate',
        Pmo_condition      ='$Pmocon',
        Pmo_discount        ='$Pmodiscount'
    WHERE (Pmo_id  = '$Pmoid')";
    echo $tquery;
    $UpData      =$db_handle->Execquery($tquery);

    echo "<script type='text/javascript'>";
    echo "alert('โปรโมชั่นรหัส " . $Pmoid . " ได้บันทึกข้อมูลแล้ว');";
    echo "window.location = 'Promotion.php';";
    echo "</script>";
}

if ($st == 'del') {
    $Pmoid        = $_GET["Pmo_id"];  
    
    $tquery = "DELETE FROM Promotion WHERE (Pmo_id = '$Pmoid')";
    echo $tquery;
    $delData    = $db_handle->Execquery($tquery);
    echo "<script type='text/javascript'>";
    echo "alert('โปรโมชั่นรหัส " . $Pmoid . " ได้ถูกลบข้อมูลแล้ว');";
    echo "window.location = 'Promotion.php';";
    echo "</script>";
}
?>