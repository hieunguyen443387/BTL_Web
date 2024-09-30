<style>
    .my {
        display: block;
    }

    .myDIV {
        width: 50px;
        margin-left: 12px;
        display: none;
    }
    
</style>
<form method="post" action="hien_thi_bang_diem.php">
    <div class="drop_menu">
        
        <select name="ma_nhom" id="ma_nhom">
            <option value="">Chọn nhóm</option>
            <?php
                include('../home/home/config.php');

                $mgv = $_SESSION['mgv'];

                $sql = "SELECT DISTINCT ma_nhom FROM bang_diem_nhom WHERE mgv = '$mgv'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['ma_nhom'] . '">' . $row['ma_nhom'] . '</option>';    
                    }
                }
            ?>
        </select>
        <button type="submit">Mở bảng điểm</button>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['ma_nhom'])) {
                $_SESSION['ma_nhom'] = $_POST['ma_nhom'];
                $ma_nhom = $_SESSION['ma_nhom'];

                // Truy vấn để lấy ma_hoc_phan tương ứng với ma_nhom
                $sql = "SELECT ma_hoc_phan FROM nhom_hoc_phan WHERE ma_nhom = '$ma_nhom'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $_SESSION['ma_hoc_phan'] = $row['ma_hoc_phan'];
                    $ma_hoc_phan = $_SESSION['ma_hoc_phan'];
                    
                } else {
                    echo "Không tìm thấy mã học phần cho nhóm này.";
                }
            }
        ?>
        
    </div>
    <div class="note"><b>Danh sách sinh viên</b></div>
    <table>
        <tr id="header_row">
            <th>STT</th>
            <th>Mã sinh viên</th>
            <th>Sinh viên</th>
            <th>Điểm C</th>
            <th>Điểm B</th>
            <th>Điểm A</th>
            <th>Chọn sinh viên</th>
        </tr>
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
                        echo '<tr id = "row">';
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
        
    </table>
    
    <button class="button" type="submit" style="margin-left: 220px"><b>Cập nhật</b></button>
    <?php
        require "xu_ly_cap_nhat_diem.php";
    ?>
    <?php
        require "xu_ly_diem.php";
    ?>
    <?php
        require "xu_ly_sinh_vien_truot_mon.php";
    ?>
    <script>
        function myFunction(button) {
            var row = button.parentElement.parentElement;
    
            var paragraphs = row.querySelectorAll(".my");
            var inputs = row.querySelectorAll(".myDIV");
    
            for (var i = 0; i < paragraphs.length; i++) {
                if (paragraphs[i].style.display === "none") {
                    paragraphs[i].style.display = "block";
                    inputs[i].style.display = "none";
                } else {
                    paragraphs[i].style.display = "none";
                    inputs[i].style.display = "block";
                }
            }
        }
    </script>

</form>