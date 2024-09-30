<?php 
    include('../home/home/config.php');

    $msv = $_SESSION['msv'];
    $sql = "SELECT msv, ho_dem, ten, sdt, gioi_tinh, ngay_sinh, email, ma_lop FROM sinh_vien WHERE msv = '$msv'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $msv = $row["msv"];
            $ho_dem = $row["ho_dem"];
            $ten = $row["ten"];
            $sdt = $row["sdt"];
            $email = $row["email"];
            $gioi_tinh = $row["gioi_tinh"];
            $ngay_sinh = $row["ngay_sinh"];
            $_SESSION['ma_lop'] = $row["ma_lop"];
            $ma_lop = $_SESSION["ma_lop"];
        }
    } else {
        echo "Không tìm được tài khoản";
    }

    $ma_lop = $_SESSION["ma_lop"];
    $sql_lop = "SELECT ma_lop, ma_chuyen_nganh, mgv FROM lop WHERE ma_lop = '$ma_lop'";
    $result_lop = $conn->query($sql_lop);

    if ($result_lop->num_rows > 0) {
        // output data of each row
        while($row = $result_lop->fetch_assoc()) {
            $_SESSION['mgv'] = $row["mgv"];
            $mgv = $_SESSION["mgv"];
            $_SESSION['ma_chuyen_nganh'] = $row["ma_chuyen_nganh"];
            $ma_chuyen_nganh = $_SESSION["ma_chuyen_nganh"];
        }
    } else {
        echo "Không tìm được tài khoản";
    }


    $ma_chuyen_nganh = $_SESSION["ma_chuyen_nganh"];
    $sql_chuyen_nganh = "SELECT ma_nganh, ten_chuyen_nganh FROM chuyen_nganh WHERE ma_chuyen_nganh = '$ma_chuyen_nganh'";
    $result_chuyen_nganh = $conn->query($sql_chuyen_nganh);

    if ($result_chuyen_nganh->num_rows > 0) {
        // output data of each row
        while($row = $result_chuyen_nganh->fetch_assoc()) {
            $ten_chuyen_nganh = $row["ten_chuyen_nganh"];
            $_SESSION['ma_nganh'] = $row["ma_nganh"];
            $ma_nganh = $_SESSION["ma_nganh"];
        }
    } else {
        echo "Không tìm được tài khoản";
    }

    $ma_nganh = $_SESSION["ma_nganh"];
    $sql_nganh = "SELECT ma_khoa, ten_nganh FROM nganh WHERE ma_nganh = '$ma_nganh'";
    $result_nganh = $conn->query($sql_nganh);

    if ($result_nganh->num_rows > 0) {
        
        while($row = $result_nganh->fetch_assoc()) {
            $ten_nganh = $row["ten_nganh"];
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
    <div class="student_infor">
        <h3>Thông tin sinh viên</h3>
        <hr>
        <ul>
            <li>Mã SV: <?php echo $msv ; ?></li>
            <li>Họ và tên: <?php echo $ho_dem. " " . $ten ; ?></li>
            <li>Ngày sinh: <?php echo $ngay_sinh ; ?></li>
            <li>Giới tính: <?php echo $gioi_tinh ; ?></li>
            <li>Điện thoại: <?php echo $sdt ; ?></li>
            <li>Email: <?php echo $email ; ?></li>
        </ul>
    </div>
    <div class="course_infor">
        <h3>Thông tin khóa học</h3>
        <hr>
        <ul>
            <li>Lớp: <?php echo $ma_lop ; ?></li>
            <li>Khoa: <?php echo $ten_khoa ; ?></li>
            <li>Ngành: <?php echo $ten_nganh ; ?></li>
            <li>Chuyên ngành: <?php echo $ten_chuyen_nganh ; ?></li>
        </ul>
    </div>
    <?php
        $mgv = $_SESSION["mgv"];
        $sql_giang_vien = "SELECT ho_dem, ten, email, mgv FROM giang_vien WHERE mgv = '$mgv'";
        $result_giang_vien = $conn->query($sql_giang_vien);
    
        if ($result_giang_vien->num_rows > 0) {
            // output data of each row
            while($row = $result_giang_vien->fetch_assoc()) {
                $ho_dem = $row["ho_dem"];
                $ten = $row["ten"];
                $email = $row["email"];
            }
        } else {
            echo "Không tìm được tài khoản";
        }
        $conn->close();
    ?>
    <div class="teacher">
        <h3>Cố vấn học tập</h3>
        <hr>
        <ul>
            <li>Tài khoản: <?php echo $mgv ; ?></li>
            <li>Họ và tên: <?php echo $ho_dem. " " . $ten ; ?></li>
            <li>Email: <?php echo $email ; ?></li>
        </ul>
    </div>
    <div class="space"></div>
</body>
</html>