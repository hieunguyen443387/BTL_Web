<form method="post" action="cap_nhat_diem.php">
    <div class="drop_menu">
        
        <select name="ma_nhom" id="ma_nhom">
            <option value="">Chọn nhóm</option>
            <?php
                include('../home/home/config.php');

                $mgv = $_SESSION['mgv'];

                // Truy vấn lấy danh sách nhóm học phần
                $sql = "SELECT ma_nhom, ma_hoc_phan FROM nhom_hoc_phan WHERE mgv = '$mgv'";
                $result = $conn->query($sql);

                // Hiển thị danh sách nhóm
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['ma_nhom'] . '">' . $row['ma_nhom'] . " - " . $row['ma_hoc_phan'] . '</option>';
                    }
                }
                ?>
                </select>

                <button type="submit">Mở danh sách</button>
                </div>

                <table>
                <div class="note"><b>Danh sách sinh viên
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['ma_nhom'])) {
                        // Lưu `ma_nhom` vào session
                        $ma_nhom = $_SESSION['ma_nhom'] = $_POST['ma_nhom'];
                        $ma_hoc_phan = $_SESSION['ma_hoc_phan'] = $_POST['ma_nhom'];

                        // Truy vấn để lấy `ma_hoc_phan` tương ứng với `ma_nhom`
                        $sql_ma_hoc_phan = "SELECT ma_hoc_phan FROM nhom_hoc_phan WHERE ma_nhom = '$ma_nhom'";
                        $result_ma_hoc_phan = $conn->query($sql_ma_hoc_phan);

                        if ($result_ma_hoc_phan->num_rows > 0) {
                            $row_ma_hoc_phan = $result_ma_hoc_phan->fetch_assoc();
                            $ma_hoc_phan = $_SESSION['ma_hoc_phan'] = $row_ma_hoc_phan['ma_hoc_phan'];
                            echo " nhóm: " . $ma_nhom . " - " . $ma_hoc_phan;
                        } else {
                            echo "Không tìm thấy mã học phần cho nhóm này.";
                        }
                    }
                ?>
                </b></div>
    
    
        <tr id="header_row">
            <th>STT</th>
            <th>Mã sinh viên</th>
            <th>Sinh viên</th>
            <th>Điểm C</th>
            <th>Điểm B</th>
            <th>Điểm A</th>
        </tr>

        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['ma_nhom'])) {
            include('../home/home/config.php');
            $ma_nhom = $_POST['ma_nhom'];

            $sql_bang_diem = "SELECT ma_nhom, msv, diem_c, diem_b, diem_a FROM bang_diem_nhom WHERE ma_nhom = '$ma_nhom'";
            $result_bang_diem = $conn->query($sql_bang_diem);
            if ($result_bang_diem->num_rows > 0){
                $_SESSION['ma_nhom'] = $ma_nhom;
                    $stt = 1;
                    while ($row = $result_bang_diem->fetch_assoc()) {
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
                        echo '<tr id="row">';
                        echo '<td>' . $stt++ . '</td>';
                        echo '<td>' . $msv . '</td>';
                        echo '<td>' . $ho_dem . ' ' . $ten . '</td>';
                        echo '<td>' . $diem_c . '</td>';
                        echo '<td>' . $diem_b . '</td>';
                        echo '<td>' . $diem_a . '</td>';
                        echo '</tr>';
                    }
            } else{
                $sql_nhom = "SELECT ma_nhom, msv, ho_dem, ten FROM danh_sach_sinh_vien WHERE ma_nhom = '$ma_nhom'";
                $result_nhom = $conn->query($sql_nhom);

                if ($result_nhom->num_rows > 0) {
                    $_SESSION['ma_nhom'] = $ma_nhom;
                    $stt = 1;
                    while ($row = $result_nhom->fetch_assoc()) {
                        $_SESSION['msv'] = $row["msv"];
                        $msv = $_SESSION['msv'];
                        echo '<tr id = "row"">';
                        echo '<td>' . $stt++ . '</td>';
                        echo '<td>' . $msv . '</td>';
                        echo '<td>' . $row["ho_dem"] . ' ' . $row["ten"] . '</td>';
                        echo '<td><input id="diem_c" name="diem_c[' . $msv . ']" type="number" min="0" max="10" style="outline: none; width: 70px;"></td>';
                        echo '<td><input id="diem_b" name="diem_b[' . $msv . ']" type="number" min="0" max="10" style="outline: none; width: 70px;"></td>';
                        echo '<td><input id="diem_a" name="diem_a[' . $msv . ']" type="number" min="0" max="10" style="outline: none; width: 70px;"></td>';
                        echo '</tr>';
                    }
                } else {
                    echo "Không có học sinh trong nhóm";
                }
            }
        }
        ?>
    </table>
    

    <?php
        require "xu_ly_nhap_diem.php";
    ?>

    <button class="button" type="submit" name="nhap_diem" style="margin-left: 220px"><b>Nhập điểm</b></button>

    <?php
        require "xu_ly_diem.php";
    ?>
    <?php
        require "xu_ly_sinh_vien_truot_mon.php";
    ?>


</form>