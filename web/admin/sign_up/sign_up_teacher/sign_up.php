<?php

include('../../home_admin/config.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $mgv = $_POST['mgv'];
    $ho_dem = $_POST['ho_dem'];
    $ten = $_POST['ten'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $mat_khau = $_POST['mat_khau'];
    $ngay_sinh = $_POST['ngay_sinh'];
    $gioi_tinh = $_POST['gender'];
    $ma_khoa = $_POST['ma_khoa'];

    if (empty($_POST['mgv']) || empty($_POST['ho_dem']) || empty($_POST['ten']) || 
    empty($_POST['sdt']) || empty($_POST['email']) || empty($_POST['mat_khau']) || 
    empty($_POST['ngay_sinh']) || empty($_POST['gender']) || empty($_POST['ma_khoa'])) {
    echo'Không được để trống';

    } else{
        $sql = "SELECT mgv FROM giang_vien WHERE mgv = '$mgv'";
        $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "Đã tồn tại";
            } else {

                // Chèn dữ liệu vào bảng
                $sql = "INSERT INTO giang_vien (mgv, ho_dem, ten, sdt, email, mat_khau, ngay_sinh, gioi_tinh, ma_khoa) 
                VALUES ('$mgv', '$ho_dem', '$ten', '$sdt', '$email', '$mat_khau', '$ngay_sinh', '$gioi_tinh', '$ma_khoa')";

                if ($conn->query($sql) === TRUE) {
                    echo "Thành công ";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/web/admin/sign_up/sign_up.css">
        <title>Trang đăng kí tài khoản giảng viên</title>
    </head>
        <body>
            
        
        <form action="sign_up.php" method="post">

            <div class="create">
                <h2>Đăng kí tài khoản giảng viên</h2>
                    <input type="text" id="ho_dem" name="ho_dem" placeholder="Họ đệm" class="name">
                    <input type="text" id="ten" name="ten" placeholder="Tên" class="name">
                    <input type="tel" id="sdt" name="sdt" placeholder="Số di động" size="10">
                    <input type="email" id="email" name="email" placeholder="Email">
                    <input type="password" id="mat_khau" name="mat_khau" placeholder="Mật khẩu">
                    <input type="date" id="ngay_sinh" name="ngay_sinh">
                    <input type="text" id="mgv" name="mgv" placeholder="Mã giảng viên">
    
            <div class="gender">
                <input type="radio" id="male" name="gender" value="Nam">
                <label for="male">Nam</label>
                <input type="radio" id="female" name="gender" value="Nữ">
                <label for="female">Nữ</label><br>
                    
            </div>

            <br>

            <br>
                <select name="ma_khoa" id="ma_khoa">
                <option value="">Chọn khoa</option>
                <?php
                    include('config.php');
                    $sql = "SELECT ma_khoa, ten_khoa FROM khoa";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                        while($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['ma_khoa'] . '">' . $row['ten_khoa'] . '</option>';
                        }
                    }
                    $conn->close()
                ?>
                </select>
                    
                <br>
                 
                <div class="submit">
                    <button type="submit">Đăng kí</button>
                </div>
                    
            </div>
        </form>

    </body>

    <footer>
        <p><a href="/web/admin/home_admin/home_admin.php">Trang chủ</a></p>
    </footer>
</html>