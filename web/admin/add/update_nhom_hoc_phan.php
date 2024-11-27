<?php

include('../home_admin/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['ma_nhom'])) {
        $ma_nhom = $_GET['ma_nhom'];
        $ma_hoc_phan = $_POST['ma_hoc_phan'];
        $mgv = $_POST['mgv'];
        $ma_lop = $_POST['ma_lop'];
        $so_luong = $_POST['so_luong'];

        if (empty($_POST['ma_hoc_phan']) || empty($_POST['mgv']) || empty($_POST['ma_lop']) || empty($_POST['so_luong'])) {
            echo'Không được để trống';
        } else{
            $sql_update_nhom = "UPDATE nhom_hoc_phan SET ma_lop = '$ma_lop', mgv = '$mgv', ma_hoc_phan = '$ma_hoc_phan', so_luong = '$so_luong' WHERE ma_nhom = '$ma_nhom'";

            if ($conn->query($sql_update_nhom) === TRUE) {
                echo "Cập nhật thành công";
                header("Location: /web/admin/add/nhom_hoc_phan.php");
                exit();
            } else {
                echo "Lỗi khi cập nhật: " . $conn->error;
            }
        }
        
    }
}
if (isset($_GET['ma_nhom'])) {
    
    $ma_nhom = $_GET['ma_nhom'];
    $sql = "SELECT * FROM nhom_hoc_phan WHERE ma_nhom = '$ma_nhom'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ma_nhom = $row["ma_nhom"];
        $mgv = $row["mgv"];
        $so_luong = $row["so_luong"];
        $ma_hoc_phan = $row["ma_hoc_phan"];
    } else {
        echo "Không tìm thấy mã lớp!";
        exit();
    }

}


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
                <form action="update_nhom_hoc_phan.php?ma_nhom=<?php echo $ma_nhom;?>" method="post">
                    
                    <div class = "input_nhom">
                        <br>
                        <br>
                        <select name="ma_khoa" id="ma_khoa" >
                            <option value="">Lọc theo khoa</option>
                            <?php
                                include('../home_admin/config.php');
                                $sql_get_nhom = "SELECT * FROM nhom_hoc_phan WHERE ma_nhom = '$ma_nhom'";
                                $result_get_nhom = $conn->query($sql_get_nhom); // chạy query
                                $pass_nhom = $result_get_nhom->fetch_assoc();
                                $ma_hoc_phan = $pass_nhom['ma_hoc_phan'];

                                $sql_get_hoc_phan = "SELECT * FROM hoc_phan WHERE ma_hoc_phan = '$ma_hoc_phan'";
                                $result_get_hoc_phan = $conn->query($sql_get_hoc_phan); // chạy query
                                $pass_hoc_phan = $result_get_hoc_phan->fetch_assoc();
                                $ma_nganh = $pass_hoc_phan['ma_nganh'];

                                include('selected.php'); 
                            ?>
                        </select>      
                        <br>
                        <br>

                        <!-- Lọc theo ngành -->
                        <select name="ma_nganh" id="ma_nganh">
                            <option value="">Lọc theo ngành</option>
                            <?php

                            $sql = "SELECT ma_nganh, ten_nganh FROM nganh ";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                
                            while($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['ma_nganh'] . '"' ;
                                if ($row['ma_nganh'] == $pass_hoc_phan['ma_nganh']) {
                                    echo ' selected';
                                }
                                echo '>' . $row['ten_nganh'] . '</option>';
                                }
                            }   
                            ?>
                        </select>
                        <br>
                        <br>
                            
                        <!-- Lọc theo học phần -->
                        <select name="ma_hoc_phan" id="ma_hp">
                            <option value="">Lọc theo học phần</option>
                            <?php
                            
                            $sql_hoc_phan = "SELECT ma_hoc_phan, ten_hoc_phan FROM hoc_phan ";  
                            $result_hoc_phan = mysqli_query($conn, $sql_hoc_phan);
                            if ($result_hoc_phan->num_rows > 0) {
                                while($row = $result_hoc_phan->fetch_assoc()) {
                                    echo '<option value="' . $row['ma_nganh'] . '"' ;
                                    if ($row['ma_hoc_phan'] == $pass_nhom['ma_hoc_phan']) {
                                        echo ' selected';
                                    }
                                    echo '>' . $row['ten_hoc_phan'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <br>
                        <br>
                        <select name="mgv" id="mgv">
                            <option value="">Chọn giảng viên</option>
                            <?php
                                $sql_giang_vien = "SELECT mgv, ho_dem, ten FROM giang_vien";
                                $result_giang_vien = $conn->query($sql_giang_vien);
                                if ($result_giang_vien->num_rows > 0) {
                                    while($row = $result_giang_vien->fetch_assoc()) {
                                        echo '<option value="' . $row['mgv'] . '"' ;
                                        if ($row['mgv'] == $pass_nhom['mgv']) {
                                            echo ' selected';
                                        }
                                        echo '>' . $row['ho_dem'] . ' ' . $row['ten'] . '</option>';
                                    }
                                }
                            ?>
                        </select>
                        <br>
                        <br>

                        <select name="ma_lop" id="ma_lop">
                            <option value="">-- Chọn lớp --</option>
                            <?php
                                $sql_lop = "SELECT * FROM lop";
                                $result_lop = $conn->query($sql_lop);
                                if ($result_lop->num_rows > 0) {
                                    while($row = $result_lop->fetch_assoc()) {
                                        echo '<option value="' . $row['ma_lop'] . '"' ;
                                        if ($row['ma_lop'] == $pass_nhom['ma_lop']) {
                                            echo ' selected';
                                        }
                                        echo '>' . $row['ma_lop'] . '</option>';
                                    }
                                }
                            ?>
                        </select>
                        <br>
                        <br>
                        
                        <input type="number" id="so_luong" name="so_luong" placeholder="Số lượng sinh viên" min = "20" max="120" value = "<?php echo $so_luong; ?>">
                        <br>
                        <br>
                        <button type="submit">Cập nhật</button>
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


