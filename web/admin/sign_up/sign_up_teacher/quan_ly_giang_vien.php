<!DOCTYPE html>
<html>

<style>
    .add_student{
        text-decoration: none; 
        background-color: #219DE5; 
        color: white; 
        display: inline-block; 
        width: 100px; 
        height: 50px; 
        border-radius: 5px;
        border: 2px solid grey;
        text-align: center; 
        line-height: 50px;
        margin-left: 300px;
        margin-top: 20px;
    }
</style>

<body>
    <div class="container">
        <?php
            require "../../home_admin/header.php";
            require "../../home_admin/menu.php";
        ?>
        <main>
        <form method="post" action="">
            
        <div class = "filter">
            <!-- Lọc theo khoa -->
        <select name="ma_khoa" id="ma_khoa">
            <option value="">Lọc theo khoa</option>
            <?php
            include('../home_admin/config.php');
            $sql = "SELECT ma_khoa, ten_khoa FROM khoa";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['ma_khoa'] . '">' . $row['ten_khoa'] . '</option>';
                }
            }
            ?>
        </select>
        <button type="submit">Lọc</button>
        <a href="sign_up.php" class="add_student" ><i class="fa-solid fa-plus" style="color: white;"></i></a>

        </div>
                
        <table style = "margin_top = 100px">
        <!-- Mở danh sách sinh viên -->
        <caption class="note"><b>Danh sách giảng viên</b></caption>
        <tr id="header_row">
            <th>STT</th>
            <th>Mã giảng viên</th>
            <th>Giảng viên</th>
            <th>Khoa</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Tác vụ</th>
        </tr>
        <?php
            // Lấy danh sách sinh viên theo lớp
            if (isset($_POST['ma_khoa']) && !empty($_POST['ma_khoa'])) {
                $ma_khoa = $_POST['ma_khoa'];
                $sql_giang_vien = "SELECT mgv, ho_dem, ten, ma_khoa, sdt, email, ngay_sinh, gioi_tinh FROM giang_vien WHERE ma_khoa = '$ma_khoa'";
            } else {
            // Lấy danh sách toàn bộ sinh viên
                $sql_giang_vien = "SELECT mgv, ho_dem, ten, ma_khoa, sdt, email, ngay_sinh, gioi_tinh FROM giang_vien";
            }

            $result_giang_vien = $conn->query($sql_giang_vien);

            if ($result_giang_vien->num_rows > 0) {
                $stt = 1;
                while($row = $result_giang_vien->fetch_assoc()) {
                    $mgv = $row["mgv"];
                    $ho_dem = $row["ho_dem"];
                    $ten = $row["ten"];
                    $ma_khoa = $row["ma_khoa"];
                    $sdt = $row["sdt"];
                    $email = $row["email"];
                    $ngay_sinh = $row["ngay_sinh"];
                    $gioi_tinh = $row["gioi_tinh"];
                    echo '<tr id="row">';
                    echo '<td style="width: 50px;">' . $stt++ . '</td>';
                    echo '<td style="width: 100px;">' . $mgv . '</td>';
                    echo '<td style="width: 235px;">' . $ho_dem  . " " . $ten . '</td>';
                    echo '<td>' . $ma_khoa . '</td>';
                    echo '<td>' . $sdt . '</td>';
                    echo '<td>' . $email . '</td>';
                    echo '<td>' . $ngay_sinh . '</td>';
                    echo '<td>' . $gioi_tinh . '</td>';
                    
                    //Tác vụ
                    echo '<td id="task"><a href="sign_up.php"><i class="fa-solid fa-plus"></i></a><a href="/web/admin/sign_up/sign_up_teacher/update_teacher.php?mgv=' . $mgv . '""><i class="fa-solid fa-pen"></i></a><a href="../delete.php?mgv=' . $mgv . '"><i class="fa-solid fa-trash"></i></a></td>';
                    
                    echo '</tr>';
                }
            } else {
                echo "0 results";
            }
        ?>
        </table>
        <div class = "space"></div>
    </form>
        </main>
    </div>
    
    <?php
        require "../../home_admin/footer.php";
    ?>
    
</body>
</html>