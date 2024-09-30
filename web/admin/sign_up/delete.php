<?php

include('../home_admin/config.php');

if (isset($_GET['mgv'])) {
    $mgv = $_GET['mgv'];

    $sql_delete = "DELETE FROM giang_vien WHERE mgv = '$mgv'";

    if ($conn->query($sql_delete) === TRUE) {
        
        header("Location: /web/admin/sign_up/sign_up_teacher/quan_ly_giang_vien.php");
        exit();
    } else {
        echo "Lỗi khi xóa giảng viên: " . $conn->error;
    }
} 

if (isset($_GET['msv'])) {
    $msv = $_GET['msv'];

    $sql_delete = "DELETE FROM sinh_vien WHERE msv = '$msv'";

    if ($conn->query($sql_delete) === TRUE) {
        
        header("Location: /web/admin/sign_up/sign_up_student/quan_ly_sinh_vien.php");
        exit();
    } else {
        echo "Lỗi khi xóa giảng viên: " . $conn->error;
    }
}

if (isset($_GET['id_admin'])) {
    $id_admin = $_GET['id_admin'];

    $sql_delete = "DELETE FROM admin WHERE id_admin = '$id_admin'";

    if ($conn->query($sql_delete) === TRUE) {
        
        header("Location: /web/admin/sign_up/sign_up_admin/quan_ly_admin.php");
        exit();
    } else {
        echo "Lỗi khi xóa : " . $conn->error;
    }
}
?>
