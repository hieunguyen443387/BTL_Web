<?php

    if (!empty($_POST['diem_a']) || !empty($_POST['diem_b']) || !empty($_POST['diem_c'])) {

    $ma_hoc_phan = $_SESSION['ma_hoc_phan'];
    $ma_nhom = $_SESSION['ma_nhom'];
    $mgv = $_SESSION['mgv'];

    //Cập nhật điểm A
    
        foreach ($_POST['diem_a'] as $msv => $diem_a) {
            if ($diem_a !== '') {
            $sql_diem_a = "UPDATE diem_hoc_phan SET diem_a = '$diem_a' WHERE msv = '$msv' AND ma_hoc_phan = '$ma_hoc_phan'";
            $sql_diem_a_nhom = "UPDATE bang_diem_nhom SET diem_a = '$diem_a' WHERE msv = '$msv' AND ma_nhom = '$ma_nhom'";

            if (!$conn->query($sql_diem_a) || !$conn->query($sql_diem_a_nhom)) {
                echo "Lỗi: " . $conn->error . "<br>";
                }
            
            }
        }
    
    //Cập nhật điểm B
    
        foreach ($_POST['diem_b'] as $msv => $diem_b) {
            if ($diem_b !== '') {
            $sql_diem_b = "UPDATE diem_hoc_phan SET diem_b = '$diem_b' WHERE msv = '$msv' AND ma_hoc_phan = '$ma_hoc_phan'";
            $sql_diem_b_nhom = "UPDATE bang_diem_nhom SET diem_b = '$diem_b' WHERE msv = '$msv' AND ma_nhom = '$ma_nhom'";

            if (!$conn->query($sql_diem_b) || !$conn->query($sql_diem_b_nhom)) {
                echo "Lỗi: " . $conn->error . "<br>";
                }
            }
        }
    

    //Cập nhật điểm C
    
        foreach ($_POST['diem_c'] as $msv => $diem_c) {
            if ($diem_c !== '') {
            $sql_diem_c = "UPDATE diem_hoc_phan SET diem_c = '$diem_c' WHERE msv = '$msv' AND ma_hoc_phan = '$ma_hoc_phan'";
            $sql_diem_c_nhom = "UPDATE bang_diem_nhom SET diem_c = '$diem_c' WHERE msv = '$msv' AND ma_nhom = '$ma_nhom'";

            if (!$conn->query($sql_diem_c) || !$conn->query($sql_diem_c_nhom)) {
                echo "Lỗi: " . $conn->error . "<br>";
                    }
                }
            }
        
}

?>