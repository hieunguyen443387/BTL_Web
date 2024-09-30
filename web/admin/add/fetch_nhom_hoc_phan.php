<?php 
include('../home_admin/config.php');
if (!empty($_POST['ma_nganh'])) {
    $ma_nganh = $_POST['ma_nganh'];

    // Lấy giảng viên dựa trên mã ngành
    $sql_hoc_phan = "SELECT ma_hoc_phan, ten_hoc_phan FROM hoc_phan WHERE ma_nganh = '$ma_nganh'";  
    $result_hoc_phan = mysqli_query($conn, $sql_hoc_phan);

    $out = '<option value="">Chọn học phần</option>'; 

    while ($row = mysqli_fetch_assoc($result_hoc_phan)) {   
        $out .= '<option value="' . $row['ma_hoc_phan'] . '">' . $row['ten_hoc_phan']  . '</option>';  
    }

    echo $out;
}
?>