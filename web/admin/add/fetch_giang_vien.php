<?php 
include('../home_admin/config.php');
if (!empty($_POST['ma_khoa'])) {
    $ma_khoa = $_POST['ma_khoa'];

    // Lấy giảng viên dựa trên mã ngành
    $sql_giang_vien = "SELECT * FROM giang_vien WHERE ma_khoa = '$ma_khoa'";  
    $result_giang_vien = mysqli_query($conn, $sql_giang_vien);

    $out = '<option value="">Chọn giảng viên</option>'; 

    while ($row = mysqli_fetch_assoc($result_giang_vien)) {   
        $out .= '<option value="' . $row['mgv'] . '">' . $row['ho_dem'] . ' ' . $row['ten'] . '</option>';  
    }

    echo $out;
}
?>