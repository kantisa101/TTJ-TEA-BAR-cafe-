<?php
session_start();

if(isset($_SESSION['status'])) {
    if($_SESSION["status"]=='3') {
    $id     =$_SESSION['id'];
    $fname  =$_SESSION['Fname'];
    }else{
        echo "<script type='text/javascript'>";
        echo "alert('คุณไม่ได้เป็นสมาชิก!!!!');";
        echo "window.location = 'login.php';";
        echo "</script>";
    }
} else{
    echo "<script type='text/javascript'>";
    echo "alert('คุณไม่มีสิทธิ์เข้าทำงาน!!!!');";
    echo "window.location = 'login.php';";
    echo "</script>";
}

?>