<?php
header('Content-Type: application/json; charset=utf-8');
include('db_connect.php');

// รับข้อมูล JSON
$data = json_decode(file_get_contents("php://input"), true);

// ตรวจสอบข้อมูลที่ส่งมา
if (!$data) {
    echo json_encode(["success" => false, "message" => "ไม่มีข้อมูลที่ส่งมา"], JSON_UNESCAPED_UNICODE);
    exit();
}

if (!isset($data["Sales_datetime"], $data["Mem_id"], $data["Sales_discount"], $data["Sales_total"], $data["Sales_Payment_channels"], $data["Emp_id"], $data["Products"])) {
    echo json_encode(["success" => false, "message" => "ข้อมูลไม่ครบ"], JSON_UNESCAPED_UNICODE);
    exit();
}

// สร้างใบเสร็จตามวันที่ขาย+รหัสสมาชิก+Random เช่น S21062025MB0061
$datePart = date("dmY", strtotime($data["Sales_datetime"])); //ดึงวันที่ขาย (Sales_datetime) แล้วแปลงให้อยู่ในรูปแบบ วันเดือนปี เช่น 21062025
$Mem_id = $data["Mem_id"]; //ดึงรหัสสมาชิกจาก $data เช่น MB00
$prefix = "S{$datePart}{$Mem_id}"; //สร้าง prefix ของรหัสใบเสร็จ เช่น S21062025MB00 โดยยังไม่รวมเลขรัน

// ดึง Sales_id ล่าสุดที่ตรง prefix นี้
$sql = "SELECT Sales_id FROM Sales WHERE Sales_id LIKE ? ORDER BY Sales_id DESC LIMIT 1"; //คำสั่ง SQL นี้จะค้นหา Sales_id ที่ขึ้นต้นด้วย prefix นั้น (เช่น S21062025MB00%) แล้วเรียงจากมากไปน้อย (ORDER BY ... DESC) เอาเฉพาะตัวล่าสุด (LIMIT 1)
$stmt = $conn->prepare($sql);
$stmt->execute(["{$prefix}%"]);
$lastIdRow = $stmt->fetch(PDO::FETCH_ASSOC); 

// คำนวณเลขรัน
if ($lastIdRow) {
    // แยกเลขรันสุดท้ายจาก Sales_id เดิม เช่น S21062025MB0013
    $lastRunNumber = (int)substr($lastIdRow['Sales_id'], strlen($prefix));
    $nextRun = $lastRunNumber + 1;
} else {
    $nextRun = 1;
}

// สร้าง Sales_id ใหม่
$Sales_id = $prefix . $nextRun;


$Sales_datetime = $data["Sales_datetime"];
$Mem_id = $data["Mem_id"];
$Sales_discount = $data["Sales_discount"];
$Sales_total = $data["Sales_total"];
$Sales_Payment_channels = $data["Sales_Payment_channels"];
$Emp_id = $data["Emp_id"];
$Pmo_id = isset($data["Pmo_id"]) ? $data["Pmo_id"] : "ไม่ระบุโปรโมชั่น";
$num = 0;

try {
    $conn->beginTransaction();

    // บันทึกลงตาราง Sales
    $sql = "INSERT INTO Sales (Sales_id, Sales_datetime, Mem_id, Sales_discount, Sales_total, Sales_Payment_channels, Emp_id, Pmo_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$Sales_id, $Sales_datetime, $Mem_id, $Sales_discount, $Sales_total, $Sales_Payment_channels, $Emp_id, $Pmo_id]);

    // บันทึกสินค้ารายการขาย
    $sqlDetail = "INSERT INTO SalesList (Sales_id, Product_id, Quantity, Price) VALUES (?, ?, ?, ?)";
    $stmtDetail = $conn->prepare($sqlDetail);
    foreach ($data["Products"] as $product) {
        $stmtDetail->execute([$Sales_id, $product["Product_id"], $product["Quantity"], $product["Price"]]);
        // ตรวจสอบว่าเป็นเครื่องดื่ม ถ้าไม่เป็นก็ไม่นับ ถ้าเป็นต้องนับ
        if (strpos($product["Product_id"], "P") === 0) {
            $num++;
        }
    }

    // แก้ไข ยอดจำนวนแก้สะสมของสมาชิก
    $sql1 = "UPDATE Member SET Mem_stamp = Mem_stamp + ? WHERE Mem_id = ? ";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute([$num, $Mem_id]);


    $conn->commit();
    echo json_encode(["success" => true, "message" => "บันทึกข้อมูลสำเร็จ", "Sales_id" => $Sales_id], JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode(["success" => false, "message" => "บันทึกข้อมูลไม่สำเร็จ: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
