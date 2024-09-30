<?php

include('../../home_admin/config.php');

if (isset($_GET['id_admin'])) {
    $id_admin = $_GET['id_admin'];
    if (!empty($_POST['ho_dem']) || !empty($_POST['ten']) || 
    !empty($_POST['sdt']) ||!empty($_POST['email']) ||  
    !empty($_POST['ngay_sinh']) || !empty($_POST['gioi_tinh'])) {
        $ho_dem = $_POST['ho_dem'];
        $ten = $_POST['ten'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $ngay_sinh = $_POST['ngay_sinh'];
        $gioi_tinh = $_POST['gioi_tinh'];

        $sql_update = "UPDATE admin SET ho_dem = '$ho_dem', ten = '$ten', sdt = '$sdt', email = '$email', ngay_sinh = '$ngay_sinh', gioi_tinh = '$gioi_tinh'  WHERE id_admin = '$id_admin'";

        if ($conn->query($sql_update) === TRUE) {
            
            header("Location: /web/admin/sign_up/sign_up_admin/quan_ly_admin.php");
            exit();
        } else {
            echo "Lỗi khi xóa giảng viên: " . $conn->error;
        }
    } 
}

$sql_admin = "SELECT id_admin, ho_dem, ten, sdt, email, ngay_sinh, gioi_tinh FROM admin WHERE id_admin = '$id_admin'";
$result_admin = $conn->query($sql_admin);
if ($result_admin->num_rows > 0) {
    $stt = 1;
    while($row = $result_admin->fetch_assoc()) {
        $id_admin = $row["id_admin"];
        $ho_dem = $row["ho_dem"];
        $ten = $row["ten"];
        $sdt = $row["sdt"];
        $email = $row["email"];
        $ngay_sinh = $row["ngay_sinh"];
        $gioi_tinh = $row["gioi_tinh"];
    }
}
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/web/admin/sign_up/sign_up.css">
        <title>Trang cập nhật tài khoản giảng viên</title>
    </head>
        <body>
            
        
        <form action="" method="post">

            <div class="create">
                <h2>Cập nhật tài khoản: <?php echo $id_admin; ?></h2>

                    <input type="text" id="ho_dem" name="ho_dem" placeholder="Họ đệm" class="name" value = "<?php echo $ho_dem; ?>">
                    <input type="text" id="ten" name="ten" placeholder="Tên" class="name" value = "<?php echo $ten; ?>">
                    <input type="tel" id="sdt" name="sdt" placeholder="Số di động" size="10" value = "<?php echo $sdt; ?>">
                    <input type="email" id="email" name="email" placeholder="Email" value = "<?php echo $email; ?>">
                    <input type="date" id="ngay_sinh" name="ngay_sinh" value = "<?php echo $ngay_sinh; ?>">
    
            <div class="gender">
                <input type="radio" id="male" name="gioi_tinh" value="Nam">
                <label for="male">Nam</label>
                <input type="radio" id="female" name="gioi_tinh" value="Nữ">
                <label for="female">Nữ</label><br>
                    
            </div>

            <br>
                 
                <div class="submit">
                    <button type="submit">Cập nhật</button>
                </div>
                    
            </div>
        </form>

    </body>

    <footer>
        <p><a href="/web/admin/home_admin/home_admin.php">Trang chủ</a></p>
    </footer>
</html>