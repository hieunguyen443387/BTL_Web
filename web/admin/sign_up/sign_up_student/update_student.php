<?php

include('../../home_admin/config.php');

if (isset($_GET['msv'])) {
    $msv = $_GET['msv'];
    if (!empty($_POST['ho_dem']) || !empty($_POST['ten']) || 
    !empty($_POST['sdt']) ||!empty($_POST['email']) ||  
    !empty($_POST['ngay_sinh']) || !empty($_POST['gioi_tinh']) || !empty($_POST['ma_lop'])|| 
    !empty($_POST['ma_khoa']) || !empty($_POST['ma_nganh']) || !empty($_POST['ma_chuyen_nganh']) ) {
        $ho_dem = $_POST['ho_dem'];
        $ten = $_POST['ten'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $ngay_sinh = $_POST['ngay_sinh'];
        $gioi_tinh = $_POST['gioi_tinh'];
        $ma_lop = $_POST['ma_lop'];
        $ma_khoa = $_POST['ma_khoa'];
        $ma_nganh = $_POST['ma_nganh'];
        $ma_chuyen_nganh = $_POST['ma_chuyen_nganh'];

        $sql_update = "UPDATE sinh_vien SET ho_dem = '$ho_dem', ten = '$ten', sdt = '$sdt', email = '$email', ngay_sinh = '$ngay_sinh', gioi_tinh = '$gioi_tinh', ma_lop = '$ma_lop'  WHERE msv = '$msv'";
        $sql_update_sinh_vien_lop = "UPDATE danh_sach_lop SET  ma_lop = '$ma_lop'  WHERE msv = '$msv'";
        $sql_update_sinh_vien_khoa = "UPDATE danh_sach_sinh_vien_khoa SET  ma_khoa = '$ma_khoa'  WHERE msv = '$msv'";
        $sql_update_sinh_vien_nganh = "UPDATE danh_sach_sinh_vien_nganh SET  ma_nganh = '$ma_nganh'  WHERE msv = '$msv'";
        $sql_update_sinh_vien_chuyen_nganh = "UPDATE danh_sach_sinh_vien_chuyen_nganh SET  ma_chuyen_nganh = '$ma_chuyen_nganh'  WHERE msv = '$msv'";

        if ($conn->query($sql_update) === TRUE &&$conn->query($sql_update_sinh_vien_khoa) === TRUE 
        &&  $conn->query($sql_update_sinh_vien_lop) === TRUE 
        && $conn->query($sql_update_sinh_vien_nganh) === TRUE && $conn->query($sql_update_sinh_vien_chuyen_nganh) === TRUE) {
            
            header("Location: /web/admin/sign_up/sign_up_student/quan_ly_sinh_vien.php");
            exit();
        } else {
            echo "Lỗi khi xóa giảng viên: " . $conn->error;
        }
    } 
}

$sql_sinh_vien = "SELECT msv, ho_dem, ten, ma_lop, sdt, email, ngay_sinh, gioi_tinh FROM sinh_vien WHERE msv = '$msv'";
$result_sinh_vien = $conn->query($sql_sinh_vien);
if ($result_sinh_vien->num_rows > 0) {
    $stt = 1;
    while($row = $result_sinh_vien->fetch_assoc()) {
        $msv = $row["msv"];
        $ho_dem = $row["ho_dem"];
        $ten = $row["ten"];
        $ma_lop = $row["ma_lop"];
        $sdt = $row["sdt"];
        $email = $row["email"];
        $ngay_sinh = $row["ngay_sinh"];
        $gioi_tinh = $row["gioi_tinh"];
    }
}

$sql_sinh_vien_khoa = "SELECT msv, ma_khoa FROM danh_sach_sinh_vien_khoa WHERE msv = '$msv'";
$result_sinh_vien_khoa = $conn->query($sql_sinh_vien_khoa);
if ($result_sinh_vien_khoa->num_rows > 0) {
    while($row = $result_sinh_vien_khoa->fetch_assoc()) {
        $msv = $row["msv"];
        $ma_khoa = $row["ma_khoa"];
    }
}

$sql_sinh_vien_nganh = "SELECT msv, ma_nganh FROM danh_sach_sinh_vien_nganh WHERE msv = '$msv'";
$result_sinh_vien_nganh = $conn->query($sql_sinh_vien_nganh);
if ($result_sinh_vien_nganh->num_rows > 0) {
    while($row = $result_sinh_vien_nganh->fetch_assoc()) {
        $msv = $row["msv"];
        $ma_nganh = $row["ma_nganh"];
    }
}

$sql_sinh_vien_chuyen_nganh = "SELECT msv, ma_chuyen_nganh FROM danh_sach_sinh_vien_chuyen_nganh WHERE msv = '$msv'";
$result_sinh_vien_chuyen_nganh = $conn->query($sql_sinh_vien_chuyen_nganh);
if ($result_sinh_vien_chuyen_nganh->num_rows > 0) {
    while($row = $result_sinh_vien_chuyen_nganh->fetch_assoc()) {
        $msv = $row["msv"];
        $ma_chuyen_nganh = $row["ma_chuyen_nganh"];
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
        <title>Trang cập nhật tài khoản sinh viên</title>
    </head>
        <body>
            
        
        <form action="" method="post">

            <div class="create">
                <h2>Cập nhật tài khoản: <?php echo $msv; ?></h2>

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
            
            <br>
            <select name="ma_khoa" id="ma_khoa" >
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
            
        <!-- Lọc theo chuyên ngành -->
            <select name="ma_chuyen_nganh" id="ma_chuyen_nganh">
                <option value="<?php echo $ma_chuyen_nganh; ?>">Lọc theo chuyên ngành</option>
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
                <option value="<?php echo $ma_lop; ?>">Lọc theo lớp</option>
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
                    <button type="submit">Cập nhật</button>
                </div>
                    
            </div>
        </form>

    </body>
    
    <footer>
        <p><a href="/web/admin/home_admin/home_admin.php">Trang chủ</a></p>
    </footer>
</html>