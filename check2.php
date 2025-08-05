<?php
session_start();

if(isset($_SESSION['status'])) {
    if($_SESSION["status"]=='1' || $_SESSION["status"]=='2') {
    $id     =$_SESSION['id'];
    $fname  =$_SESSION['Fname'];
    }else{
        echo "<script type='text/javascript'>";
        echo "alert('คุณไม่ได้เป็นเจ้าของ/พนักงาน!!!!');";
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