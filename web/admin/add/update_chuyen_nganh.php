<?php

include('../home_admin/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['ma_chuyen_nganh'])) {
        $ma_chuyen_nganh = $_GET['ma_chuyen_nganh'];  
        $ten_chuyen_nganh = $_POST['ten_chuyen_nganh'];
        $ma_nganh = $_POST['ma_nganh'];

        if (empty($ten_chuyen_nganh) || empty($ma_nganh)) {
            echo 'Không được để trống';
        } else {
            $sql_update_chuyen_nganh = "UPDATE chuyen_nganh SET ma_nganh = '$ma_nganh', ten_chuyen_nganh = '$ten_chuyen_nganh' WHERE ma_chuyen_nganh = '$ma_chuyen_nganh'";

            if ($conn->query($sql_update_chuyen_nganh) === TRUE) {
                echo "Cập nhật thành công";
                header("Location: /web/admin/add/chuyen_nganh.php");
                exit();
            } else {
                echo "Lỗi khi cập nhật: " . $conn->error;
            }
        }
    }
}
 else { 
    if (isset($_GET['ma_chuyen_nganh'])) {
       
        $ma_chuyen_nganh = mysqli_real_escape_string($conn, $_GET['ma_chuyen_nganh']);

        
        $sql_chuyen_nganh = "SELECT ma_nganh, ten_chuyen_nganh FROM chuyen_nganh WHERE ma_chuyen_nganh = '$ma_chuyen_nganh'";
        $result_chuyen_nganh = $conn->query($sql_chuyen_nganh);

        if ($result_chuyen_nganh->num_rows > 0) {
            
            $row = $result_chuyen_nganh->fetch_assoc();
            $ten_chuyen_nganh = $row["ten_chuyen_nganh"];
            $ma_nganh = $row["ma_nganh"];
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
            <form action="update_chuyen_nganh.php?ma_chuyen_nganh=<?php echo $ma_chuyen_nganh; ?>" method="post">
                <div class="input_chuyen_nganh">
                    <input type="text" id="ten_chuyen_nganh" name="ten_chuyen_nganh" placeholder="Tên chuyên ngành" value = "<?php echo $ten_chuyen_nganh; ?>">
                    <br>
                    <select name="ma_khoa" id="ma_khoa">
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

