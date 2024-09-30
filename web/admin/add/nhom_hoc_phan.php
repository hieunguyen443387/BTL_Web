<!DOCTYPE html>
<html>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="app.js"></script>
    <script src="fetch_nhom_hoc_phan.js"></script>
<title>Nhập khoa</title>
<style>
.menu ul a #nhom_hoc_phan{
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
    margin-left: 10px;
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
            <select name="ma_hoc_phan" id="ma_hp">
                <option value="">Lọc theo học phần</option>
                <?php
                
                $sql_hoc_phan = "SELECT ma_hoc_phan, ten_hoc_phan FROM hoc_phan ";  
                $result_hoc_phan = mysqli_query($conn, $sql_hoc_phan);
                if ($result_hoc_phan->num_rows > 0) {
                    while($row = $result_hoc_phan->fetch_assoc()) {
                        echo '<option value="' . $row['ma_hoc_phan'] . '">' . $row['ten_hoc_phan'] . '</option>';
                    }
                }
                ?>
            </select>
            <button type = "submit">Lọc</button>

            <a href="/web/admin/add/create_nhom_hoc_phan.php" class="add_student" ><i class="fa-solid fa-plus" ></i></a>

        </div>
    <table>
        <caption class="note"><b>Danh sách nhóm học phần</b></caption>
        <tr id="header_row">
            <th>STT</th>
            <th>Mã môn học</th>
            <th>Mã nhóm</th>
            <th>Tên môn học</th>
            <th>Giảng viên</th>
            <th>Số lượng</th>
            <th>Tác vụ</th>
        </tr>

        <?php
            if (isset($_POST['ma_khoa']) && !empty($_POST['ma_khoa'])) {
                $ma_khoa = $_POST['ma_khoa'];
                $sql_nhom_hoc_phan = "SELECT ma_nhom, mgv, ma_lop, ma_hoc_phan, so_luong FROM nhom_hoc_phan WHERE ma_lop in
                (select ma_lop from danh_sach_lop_thuoc_khoa where ma_khoa = '$ma_khoa')";
            }
            elseif (isset($_POST['ma_nganh']) && !empty($_POST['ma_nganh'])) {
                $ma_nganh = $_POST['ma_nganh'];
                $sql_nhom_hoc_phan = "SELECT ma_nhom, mgv, ma_lop, ma_hoc_phan, so_luong FROM nhom_hoc_phan WHERE ma_lop in
                (select ma_lop from danh_sach_lop_thuoc_nganh where ma_nganh = '$ma_nganh')";
            }
            elseif (isset($_POST['ma_hoc_phan']) && !empty($_POST['ma_hoc_phan'])) {
                $ma_hoc_phan = $_POST['ma_hoc_phan'];
                $sql_nhom_hoc_phan = "SELECT ma_nhom, mgv, ma_lop, ma_hoc_phan, so_luong FROM nhom_hoc_phan WHERE ma_hoc_phan = '$ma_hoc_phan'";
            } else {
            // Lấy danh sách toàn bộ sinh viên
                $sql_nhom_hoc_phan = "SELECT ma_nhom, mgv, ma_lop, ma_hoc_phan, so_luong FROM nhom_hoc_phan";
            }
            
            $result_nhom_hoc_phan = $conn->query($sql_nhom_hoc_phan);

            if ($result_nhom_hoc_phan->num_rows > 0) {
                $stt = 1;
                while($row = $result_nhom_hoc_phan->fetch_assoc()) {
                    $ma_nhom = $row["ma_nhom"];
                    $mgv = $row["mgv"];
                    $ma_hoc_phan = $row["ma_hoc_phan"];
                    $so_luong = $row["so_luong"];
                    echo '<tr id="row">';
                    echo '<td>' . $stt++ . '</td>';
                    echo '<td>' . $ma_hoc_phan . '</td>';
                    echo '<td>' . $ma_nhom . '</td>';
                    $sql_hoc_phan = "SELECT ten_hoc_phan FROM hoc_phan where ma_hoc_phan = '$ma_hoc_phan'";
                    $result_hoc_phan = $conn->query($sql_hoc_phan);
                        
                    if ($result_hoc_phan->num_rows > 0) {
                        // output data of each row
                    while($row = $result_hoc_phan->fetch_assoc()) {
                            echo '<td>' . $row["ten_hoc_phan"] . '</td>';
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
                    echo '<td>' . $so_luong . '</td>';
                    echo '<td id="task"><a href="update_chuyen_nganh.php?ma_nhom=' . $ma_nhom . '""><i class="fa-solid fa-pen"></i><a href="delete.php?ma_nhom=' . $ma_nhom . '"><i class="fa-solid fa-trash"></i></a></td>';
                    
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

