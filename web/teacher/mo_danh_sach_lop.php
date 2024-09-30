<form method="post" action="mo_danh_sach_lop.php">
    <div class="drop_menu">
        <select name="ma_lop" id="ma_lop">
            <option value="">Chọn lớp</option>
            <?php
                include('../home/home/config.php');

                $mgv = $_SESSION['mgv'];

                $sql = "SELECT ma_lop FROM lop WHERE mgv = '$mgv'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['ma_lop'] . '">' . $row['ma_lop'] . '</option>';    
                    }
                }

            ?>
        </select>
        <button type="submit">Mở danh sách</button>
    </div>
    <div class="note"><b>Danh sách lớp</b></div>
    <table>
        <tr id="header_row">
            <th>STT</th>
            <th>Mã sinh viên</th>
            <th>Sinh viên</th>
            <th>Điểm rèn luyện</th>
        </tr>

        <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['ma_lop'])) {
        include('../home/home/config.php');
        $ma_lop = $_POST['ma_lop'];

        $sql1 = "SELECT ma_lop, msv, ho_dem, ten FROM danh_sach_lop WHERE ma_lop = '$ma_lop'";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
            $_SESSION['ma_lop'] = $ma_lop;
            $stt = 1;
            while ($row = $result1->fetch_assoc()) {
                echo '<tr id = "row" style="height: 30px;">';
                echo '<td>' . $stt++ . '</td>';
                echo '<td>' . $row["msv"] . '</td>';
                echo '<td>' . $row["ho_dem"] . ' ' . $row["ten"] . '</td>';
                echo '<td><input id="drl" name="drl[' . $row["msv"] . ']" type="number" min="0" max="100" style="outline: none; width: 70px;"></td>';
                echo '</tr>';
            }
        } else {
            echo "Lớp chưa có sinh viên";
        }


        $conn->close();
    }
    ?>

    </table>
    <?php
        require "nhap_drl.php";
    ?>

    <button class="button" type="submit" name="nhap_diem" style="margin-left: 220px"><b>Nhập điểm</b></button>

</form>