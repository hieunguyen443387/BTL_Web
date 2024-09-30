<?php

include('../home_admin/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $ma_hoc_phan = $_POST['ma_hoc_phan'];
    $ten_hoc_phan = $_POST['ten_hoc_phan'];
    $so_tin_chi = $_POST['so_tin_chi'];
    $ma_nganh = $_POST['ma_nganh'];

    if (empty($_POST['ma_hoc_phan']) || empty($_POST['ten_hoc_phan']) || empty($_POST['so_tin_chi']) || empty($_POST['ma_nganh'])) {
        echo'Không được để trống';
    } else{
        $sql = "SELECT ma_hoc_phan FROM hoc_phan WHERE ma_hoc_phan = '$ma_hoc_phan'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Đã tồn tại";
        } else {
            $sql = "INSERT INTO hoc_phan (ma_hoc_phan, ten_hoc_phan, so_tin_chi, ma_nganh) 
            VALUES ('$ma_hoc_phan', '$ten_hoc_phan', '$so_tin_chi', '$ma_nganh')";

            if ($conn->query($sql) === TRUE) {
                echo "Dữ liệu đã được thêm thành công!";
                header("Location: /web/admin/add/hoc_phan.php");
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
<title>Nhập học phần</title>
<style>
    .menu ul a #hoc_phan{
    background-color: #0F6CBF;
    color: #FFFFFF;
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
            <div class="add">
                <form action="create_hoc_phan.php" method="post">
                    <input type="text"  name="ma_hoc_phan" placeholder="Mã học phần">
                    <input type="text" id="ten_hoc_phan" name="ten_hoc_phan" placeholder="Tên học phần">
                    <input type="number" id="so_tin_chi" name="so_tin_chi" placeholder="Số tín chỉ" min = "1">
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
                    <button type="submit">Nhập</button>
                </form>
            </div>
        </div>
    </div>
    <?php
        require "../home_admin/footer.php";
    ?>
</body>
</html>

