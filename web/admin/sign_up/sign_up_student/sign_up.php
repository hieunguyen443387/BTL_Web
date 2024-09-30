<?php
include('../../home_admin/config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Lấy dữ liệu từ form
    $msv = $_POST['msv'];
    $ho_dem = $_POST['ho_dem'];
    $ten = $_POST['ten'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $mat_khau = $_POST['mat_khau'];
    $ngay_sinh = $_POST['ngay_sinh'];
    $gioi_tinh = $_POST['gender'];
    $ma_lop = $_POST['ma_lop'];
    $ma_khoa = $_POST['ma_khoa'];
    $ma_nganh = $_POST['ma_nganh'];
    $ma_chuyen_nganh = $_POST['ma_chuyen_nganh'];

    if (empty($_POST['msv']) || empty($_POST['ho_dem']) || empty($_POST['ten']) || 
    empty($_POST['sdt']) || empty($_POST['email']) || empty($_POST['mat_khau']) || 
    empty($_POST['ngay_sinh']) || empty($_POST['gender']) || empty($_POST['ma_lop']) || 
    empty($_POST['ma_khoa']) || empty($_POST['ma_nganh']) || empty($_POST['ma_chuyen_nganh']) ) {
    echo'Không được để trống';
    
    } else{
        $sql1 = "SELECT msv FROM sinh_vien WHERE msv = '$msv'";
        $result1 = $conn->query($sql1);
        $sql2 = "SELECT msv, ma_lop FROM danh_sach_lop WHERE msv = '$msv' and ma_lop = '$ma_lop'";
        $result2 = $conn->query($sql2);
        $sql3 = "SELECT msv, ma_khoa FROM danh_sach_sinh_vien_khoa WHERE msv = '$msv' and ma_khoa = '$ma_khoa'";
        $result3 = $conn->query($sql3);
        $sql4 = "SELECT msv, ma_nganh FROM danh_sach_sinh_vien_nganh WHERE msv = '$msv' and ma_nganh = '$ma_nganh'";
        $result4 = $conn->query($sql4);
        $sql5 = "SELECT  msv, ma_chuyen_nganh  FROM danh_sach_sinh_vien_chuyen_nganh WHERE msv = '$msv' and ma_chuyen_nganh = '$ma_chuyen_nganh'";
        $result5 = $conn->query($sql5);
            if ($result1->num_rows > 0 || $result2->num_rows > 0 || $result3->num_rows > 0 || $result4->num_rows > 0 || $result5->num_rows > 0) {
                echo "Đã tồn tại";
            } else {

                // Chèn dữ liệu vào bảng
                $sql1 = "INSERT INTO sinh_vien (msv, ho_dem, ten, sdt, email, mat_khau, ngay_sinh, gioi_tinh, ma_lop) 
                VALUES ('$msv', '$ho_dem', '$ten', '$sdt', '$email', '$mat_khau', '$ngay_sinh', '$gioi_tinh', '$ma_lop')";
                $sql2 = "INSERT INTO danh_sach_lop (msv, ho_dem, ten, ma_lop) 
                VALUES ('$msv', '$ho_dem', '$ten', '$ma_lop')";
                $sql3 = "INSERT INTO danh_sach_sinh_vien_khoa (msv, ma_khoa) 
                VALUES ('$msv', '$ma_khoa')";
                $sql4 = "INSERT INTO danh_sach_sinh_vien_nganh (msv, ma_nganh) 
                VALUES ('$msv', '$ma_nganh')";
                $sql5 = "INSERT INTO danh_sach_sinh_vien_chuyen_nganh (msv, ma_chuyen_nganh) 
                VALUES ('$msv', '$ma_chuyen_nganh')";
                

                if ($conn->query($sql1) === TRUE and $conn->query($sql2) === TRUE and $conn->query($sql3) === TRUE and $conn->query($sql4) === TRUE and $conn->query($sql5) === TRUE ) {
                    header("Location: /web/admin/sign_up/sign_up_student/quan_ly_sinh_vien.php");
                    exit();
                } else {
                    echo "Error: " . $sql1 . $sql2 . $sql3 . $sql4 .  $sql5 .  "<br>" . $conn->error;
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
        <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="app.js"></script>
        

        <title>Trang đăng kí tài khoản sinh viên</title>
    </head>
        <body>
            
        
        <form action="sign_up.php" method="post">

            <div class="create">
                <h2>Đăng kí tài khoản sinh viên</h2>
                
                    <input type="text" id="ho_dem" name="ho_dem" placeholder="Họ đệm" class="name">
                    <input type="text" id="ten" name="ten" placeholder="Tên" class="name">
                    <input type="tel" id="sdt" name="sdt" placeholder="Số di động" size="10">
                    <input type="email" id="email" name="email" placeholder="Email">
                    <input type="password" id="mat_khau" name="mat_khau" placeholder="Mật khẩu">
                    <input type="date" id="ngay_sinh" name="ngay_sinh">
                    <input type="text" id="msv" name="msv" placeholder="Mã sinh viên">
    
            <div class="gender">
                <input type="radio" id="male" name="gender" value="Nam">
                <label for="male">Nam</label>
                <input type="radio" id="female" name="gender" value="Nữ">
                <label for="female">Nữ</label><br>
                    
            </div>

            <select name="ma_khoa" id="ma_khoa" >
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
            
        <!-- Lọc theo chuyên ngành -->
            <select name="ma_chuyen_nganh" id="ma_chuyen_nganh">
                <option value="">Lọc theo chuyên ngành</option>
                <?php
                
                $sql_chuyen_nganh = "SELECT ma_chuyen_nganh, ten_chuyen_nganh FROM chuyen_nganh";
            
                $result_chuyen_nganh = $conn->query($sql_chuyen_nganh);
                if ($result_chuyen_nganh->num_rows > 0) {
                    while($row = $result_chuyen_nganh->fetch_assoc()) {
                        echo '<option value="' . $row['ma_chuyen_nganh'] . '">' . $row['ten_chuyen_nganh'] . '</option>';
                    }
                }
                ?>
            </select>
                
                <!-- Lọc theo lớp -->
            <select name="ma_lop" id="ma_lop">
                <option value="">Lọc theo lớp</option>
                <?php
                    
                $sql_lop = "SELECT ma_lop FROM lop";

                $result_lop = $conn->query($sql_lop);

                if ($result_lop->num_rows > 0) {
                    while($row = $result_lop->fetch_assoc()) {
                        echo '<option value="' . $row['ma_lop'] . '">' . $row['ma_lop'] . '</option>';
                    }
                }
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