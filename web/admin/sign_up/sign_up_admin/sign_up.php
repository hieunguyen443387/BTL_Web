<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/web/admin/sign_up/sign_up.css">
        <title>Trang đăng kí tài khoản cán bộ phòng đào tạo</title>
    </head>
        <body>

        
        <form action="sign_up.php" method="post">

            <div class="create">
            <h2>Đăng kí tài khoản cán bộ phòng đào tạo</h2>
                
                <input type="text" id="ho_dem" name="ho_dem" placeholder="Họ đệm" class="name">
                <input type="text" id="ten" name="ten" placeholder="Tên" class="name">
                <input type="tel" id="sdt" name="sdt" placeholder="Số di động" size="10">
                <input type="email" id="email" name="email" placeholder="Email">
                <input type="password" id="mat_khau" name="mat_khau" placeholder="Mật khẩu">
                <input type="date" id="ngay_sinh" name="ngay_sinh" placeholder="Ngày sinh">
                <input type="text" id="id_admin" name="id_admin" placeholder="Mã đăng nhập">

                <div class="gender">
                    <input type="radio" id="male" name="gender" value="Nam">
                    <label for="male">Nam</label>
                    <input type="radio" id="female" name="gender" value="Nữ">
                    <label for="female">Nữ</label><br>
                        
                </div>
                    
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

</head>
        

<?php
include('../../home_admin/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Lấy dữ liệu từ form
    $id_admin = $_POST['id_admin'];
    $ho_dem = $_POST['ho_dem'];
    $ten = $_POST['ten'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $mat_khau = $_POST['mat_khau'];
    $ngaysinh = $_POST['ngay_sinh'];
    $gioitinh = $_POST['gender'];

    if (empty($_POST['id_admin']) || empty($_POST['ho_dem']) || empty($_POST['ten']) || 
    empty($_POST['sdt']) || empty($_POST['email']) || empty($_POST['mat_khau']) || 
    empty($_POST['ngay_sinh']) || empty($_POST['gender'])) {
        echo'Không được để trống';
    }else{
        $sql = "SELECT id_admin FROM admin WHERE id_admin = '$id_admin'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "Đã tồn tại";
        } else {

            // Chèn dữ liệu vào bảng
            $sql = "INSERT INTO admin (id_admin, ho_dem, ten, sdt, email, mat_khau, ngay_sinh, gioi_tinh) 
            VALUES ('$id_admin', '$ho_dem', '$ten', '$sdt', '$email', '$mat_khau', '$ngaysinh', '$gioitinh')";

            if ($conn->query($sql) === TRUE) {
                echo "Thành công ";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>

