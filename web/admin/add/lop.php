<!DOCTYPE html>
<html>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="app.js"></script>
<title>Nhập khoa</title>
<style>
    .menu ul a #lop{
    background-color: #0F6CBF;
    color: #FFFFFF;
    
 }

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
        margin-left: 300px;
    }
 
</style>
<body>
    <div class="container">
        <?php
            require "../home_admin/header.php";
        ?>
        <div class="menu_add">
            <?php
                require "../home_admin/menu.php";
            ?> 
    <form method="post" action="">   
    
        <div class = "filter">

            <!-- Lọc theo khoa -->
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
            <button type = "submit">Lọc</button>
            <a href="/web/admin/add/create_lop.php" class="add_student" ><i class="fa-solid fa-plus" style="color: white;"></i></a>

        </div>
    <table>
        <caption class="note"><b>Danh sách lớp</b></caption>
        <tr id="header_row">
            <th>STT</th>
            <th>Mã lớp</th>
            <th>Trực thuộc chuyên ngành</th>
            <th>Giảng viên phụ trách</th>
            <th>Số lượng sinh viên</th>
            <th>Tác vụ</th>
        </tr>

        <?php
            if (isset($_POST['ma_khoa']) && !empty($_POST['ma_khoa'])) {
                $ma_khoa = $_POST['ma_khoa'];
                $sql_lop = "SELECT ma_lop, mgv, ma_chuyen_nganh, so_luong FROM lop WHERE ma_lop in
                (select ma_lop from danh_sach_lop_thuoc_khoa where ma_khoa = '$ma_khoa')";
            }
            elseif (isset($_POST['ma_nganh']) && !empty($_POST['ma_nganh'])) {
                $ma_nganh = $_POST['ma_nganh'];
                $sql_lop = "SELECT ma_lop, mgv, ma_chuyen_nganh, so_luong FROM lop WHERE ma_lop in
                (select ma_lop from danh_sach_lop_thuoc_nganh where ma_nganh = '$ma_nganh')";
            }
            elseif (isset($_POST['ma_chuyen_nganh']) && !empty($_POST['ma_chuyen_nganh'])) {
                $ma_chuyen_nganh = $_POST['ma_chuyen_nganh'];
                $sql_lop = "SELECT ma_lop, mgv, ma_chuyen_nganh, so_luong FROM lop WHERE ma_lop in
                (select ma_lop from danh_sach_lop_thuoc_chuyen_nganh where ma_chuyen_nganh = '$ma_chuyen_nganh')";
            } else {
            // Lấy danh sách toàn bộ sinh viên
            $sql_lop = "SELECT ma_lop, mgv, ma_chuyen_nganh, so_luong FROM lop";
            }
            
            $result_lop = $conn->query($sql_lop);

            if ($result_lop->num_rows > 0) {
                $stt = 1;
                while($row = $result_lop->fetch_assoc()) {
                    $ma_lop = $row["ma_lop"];
                    $mgv = $row["mgv"];
                    $so_luong = $row["so_luong"];
                    $ma_chuyen_nganh = $row["ma_chuyen_nganh"];
                    echo '<tr id="row">';
                    echo '<td>' . $stt++ . '</td>';
                    echo '<td>' . $ma_lop . '</td>';
                    $sql_chuyen_nganh = "SELECT ten_chuyen_nganh FROM chuyen_nganh where ma_chuyen_nganh = '$ma_chuyen_nganh'";
                    $result_chuyen_nganh = $conn->query($sql_chuyen_nganh);
                        
                    if ($result_chuyen_nganh->num_rows > 0) {
                        // output data of each row
                    while($row = $result_chuyen_nganh->fetch_assoc()) {
                            echo '<td>' . $row["ten_chuyen_nganh"] .  '</td>';
                        }
                    }
                    $sql_giang_vien = "SELECT ho_dem, ten FROM giang_vien where mgv = '$mgv'";
                    $result_giang_vien = $conn->query($sql_giang_vien);
                        
                    if ($result_giang_vien->num_rows > 0) {
                        // output data of each row
                    while($row = $result_giang_vien->fetch_assoc()) {
                            echo '<td>' . $row["ho_dem"] . ' ' . $row["ten"] . '</td>';
                        }
                    }
                    echo '<td>' . $so_luong .  '</td>';
                    echo '<td id="task"><a href="update_lop.php?ma_lop=' . $ma_lop . '""><i class="fa-solid fa-pen"></i><a href="delete.php?ma_lop=' . $ma_lop . '"><i class="fa-solid fa-trash"></i></a></td>';
                    
                    echo '</tr>';
                }
            } else {
                echo "0 results";
            }
        ?>
        
    </table>
    </form>  

</div>
        <div class = "space"></div>
        
    
    </div>
    
    <?php
        require "../home_admin/footer.php";
    ?>
</body>
</html>

