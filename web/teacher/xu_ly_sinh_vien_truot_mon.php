<?php
include('../home/home/config.php');

$sql_diem = "SELECT ma_hoc_phan, msv, diem_tb_10 FROM diem_hoc_phan";
$result_diem = $conn->query($sql_diem);

if ($result_diem->num_rows > 0) {
    while ($row = $result_diem->fetch_assoc()) {
        $ma_hoc_phan = $row["ma_hoc_phan"];
        $msv = $row["msv"];
        $diem_tb_10 = $row["diem_tb_10"];

        if ($diem_tb_10 < 4) {
            $sql_truot = "SELECT ma_hoc_phan, msv FROM sinh_vien_truot_mon WHERE ma_hoc_phan = '$ma_hoc_phan' AND msv = '$msv'";
            $result_truot = $conn->query($sql_truot);
            if ($result_truot->num_rows > 0) {
            } else{
                $sql_diem_liet = "INSERT INTO sinh_vien_truot_mon (ma_hoc_phan, msv) VALUES ('$ma_hoc_phan', '$msv')";
                $conn->query($sql_diem_liet);
            }
        }
        elseif ($diem_tb_10 >= 4) {
            $sql_xoa_sinh_vien = "DELETE FROM sinh_vien_truot_mon WHERE msv = '$msv' AND ma_hoc_phan = '$ma_hoc_phan'";
            // Thực thi câu truy vấn DELETE
            if ($conn->query($sql_xoa_sinh_vien) === TRUE) {
            } else {
                echo "Lỗi khi xóa sinh viên có msv: $msv: " . $conn->error . "<br>";
            }
        }
    }
}
?>