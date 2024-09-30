<!DOCTYPE html>
<html>
<title>Nhập khoa</title>
<style>
    .menu ul a #khoa{
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
            <li class="add">
                <form action="create_khoa.php" method="post">
                    <input type="text" id="ma_khoa" name="ma_khoa" placeholder="Mã khoa">
                    <input type="text" id="ten_khoa" name="ten_khoa" placeholder="Tên khoa">
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

<?php

include('../home_admin/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $ma_khoa = $_POST['ma_khoa'];
    $ten_khoa = $_POST['ten_khoa'];

    if (empty($_POST['ma_khoa']) || empty($_POST['ten_khoa'])) {
        echo'Không được để trống';
    } else{
        $sql = "SELECT ma_khoa FROM khoa WHERE ma_khoa = '$ma_khoa'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Đã tồn tại";
        } else {

            $sql = "INSERT INTO khoa (ma_khoa, ten_khoa) 
            VALUES ('$ma_khoa', '$ten_khoa')";

            if ($conn->query($sql) === TRUE) {
                echo "Dữ liệu đã được thêm thành công!";
                header("Location: /web/admin/add/khoa.php");
            } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();

?> 