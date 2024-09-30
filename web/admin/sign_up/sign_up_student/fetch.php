<?php
include('../../home_admin/config.php');
if (!empty($_POST['ma_khoa'])) {
    $ma_khoa = $_POST['ma_khoa'];

    // Lấy các ngành dựa trên mã khoa
    $sql_nganh = "SELECT * FROM nganh WHERE ma_khoa = '$ma_khoa'";  
    $result_nganh = mysqli_query($conn, $sql_nganh);

    $out = '<option value="">Chọn ngành</option>'; 

    while ($row = mysqli_fetch_assoc($result_nganh)) {   
        $out .= '<option value="' . $row['ma_nganh'] . '">' . $row['ten_nganh'] . '</option>';  
    }

    echo $out;
}
elseif (!empty($_POST['ma_nganh'])) {
    $ma_nganh = $_POST['ma_nganh'];

    // Lấy các ngành dựa trên mã khoa
    $sql_chuyen_nganh = "SELECT * FROM chuyen_nganh WHERE ma_nganh = '$ma_nganh'";  
    $result_chuyen_nganh = mysqli_query($conn, $sql_chuyen_nganh);

    $out = '<option value="">Chọn chuyên ngành</option>'; 

    while ($row = mysqli_fetch_assoc($result_chuyen_nganh)) {   
        $out .= '<option value="' . $row['ma_chuyen_nganh'] . '">' . $row['ten_chuyen_nganh'] . '</option>';  
    }

    echo $out;
}
elseif (!empty($_POST['ma_chuyen_nganh'])) {
    $ma_chuyen_nganh = $_POST['ma_chuyen_nganh'];

    // Lấy các ngành dựa trên mã khoa
    $sql_lop = "SELECT * FROM lop WHERE ma_chuyen_nganh = '$ma_chuyen_nganh'";  
    $result_lop = mysqli_query($conn, $sql_lop);

    $out = '<option value="">Chọn lớp</option>'; 

    while ($row = mysqli_fetch_assoc($result_lop)) {   
        $out .= '<option value="' . $row['ma_lop'] . '">' . $row['ma_lop'] . '</option>';  
    }

    echo $out;
}
?>
