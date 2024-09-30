<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['ma_nhom'])) {
        include('../home/home/config.php');
        $ma_nhom = $_POST['ma_nhom'];

        $sql1 = "SELECT ma_nhom, msv, diem_c, diem_b, diem_a FROM bang_diem_nhom WHERE ma_nhom = '$ma_nhom'";
        $result1 = $conn->query($sql1);
        

        if ($result1->num_rows > 0) {
            $_SESSION['ma_nhom'] = $ma_nhom;
            $stt = 1;
            while ($row = $result1->fetch_assoc()) {
                $diem_a = $row["diem_a"];
                $diem_b = $row["diem_b"];
                $diem_c = $row["diem_c"];
                $_SESSION['msv'] = $row["msv"];
                $msv = $_SESSION['msv'];
                $sql_sinh_vien = "SELECT ho_dem, ten FROM sinh_vien WHERE msv = '$msv'";
                $result_sinh_vien = $conn->query($sql_sinh_vien);
                if ($result_sinh_vien->num_rows > 0) {
                    $row = $result_sinh_vien->fetch_assoc();
                    $ho_dem = $row['ho_dem'];
                    $ten = $row['ten'];
        
                    
                }
                echo '<tr id = "row"">';
                echo '<td>' . $stt++ . '</td>';
                echo '<td>' . $msv . '</td>';
                echo '<td>' . $ho_dem . ' ' . $ten . '</td>';
                echo '<td><p class="my">' . $diem_c . '</p><input class="myDIV" id="diem_c" name="diem_c[' . $msv . ']"  type="number" min="0" max="10" ></td>';
                echo '<td><p class="my">' . $diem_b . '</p><input class="myDIV" id="diem_b" name="diem_b[' . $msv . ']"  type="number" min="0" max="10" ></td>';
                echo '<td><p class="my">' . $diem_a . '</p><input class="myDIV" id="diem_a" name="diem_a[' . $msv . ']"  type="number" min="0" max="10" ></td>';
                echo '<td><i class="fa-solid fa-pen" onclick="myFunction(this) " style = "color: #2CA2E6; cursor: pointer;"></i></td>';
                

                
            }
        } else {
            echo "Nhóm chưa nhập điểm";
        }
        echo '</tr>';
    }
    ?>