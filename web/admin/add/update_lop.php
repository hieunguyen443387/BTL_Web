<?php

include('../home_admin/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['ma_lop'])) {
        $ma_lop = $_GET['ma_lop'];
        $mgv = $_POST['mgv'];
        $ma_chuyen_nganh = $_POST['ma_chuyen_nganh'];
        $ma_khoa = $_POST['ma_khoa'];
        $ma_nganh = $_POST['ma_nganh'];
        $so_luong = $_POST['so_luong'];

        if (empty($_POST['mgv']) || empty($_POST['so_luong']) || 
        empty($_POST['ma_chuyen_nganh']) || empty($_POST['ma_khoa']) || empty($_POST['ma_nganh'])) {
            echo 'Không được để trống';
        } else {
            $sql_update_lop = "UPDATE lop SET ma_lop = '$ma_lop', mgv = '$mgv', ma_chuyen_nganh = '$ma_chuyen_nganh', so_luong = '$so_luong' WHERE ma_lop = '$ma_lop'";
            $sql_update_lop_thuoc_khoa = "UPDATE danh_sach_lop_thuoc_khoa SET ma_lop = '$ma_lop', ma_khoa = '$ma_khoa' WHERE ma_lop = '$ma_lop'";
            $sql_update_lop_thuoc_nganh = "UPDATE danh_sach_lop_thuoc_nganh SET ma_lop = '$ma_lop', ma_nganh = '$ma_nganh' WHERE ma_lop = '$ma_lop'";
            $sql_update_lop_thuoc_chuyen_nganh = "UPDATE danh_sach_lop_thuoc_chuyen_nganh SET ma_lop = '$ma_lop', ma_chuyen_nganh = '$ma_chuyen_nganh' WHERE ma_lop = '$ma_lop'";

            if ($conn->query($sql_update_lop) === TRUE && $conn->query($sql_update_lop_thuoc_khoa) === TRUE 
            && $conn->query($sql_update_lop_thuoc_nganh) === TRUE && $conn->query($sql_update_lop_thuoc_chuyen_nganh) === TRUE) {
                echo "Cập nhật thành công";
                header("Location: /web/admin/add/lop.php");
                exit();
            } else {
                echo "Lỗi khi cập nhật: " . $conn->error;
            }
        }
    }
}
 else { 
    if (isset($_GET['ma_lop'])) {
       
        $ma_lop = mysqli_real_escape_string($conn, $_GET['ma_lop']);

        $sql = "SELECT ma_lop, mgv, so_luong, ma_chuyen_nganh FROM lop WHERE ma_lop = '$ma_lop'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ma_lop = $row["ma_lop"];
            $mgv = $row["mgv"];
            $so_luong = $row["so_luong"];
            $ma_chuyen_nganh = $row["ma_chuyen_nganh"];
        } else {
            echo "Không tìm thấy mã lớp!";
            exit();
        }
        // Truy vấn danh_sach_lop_thuoc_khoa
        $sql_khoa = "SELECT ma_khoa FROM danh_sach_lop_thuoc_khoa WHERE ma_lop = '$ma_lop'";
        $result_khoa = $conn->query($sql_khoa);
        if ($result_khoa->num_rows > 0) {
            $row = $result_khoa->fetch_assoc();
            $ma_khoa = $row["ma_khoa"];
        } else {
            echo "Không tìm thấy mã khoa!";
            exit();
        }

        // Truy vấn danh_sach_lop_thuoc_nganh
        $sql_nganh = "SELECT ma_nganh FROM danh_sach_lop_thuoc_nganh WHERE ma_lop = '$ma_lop'";
        $result_nganh = $conn->query($sql_nganh);
        if ($result_nganh->num_rows > 0) {
            $row = $result_nganh->fetch_assoc();
            $ma_nganh = $row["ma_nganh"];
        } else {
            echo "Không tìm thấy mã ngành!";
            exit();
        }
        
    } else {
        echo "Không có mã ngành được cung cấp!";
        exit();
    }
}

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
 .input_lop{
    margin-left: 64px;
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
                <form action="update_lop.php?ma_lop=<?php echo $ma_lop; ?>" method="post">
                    <h3>Cập nhật lớp <?php echo $ma_lop; ?> </h3>
                    <div class="input_lop">
                        <input type="number" id="so_luong" name="so_luong" min="20" max="120" placeholder="Số lượng sinh viên" value = "<?php echo $so_luong; ?>">
                        <br>
                        <select name="ma_khoa" id="ma_khoa" >
                            <option value="<?php echo $ma_khoa; ?>">Lọc theo khoa</option>
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
                            <option value="<?php echo $ma_nganh; ?>">Lọc theo ngành</option>
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
                            <option value="<?php echo $ma_chuyen_nganh; ?>">Lọc theo chuyên ngành</option>
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
                            <option value="<?php echo $mgv; ?>">Lọc giảng viên</option>
                            <?php
                            
                            $sql_giang_vien = "SELECT mgv, ho_dem, ten FROM giang_vien";

                            $result_giang_vien = $conn->query($sql_giang_vien);
                            if ($result_giang_vien->num_rows > 0) {
                                while($row = $result_giang_vien->fetch_assoc()) {
                                    echo '<option value="' . $row['mgv'] . '">' . $row['ho_dem'] . ' ' . $row['ten'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <br>
                        <br>
                        <button type="submit">Cập nhật</button>
                    </div>
                </form>
            </li>
        </ul>
    </div>
    <?php
        require "../home_admin/footer.php";
    ?>
</body>
</html>