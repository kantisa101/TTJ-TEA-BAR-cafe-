<?php
session_start();

require_once('script/script.php');
$db_handle = new myDBControl();

$un = $_POST['Uname'];
$pw = $_POST['Passwd'];

// ตรวจสอบข้อมูลการล็อกอินจากตาราง login_data
$data_employee = $db_handle->Textquery("SELECT * FROM LOGIN_DATA WHERE Emp_username = '$un' AND Emp_password = '$pw';");

if (empty($data_employee)) {
    echo "<script type='text/javascript'>";
    echo "alert('คุณไม่มีสิทธิ์เข้าทำงานในระบบ!!!!');";
    echo "window.location = 'login.php';";
    echo "</script>";
} else {
    $_SESSION['id'] = $data_employee[0]['Emp_id'];
    $_SESSION['fname'] = $data_employee[0]['Emp_fname'];
    $_SESSION['lname'] = $data_employee[0]['Emp_lname'];
    $_SESSION['status'] = $data_employee[0]['Emp_status'];
    if ($_SESSION['status'] == '1') {
        echo "<script type='text/javascript'>";
        echo "alert('สวัสดีคุณเจ้าของ " . $data_employee[0]['Emp_fname'] . "');";
        echo "window.location = 'manager.php';";
        echo "</script>";
    } else {
        if ($_SESSION['status'] == '2') {
            echo "<script type='text/javascript'>";
            echo "alert('สวัสดีคุณพนักงาน " . $data_employee[0]['Emp_fname'] . "');";
            echo "window.location = 'manageMember.php';";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('สวัสดีคุณสมาชิก " . $data_employee[0]['Emp_fname'] . "');";
            echo "window.location = 'Memberpersonal.php';";
            echo "</script>";
        }
    }
}
?>