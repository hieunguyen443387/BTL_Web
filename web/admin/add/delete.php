<?php

include('../home_admin/config.php');

if (isset($_GET['ma_khoa'])) {
    $ma_khoa = $_GET['ma_khoa'];

    $sql_delete = "DELETE FROM khoa WHERE ma_khoa = '$ma_khoa'";

    if ($conn->query($sql_delete) === TRUE) {
        
        header("Location: khoa.php");
        exit();
    } else {
        echo "Lỗi khi xóa khoa: " . $conn->error;
    }
}

if (isset($_GET['ma_nganh'])) {
    $ma_nganh = $_GET['ma_nganh'];

    $sql_delete = "DELETE FROM nganh WHERE ma_nganh = '$ma_nganh'";

    if ($conn->query($sql_delete) === TRUE) {
        
        header("Location: /web/admin/add/nganh.php");
        exit();
    } else {
        echo "Lỗi khi xóa nganh: " . $conn->error;
    }
} 

if (isset($_GET['ma_chuyen_nganh'])) {
    $ma_chuyen_nganh = $_GET['ma_chuyen_nganh'];

    $sql_delete = "DELETE FROM chuyen_nganh WHERE ma_chuyen_nganh = '$ma_chuyen_nganh'";

    if ($conn->query($sql_delete) === TRUE) {
        
        header("Location: /web/admin/add/chuyen_nganh.php");
        exit();
    } else {
        echo "Lỗi khi xóa chuyen nganh: " . $conn->error;
    }
} 

if (isset($_GET['ma_hoc_phan'])) {
    $ma_hoc_phan = $_GET['ma_hoc_phan'];

    $sql_delete = "DELETE FROM hoc_phan WHERE ma_hoc_phan = '$ma_hoc_phan'";

    if ($conn->query($sql_delete) === TRUE) {
        
        header("Location: /web/admin/add/hoc_phan.php");
        exit();
    } else {
        echo "Lỗi khi xóa chuyen nganh: " . $conn->error;
    }
} 

if (isset($_GET['ma_lop'])) {
    $ma_lop = $_GET['ma_lop'];

    $sql_delete = "DELETE FROM lop WHERE ma_lop = '$ma_lop'";

    if ($conn->query($sql_delete) === TRUE) {
        
        header("Location: /web/admin/add/lop.php");
        exit();
    } else {
        echo "Lỗi khi xóa chuyen nganh: " . $conn->error;
    }
} 

?>
