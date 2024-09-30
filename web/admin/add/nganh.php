a<!DOCTYPE html>
<html>
<title>Nhập khoa</title>
<style>
.menu ul a #nganh{
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
            <select name="ma_khoa" id="ma_khoa">
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
            <button type="submit">Lọc</button>
            <a href="/web/admin/add/create_nganh.php" class="add_student" ><i class="fa-solid fa-plus" style="color: white;"></i></a>

        </div>
    <table>
        <caption class="note"><b>Danh sách ngành</b></caption>
        <tr id="header_row">
            <th>STT</th>
            <th>Mã ngành</th>
            <th>Tên ngành</th>
            <th>Trực thuộc khoa</th>
            <th>Tác vụ</th>
        </tr>

        <?php
            if (isset($_POST['ma_khoa']) && !empty($_POST['ma_khoa'])) {
                $ma_khoa = $_POST['ma_khoa'];
                $sql_nganh = "SELECT ma_nganh, ten_nganh, ma_khoa FROM nganh WHERE ma_khoa = '$ma_khoa'";
            } else {
            // Lấy danh sách toàn bộ sinh viên
                $sql_nganh = "SELECT ma_nganh, ten_nganh, ma_khoa FROM nganh";
            }
            
            $result_nganh = $conn->query($sql_nganh);

            if ($result_nganh->num_rows > 0) {
                $stt = 1;
                while($row = $result_nganh->fetch_assoc()) {
                    $ma_nganh = $row["ma_nganh"];
                    $ma_khoa = $row["ma_khoa"];
                    echo '<tr id="row">';
                    echo '<td>' . $stt++ . '</td>';
                    echo '<td>' . $ma_nganh . '</td>';
                    echo '<td>' . $row["ten_nganh"] . '</td>';
                    $sql_khoa = "SELECT  ten_khoa FROM khoa where ma_khoa = '$ma_khoa'";
                    $result_khoa = $conn->query($sql_khoa);
                        
                    if ($result_khoa->num_rows > 0) {
                        // output data of each row
                    while($row = $result_khoa->fetch_assoc()) {
                            echo '<td>' . $row["ten_khoa"] . '</td>';
                        }
                    }
                    echo '<td id="task"><a href="update_nganh.php?ma_nganh=' . $ma_nganh . '""><i class="fa-solid fa-pen"></i></a><a href="delete.php?ma_nganh=' . $ma_nganh . '"><i class="fa-solid fa-trash"></i></a></td>';
                    
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

