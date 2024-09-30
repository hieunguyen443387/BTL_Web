<!DOCTYPE html>
<html>
<title>Nhập sinh viên</title>
<style>
    .menu ul a .lop{
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
                <form action="them_sinh_vien.php" method="post">
                    <br>
                    <select name="msv" id="msv">
                        <option value="">-- Chọn sinh viên --</option>
                        <?php
                            include('../home_admin/config.php');
                            $sql = "SELECT msv, ho_dem, ten FROM sinh_vien";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc())  {
                                    echo '<option value="' . $row['msv'] . '">' . $row['ho_dem'] . " " . $row['ten'] . '</option>';
                                }
                            }
                        ?>
                    </select>
                    <br><br>
                    <select name="ma_nhom" id="ma_nhom">
                        <option value="">-- Chọn nhóm --</option>
                        <?php
                            $sql = "SELECT ma_nhom FROM nhom_hoc_phan";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['ma_nhom'] . '">' . $row['ma_nhom'] . '</option>';
                                }
                            }
                        ?>
                    </select>
                    <br><br>
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $ma_nhom = $_POST['ma_nhom'];
    $msv = $_POST['msv'];

    // Kiểm tra xem các trường có trống hay không
    if (empty($ma_nhom) || empty($msv)) {
        echo 'Vui lòng chọn đầy đủ thông tin.';
    } else {
        // Lấy thông tin họ tên từ cơ sở dữ liệu
        $sql_sinh_vien = "SELECT ho_dem, ten FROM sinh_vien WHERE msv = '$msv'";
        $result = $conn->query($sql_sinh_vien);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ho_dem = $row['ho_dem'];
            $ten = $row['ten'];

            // Kiểm tra sự tồn tại của cả msv và ma_nhom trong bảng danh_sach_sinh_vien
            $sql_danh_sach_sinh_vien = "SELECT * FROM danh_sach_sinh_vien WHERE msv = '$msv' AND ma_nhom = '$ma_nhom'";
            $result_danh_sach_sinh_vien  = $conn->query($sql_danh_sach_sinh_vien);

            if ($result_danh_sach_sinh_vien->num_rows > 0) {
                echo "Đã tồn tại sinh viên này trong nhóm này.";
            } else {

                // Thực hiện chèn dữ liệu vào bảng danh_sach_sinh_vien
                $sql_insert = "INSERT INTO danh_sach_sinh_vien (ma_nhom, msv, ho_dem, ten) 
                            VALUES ('$ma_nhom', '$msv', '$ho_dem', '$ten')";

                if ($conn->query($sql_insert) === TRUE) {
                    echo "Dữ liệu đã được thêm thành công!";
                } else {
                    echo "Lỗi: " . $sql_insert . "<br>" . $conn->error;
                }
            } 
        } else {
            echo "Không tìm thấy sinh viên.";
        }
    }
}

$conn->close();
?>