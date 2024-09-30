<!DOCTYPE html>
<html>
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="app.js"></script>
<style>
.add_student{
    text-decoration: none; 
    background-color: #219DE5; 
    color: white; 
    display: inline-block; 
    width: 100px; 
    height: 50px; 
    border-radius: 5px;
    border: 2px solid grey;
    text-align: center; 
    line-height: 50px;
}
</style>
<body>
    <div class="container">
        <?php
            require "../../home_admin/header.php";
            require "../../home_admin/menu.php";
        ?>
        <main>
        <form method="post" action="">
            
                
        <div class = "filter">
            <?php
                require "filter.php";
            ?>
            <a href="sign_up.php" class="add_student" ><i class="fa-solid fa-plus" style="color: white;"></i></a>

        </div>
            
            <table style = "margin_top = 100px">
            <!-- Mở danh sách sinh viên -->
            <caption class="note"><b>Danh sách sinh viên</b></caption>
            <tr id="header_row">
                <th>STT</th>
                <th>Mã sinh viên</th>
                <th>Sinh viên</th>
                <th>Lớp</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Tác vụ</th>
            </tr>
            <?php
                
                // Lấy danh sách sinh viên theo khoa
                if (isset($_POST['ma_khoa']) && !empty($_POST['ma_khoa'])) {
                    $ma_khoa = $_POST['ma_khoa'];
                    $sql_sinh_vien = "SELECT msv, ho_dem, ten, ma_lop, sdt, email, ngay_sinh, gioi_tinh FROM sinh_vien WHERE msv IN 
                    (SELECT msv FROM danh_sach_sinh_vien_khoa WHERE ma_khoa = '$ma_khoa')";
                }

                // Lấy danh sách sinh viên theo ngành
                elseif (isset($_POST['ma_nganh']) && !empty($_POST['ma_nganh'])) {
                    $ma_nganh = $_POST['ma_nganh'];
                    $sql_sinh_vien = "SELECT msv, ho_dem, ten, ma_lop, sdt, email, ngay_sinh, gioi_tinh FROM sinh_vien WHERE msv IN 
                    (SELECT msv FROM danh_sach_sinh_vien_nganh WHERE ma_nganh = '$ma_nganh')";
                    
                }

                // Lấy danh sách sinh viên theo ngành
                elseif (isset($_POST['ma_chuyen_nganh']) && !empty($_POST['ma_chuyen_nganh'])) {
                    $ma_chuyen_nganh = $_POST['ma_chuyen_nganh'];
                    $sql_sinh_vien = "SELECT msv, ho_dem, ten, ma_lop, sdt, email, ngay_sinh, gioi_tinh FROM sinh_vien WHERE msv IN  
                    (SELECT msv FROM danh_sach_sinh_vien_chuyen_nganh WHERE ma_chuyen_nganh = '$ma_chuyen_nganh')";
                    
                    
                }

                // Lấy danh sách sinh viên theo lớp
                elseif (isset($_POST['ma_lop']) && !empty($_POST['ma_lop'])) {
                    $ma_lop = $_POST['ma_lop'];
                    $sql_sinh_vien = "SELECT msv, ho_dem, ten, ma_lop, sdt, email, ngay_sinh, gioi_tinh FROM sinh_vien WHERE ma_lop = '$ma_lop'";
                } 

                // Lấy danh sách toàn bộ sinh viên
                else {
                    $sql_sinh_vien = "SELECT msv, ho_dem, ten, ma_lop, sdt, email, ngay_sinh, gioi_tinh FROM sinh_vien";
                }

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
                        echo '<tr id="row">';
                        echo '<td style="width: 50px;">' . $stt++ . '</td>';
                        echo '<td style="width: 100px;">' . $msv . '</td>';
                        echo '<td style="width: 235px;">' . $ho_dem  . " " . $ten . '</td>';
                        echo '<td>' . $ma_lop . '</td>';
                        echo '<td>' . $sdt . '</td>';
                        echo '<td>' . $email . '</td>';
                        echo '<td>' . $ngay_sinh . '</td>';
                        echo '<td>' . $gioi_tinh . '</td>';


                        //Tác vụ
                        echo '<td id="task"><a href="/web/admin/sign_up/sign_up_student/update_student.php?msv=' . $msv . '""><i class="fa-solid fa-pen"></i></a><a href="../delete.php?msv=' . $msv . '"><i class="fa-solid fa-trash"></i></a></td>';
                        
                        echo '</tr>';
                    }
                } else {
                    echo "0 results";
                }
            ?>
            </table>
            <div class = "space"></div>
        </form>
        </main>
    </div>
    
    <?php
        require "../../home_admin/footer.php";
    ?>
    
</body>
</html>