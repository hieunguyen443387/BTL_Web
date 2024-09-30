<?php 
include('../home_admin/config.php');
if (!empty($_POST['ma_khoa'])) {
    $ma_khoa = $_POST['ma_khoa'];

    // Lấy các ngành dựa trên mã khoa
    $sql_lop = "SELECT * FROM danh_sach_lop_thuoc_khoa WHERE ma_khoa = '$ma_khoa'";  
    $result_lop = mysqli_query($conn, $sql_lop);

    $out = '<option value="">Chọn lớp</option>'; 

    while ($row = mysqli_fetch_assoc($result_lop)) {   
        $out .= '<option value="' . $row['ma_lop'] . '">' . $row['ma_lop'] . '</option>';  
    }

    echo $out;
}
elseif (!empty($_POST['ma_nganh'])) {
    $ma_nganh = $_POST['ma_nganh'];

    // Lấy các chuyên ngành dựa trên mã ngành
    $sql_lop = "SELECT * FROM danh_sach_lop_thuoc_nganh WHERE ma_nganh = '$ma_nganh'";  
    $result_lop = mysqli_query($conn, $sql_lop);

    $out = '<option value="">Chọn lớp</option>'; 

    while ($row = mysqli_fetch_assoc($result_lop)) {   
        $out .= '<option value="' . $row['ma_lop'] . '">' . $row['ma_lop'] . '</option>';  
    }

    echo $out;
}
?>