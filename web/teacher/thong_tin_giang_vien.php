<?php 
    include('../home/home/config.php');

    $mgv = $_SESSION['mgv'];
    $sql = "SELECT mgv, ho_dem, ten, sdt, gioi_tinh, ngay_sinh, email, ma_khoa FROM giang_vien WHERE mgv = '$mgv'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $ho_dem = $row["ho_dem"];
            $ten = $row["ten"];
            $sdt = $row["sdt"];
            $email = $row["email"];
            $gioi_tinh = $row["gioi_tinh"];
            $ngay_sinh = $row["ngay_sinh"];
            $_SESSION['ma_khoa'] = $row["ma_khoa"];
            $ma_khoa = $_SESSION["ma_khoa"];
        }
    } else {
        echo "Không tìm được tài khoản";
    }

    $ma_khoa = $_SESSION["ma_khoa"];
    $sql_khoa = "SELECT ten_khoa FROM khoa WHERE ma_khoa = '$ma_khoa'";
    $result_khoa = $conn->query($sql_khoa);

    if ($result_khoa->num_rows > 0) {
        
        while($row = $result_khoa->fetch_assoc()) {
            $ten_khoa = $row["ten_khoa"];
        }
    } else {
        echo "Không tìm được tài khoản";
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home_student.css">
    <title>Cổng thông tin Đào tạo đại học</title>
</head>
<body>
    <div class="teacher_infor">
        <h3>Thông tin giảng viên</h3>
        <hr>
        <ul>
            <li>Mã GV: <?php echo $mgv ; ?></li>
            <li>Họ và tên: <?php echo $ho_dem. " " . $ten ; ?></li>
            <li>Ngày sinh: <?php echo $ngay_sinh ; ?></li>
            <li>Giới tính: <?php echo $gioi_tinh ; ?></li>
            <li>Điện thoại: <?php echo $sdt ; ?></li>
            <li>Email: <?php echo $email ; ?></li>
            <li>Khoa: <?php echo $ten_khoa ; ?></li>
        </ul>
    </div>
    
</body>
</html>