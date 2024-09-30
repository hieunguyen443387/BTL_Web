<?php

include('../home_admin/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['ma_hoc_phan'])) {
        $ma_hoc_phan = $_GET['ma_hoc_phan'];  
        $ten_hoc_phan = $_POST['ten_hoc_phan'];
        $ma_nganh = $_POST['ma_nganh'];
        $so_tin_chi = $_POST['so_tin_chi'];

        if (empty($ten_hoc_phan) || empty($ma_nganh)) {
            echo 'Không được để trống';
        } else {
            $sql_update_hoc_phan = "UPDATE hoc_phan SET ma_nganh = '$ma_nganh', ten_hoc_phan = '$ten_hoc_phan', so_tin_chi = '$so_tin_chi' WHERE ma_hoc_phan = '$ma_hoc_phan'";

            if ($conn->query($sql_update_hoc_phan) === TRUE) {
                echo "Cập nhật thành công";
                header("Location: /web/admin/add/hoc_phan.php");
                exit();
            } else {
                echo "Lỗi khi cập nhật: " . $conn->error;
            }
        }
    }
}
 else { 
    if (isset($_GET['ma_hoc_phan'])) {
       
        $ma_hoc_phan = mysqli_real_escape_string($conn, $_GET['ma_hoc_phan']);

        
        $sql_hoc_phan = "SELECT ma_hoc_phan, ten_hoc_phan, ma_nganh, so_tin_chi FROM hoc_phan WHERE ma_hoc_phan = '$ma_hoc_phan'";
        $result_hoc_phan = $conn->query($sql_hoc_phan);

        if ($result_hoc_phan->num_rows > 0) {
            
            $row = $result_hoc_phan->fetch_assoc();
            $ten_hoc_phan = $row["ten_hoc_phan"];
            $ma_nganh = $row["ma_nganh"];
            $so_tin_chi = $row["so_tin_chi"];
        } else {
            echo "Không tìm thấy mã chuyên ngành!";
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
<title>Nhập ngành</title>

<style>
    .menu ul a #chuyen_nganh{
    background-color: #0F6CBF;
    color: #FFFFFF;
 }
 .input_chuyen_nganh{
    margin-left: 64px;
 }
</style>
<body>
    <div class="container">
        <?php
            require "../home_admin/header.php";
        ?>
        <div class="menu_add">
            <?php require "../home_admin/menu.php"; ?>
            <li class="add">
            <form action="update_hoc_phan.php?ma_hoc_phan=<?php echo $ma_hoc_phan; ?>" method="post">
                <div class="input_hoc_phan">
                    <input type="text" id="ten_hoc_phan" name="ten_hoc_phan" placeholder="Tên học phần" value = "<?php echo $ten_hoc_phan; ?>">
                    <input type="number" id="so_tin_chi" name="so_tin_chi" placeholder="Số tín chỉ" min = "1" value = "<?php echo $so_tin_chi; ?>">
                    <br>
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
                    <button type="submit">Cập nhật</button>
                </div>
                </form>
            </li>
        </div>
    </div>
    <?php
        require "../home_admin/footer.php";
    ?>
</body>
</html>

