<?php
// session_start();
include('../home_admin/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $ma_nhom = $_POST['ma_nhom'];
    $ma_hoc_phan = $_POST['ma_hoc_phan'];
    $mgv = $_POST['mgv'];
    $ma_lop = $_POST['ma_lop'];
    $so_luong = $_POST['so_luong'];

    if (empty($_POST['ma_hoc_phan']) || empty($_POST['mgv']) || empty($_POST['ma_nhom']) || empty($_POST['ma_lop']) || empty($_POST['so_luong'])) {
        echo'Không được để trống';
    } else{
        $sql = "SELECT ma_nhom FROM nhom_hoc_phan WHERE ma_nhom = '$ma_nhom'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Đã tồn tại";
        } else {
            $sql = "INSERT INTO nhom_hoc_phan (ma_nhom, mgv, ma_hoc_phan, ma_lop, so_luong) 
            VALUES ('$ma_nhom', '$mgv', '$ma_hoc_phan', '$ma_lop', '$so_luong')";

            if ($conn->query($sql) === TRUE) {
                echo "Dữ liệu đã được thêm thành công!";
                header("Location: /web/admin/add/nhom_hoc_phan.php");
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
<script src="fetch_nhom_hoc_phan.js"></script>
<script src="fetch_giang_vien.js"></script>
<script src="fetch_lop.js"></script>
<title>Nhập học phần</title>
<style>
.menu ul a #nhom_hoc_phan{
    background-color: #0F6CBF;
    color: #FFFFFF;
}
.input_nhom{
    margin-left: 64px;
}
</style>
<body>
    <div class="container">
        <?php
            require "../home_admin/header.php";
        ?>
        
        <div class="menu_add">
            <?php
                require "../home_admin/menu.php";
            ?>
            <div class="add" style = "height: 515px;">
                <form action="create_nhom_hoc_phan.php" method="post">
                    <div class = "input_nhom">
                        <input type="text" id="ma_nhom" name="ma_nhom" placeholder="Mã nhóm" min="1">
                        <br>
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
                        <select name="ma_hoc_phan" id="ma_hp">
                            <option value="">Lọc theo học phần</option>
                            <?php
                            
                            $sql_hoc_phan = "SELECT ma_hoc_phan, ten_hoc_phan FROM hoc_phan ";  
                            $result_hoc_phan = mysqli_query($conn, $sql_hoc_phan);
                            if ($result_hoc_phan->num_rows > 0) {
                                while($row = $result_hoc_phan->fetch_assoc()) {
                                    echo '<option value="' . $row['ma_hoc_phan'] . '">' . $row['ten_hoc_phan'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <br>
                        <br>
                        <select name="mgv" id="mgv">
                            <option value="">-- Chọn cố vấn --</option>
                            <?php
                                include('../home_admin/config.php');
                                $mgv = mysqli_query($conn, "SELECT * FROM giang_vien");

                                $sql = "SELECT mgv, ho_dem, ten FROM giang_vien";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['mgv'] . '">' . $row['ho_dem'] . $row['ten'] . '</option>';
                                    }
                                }
                            ?>
                        </select>
                        <br>
                        <br>

                        <select name="ma_lop" id="ma_lop">
                            <option value="">-- Chọn lớp --</option>
                            <?php
                                include('../home_admin/config.php');
                                $mgv = mysqli_query($conn, "SELECT * FROM lop");

                                $sql = "SELECT ma_lop FROM lop";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo '<option value="'  . $row['ma_lop']. '">' . $row['ma_lop'] . '</option>';
                                    }
                                }
                            ?>
                        </select>
                        <br>
                        <br>
                        
                        <input type="number" id="so_luong" name="so_luong" placeholder="Số lượng sinh viên" min = "20" max="120">
                        <br>
                        <br>
                        <button type="submit">Nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
        require "../home_admin/footer.php";
    ?>
</body>
</html>


