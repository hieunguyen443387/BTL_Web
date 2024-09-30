<?php 
include('../home/home/config.php');

$sql_diem = "SELECT msv, ma_hoc_phan, diem_a, diem_b, diem_c FROM diem_hoc_phan";
$result_diem = $conn->query($sql_diem);

if ($result_diem->num_rows > 0) {
    
    while ($row = $result_diem->fetch_assoc()) {
        $msv = $row["msv"];
        $ma_hoc_phan = $row["ma_hoc_phan"];
        $diem_a = $row["diem_a"];
        $diem_b = $row["diem_b"];
        $diem_c = $row["diem_c"];
        $diem_tb_10 = $diem_a * 0.6 + $diem_b * 0.3 + $diem_c * 0.1;

        if ($diem_tb_10 >= 8.5 && $diem_tb_10 <= 10) {
            $diem_tb_chu = 'A';
            $diem_tb_4 = 4;
        } elseif ($diem_tb_10 >= 8.0 && $diem_tb_10 < 8.5) {
            $diem_tb_chu = 'B+';
            $diem_tb_4 = 3.5;
        } elseif ($diem_tb_10 >= 7.0 && $diem_tb_10 < 8.0) {
            $diem_tb_chu = 'B';
            $diem_tb_4 = 3.2;
        } elseif (6.5 <= $diem_tb_10 && $diem_tb_10 < 7.0) {
            $diem_tb_chu = 'C+';
            $diem_tb_4 = 2.5;
        } elseif ($diem_tb_10 >= 5.5 && $diem_tb_10 < 6.5) {
            $diem_tb_chu = 'C';
            $diem_tb_4 = 2;
        } elseif ($diem_tb_10 >= 5.0 && $diem_tb_10 < 5.5) {
            $diem_tb_chu = 'D+';
            $diem_tb_4 = 1.5;
        } elseif ($diem_tb_10 >= 4.0 && $diem_tb_10 < 5.0) {
            $diem_tb_chu = 'D';
            $diem_tb_4 = 1;
        } else {
            $diem_tb_chu = 'F';
            $diem_tb_4 = 0;
    
        }

        $sql_diem_tb = "UPDATE diem_hoc_phan SET diem_tb_10 = '$diem_tb_10', diem_tb_4 = '$diem_tb_4', diem_tb_chu = '$diem_tb_chu' WHERE msv = '$msv' AND ma_hoc_phan = '$ma_hoc_phan'";

        if ($conn->query($sql_diem_tb) === FALSE) {
            echo "Error: " . $sql_diem_tb . "<br>" . $conn->error;
        } 

    }
} 

?>
