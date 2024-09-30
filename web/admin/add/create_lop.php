<?php

include('../home_admin/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $ma_lop = $_POST['ma_lop'];
    $mgv = $_POST['mgv'];
    $ma_chuyen_nganh = $_POST['ma_chuyen_nganh'];
    $ma_khoa = $_POST['ma_khoa'];
    $ma_nganh = $_POST['ma_nganh'];
    $so_luong = $_POST['so_luong'];

    if (empty($_POST['ma_lop']) || empty($_POST['mgv']) || empty($_POST['so_luong']) || 
    empty($_POST['ma_chuyen_nganh']) || empty($_POST['ma_khoa']) || empty($_POST['ma_nganh'])) {
        echo'Không được để trống';
    } else{
        $sql = "SELECT ma_lop FROM lop WHERE ma_lop = '$ma_lop'";
        $result = $conn->query($sql);
        $sql_khoa = "SELECT ma_lop, ma_khoa FROM danh_sach_lop_thuoc_khoa WHERE ma_lop = '$ma_lop'";
        $result_khoa = $conn->query($sql_khoa);
        $sql_nganh = "SELECT ma_lop, ma_nganh FROM danh_sach_lop_thuoc_nganh WHERE ma_lop = '$ma_lop'";
        $result_nganh = $conn->query($sql_nganh);
        $sql_chuyen_nganh = "SELECT ma_lop, ma_chuyen_nganh FROM danh_sach_lop_thuoc_chuyen_nganh WHERE ma_lop = '$ma_lop'";
        $result_chuyen_nganh = $conn->query($sql_chuyen_nganh);


        if ($result->num_rows > 0) {
            echo "Đã tồn tại";
        } else {
            // Thêm lớp vào bảng lớp
            $sql = "INSERT INTO lop (ma_lop, mgv, ma_chuyen_nganh, so_luong) 
            VALUES ('$ma_lop', '$mgv', '$ma_chuyen_nganh', '$so_luong')";

            // Thêm lớp vào bảng lớp thuộc khoa
            $sql_khoa = "INSERT INTO danh_sach_lop_thuoc_khoa (ma_lop, ma_khoa) 
            VALUES ('$ma_lop', '$ma_khoa')";

            // Thêm lớp vào bảng lớp thuộc ngành
            $sql_nganh = "INSERT INTO danh_sach_lop_thuoc_nganh (ma_lop, ma_nganh) 
            VALUES ('$ma_lop', '$ma_nganh')";

            // Thêm lớp vào bảng lớp thuộc chuyên ngành
            $sql_chuyen_nganh = "INSERT INTO danh_sach_lop_thuoc_chuyen_nganh (ma_lop, ma_chuyen_nganh) 
            VALUES ('$ma_lop', '$ma_chuyen_nganh')";

            if ($conn->query($sql) === TRUE && $conn->query($sql_khoa) === TRUE && $conn->query($sql_nganh) === TRUE && $conn->query($sql_chuyen_nganh) === TRUE) {
                echo "Dữ liệu đã được thêm thành công!";
                header("Location: /web/admin/add/lop.php");
            } else {
                echo "Lỗi: " . $sql . "<br>" . $conn->error;
            }
        } 
    }
}


$conn->close();
?>
<!DOCTYPE html>
<html>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="app.js"></script>
    <script src="fetch_giang_vien.js"></script>
<title>Nhập lớp</title>
<style>
    .menu ul a #lop{
    background-color: #0F6CBF;
    color: #FFFFFF;
 }

</style>
<body>
    <div class="container">
        <?php
            require "../home_admin/header.php";
        ?>
        <ul class="menu_add">
            <?php
                require "../home_admin/menu.php";
            ?>
            <li class="add" style = "height: 433px;">
                <form action="create_lop.php" method="post">
                    <input type="text" id="ma_lop" name="ma_lop" placeholder="Mã lớp">
                    <input type="number" id="so_luong" name="so_luong" min="20" max="120" placeholder="Số lượng sinh viên">
                    <br>
                    <select name="ma_khoa" id="ma_khoa" >
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
                    <br>
                    <br>

                    <!-- Lọc theo ngành -->
                    <select name="ma_nganh" id="ma_nganh">
                        <option value="">Lọc theo ngành</option>
                        <?php

                        $sql_nganh = "SELECT ma_nganh, ten_nganh FROM nganh"; 
                        $result_nganh = $conn->query($sql_nganh);

                        if ($result_nganh->num_rows > 0) {
                            while($row = $result_nganh->fetch_assoc()) {
                                echo '<option value="' . $row['ma_nganh'] . '">' . $row['ten_nganh'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <br>
                    <br>
                        
                    <!-- Lọc theo chuyên ngành -->
                    <select name="ma_chuyen_nganh" id="ma_chuyen_nganh">
                        <option value="">Lọc theo chuyên ngành</option>
                        <?php
                        
                        $sql_chuyen_nganh = "SELECT ma_chuyen_nganh, ten_chuyen_nganh FROM chuyen_nganh";

                        $result_chuyen_nganh = $conn->query($sql_chuyen_nganh);
                        if ($result_chuyen_nganh->num_rows > 0) {
                            while($row = $result_chuyen_nganh->fetch_assoc()) {
                                echo '<option value="' . $row['ma_chuyen_nganh'] . '">' . $row['ten_chuyen_nganh'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <br>
                    <br>
                        
                    <!-- chọn cố vấn -->
                    <select name="mgv" id="mgv">
                        <option value="">Lọc giảng viên</option>
                        <?php
                        
                        $sql_giang_vien = "SELECT mgv, ho_dem, ten FROM giang_vien";

                        $result_giang_vien = $conn->query($sql_giang_vien);
                        if ($result_giang_vien->num_rows > 0) {
                            while($row = $result_giang_vien->fetch_assoc()) {
                                echo '<option value="' . $row['mgv'] . '">' . $row['ho_dem'] . '' . $row['ten'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <br>
                    <br>
                    <button type="submit">Nhập</button>
                </form>
            </li>
        </ul>
    </div>
    <?php
        require "../home_admin/footer.php";
    ?>
</body>
</html>


