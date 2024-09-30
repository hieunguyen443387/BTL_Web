<?php

include('../home_admin/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['ma_nganh'])) {
        $ma_nganh = $_GET['ma_nganh'];  
        $ten_nganh = $_POST['ten_nganh'];
        $ma_khoa = $_POST['ma_khoa'];

        if (empty($ten_nganh) || empty($ma_khoa)) {
            echo 'Không được để trống';
        } else {
            $sql_update_nganh = "UPDATE nganh SET ma_khoa = '$ma_khoa', ten_nganh = '$ten_nganh' WHERE ma_nganh = '$ma_nganh'";

            if ($conn->query($sql_update_nganh) === TRUE) {
                echo "Cập nhật thành công";
                header("Location: /web/admin/add/nganh.php");
                exit();
            } else {
                echo "Lỗi khi cập nhật: " . $conn->error;
            }
        }
    }
}
 else { 
    if (isset($_GET['ma_nganh'])) {
       
        $ma_nganh = mysqli_real_escape_string($conn, $_GET['ma_nganh']);

        
        $sql_nganh = "SELECT ma_khoa, ten_nganh FROM nganh WHERE ma_nganh = '$ma_nganh'";
        $result_nganh = $conn->query($sql_nganh);

        if ($result_nganh->num_rows > 0) {
            
            $row = $result_nganh->fetch_assoc();
            $ten_nganh = $row["ten_nganh"];
            $ma_khoa = $row["ma_khoa"];
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
<html><title>Nhập ngành</title>

<style>
    .menu ul a #nganh{
    background-color: #0F6CBF;
    color: #FFFFFF;
 }
 .input_nganh{
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
                <form action="update_nganh.php?ma_nganh=<?php echo $ma_nganh; ?>" method="post">
                    <div class="input_nganh">
                        <input type="text" id="ten_nganh" name="ten_nganh" placeholder="Tên ngành" value = "<?php echo $ten_nganh; ?>">
                        <br>
                        <select name="ma_khoa" id="ma_khoa">
                        <option value="<?php echo $ma_khoa; ?>">-- Chọn khoa --</option>
                        <?php
                            
                            $sql = "SELECT ma_khoa, ten_khoa FROM khoa";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['ma_khoa'] . '">' . $row['ten_khoa'] . '</option>';
                                }
                            }
                        ?>
                        </select>
                    </div>
                    <br>
                    <br>
                    <button type="submit">Cập nhật</button>
                </form>
            </li>
        </div>
    </div>
    <?php
        require "../home_admin/footer.php";
    ?>
</body>
</html>

