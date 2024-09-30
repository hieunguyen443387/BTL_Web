<?php

include('../home_admin/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $ma_nganh = $_POST['ma_nganh'];
    $ten_nganh = $_POST['ten_nganh'];
    $ma_khoa = $_POST['ma_khoa'];

    if (empty($_POST['ma_nganh']) || empty($_POST['ten_nganh']) || empty($_POST['ma_khoa'])) {
        echo'Không được để trống';
    } else{
        $sql = "SELECT ma_nganh FROM nganh WHERE ma_nganh = '$ma_nganh'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Đã tồn tại";
        } else {
            $sql = "INSERT INTO nganh (ma_nganh, ten_nganh, ma_khoa) 
            VALUES ('$ma_nganh', '$ten_nganh', '$ma_khoa')";

            if ($conn->query($sql) === TRUE) {
                echo "OK";
                header("Location: /web/admin/add/nganh.php");
                exit();
            } else {
                echo "Lỗi: " . $sql . "<br>" . $conn->error;
            }
        } 
    }
}


$conn->close();
?>
<!DOCTYPE html>
<html><title>Nhập ngành</title>

<style>
    .menu ul a #nganh{
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
            <?php require "../home_admin/menu.php"; ?>
            <li class="add">
                <form action="create_nganh.php" method="post">
                    <input type="text" id="ma_nganh" name="ma_nganh" placeholder="Mã ngành">
                    <input type="text" id="ten_nganh" name="ten_nganh" placeholder="Tên ngành">
                    <br>
                    <select name="ma_khoa" id="ma_khoa">
                    <option value="">-- Chọn khoa --</option>
                    <?php
                        // include('../home_admin/config.php');
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
                    <br>
                    <br>
                    <button type="submit">Nhập</button>
                </form>
            </li>
        </div>
    </div>
    <?php
        require "../home_admin/footer.php";
    ?>
</body>
</html>

