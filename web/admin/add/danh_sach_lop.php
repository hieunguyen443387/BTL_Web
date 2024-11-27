a<!DOCTYPE html>
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

        </div>
    <table>
        <caption class="note"><b>Danh sách lớp:
        <?php
            if (isset($_GET['ma_lop'])) {
                $ma_lop = $_GET['ma_lop'];
                echo $ma_lop;   
            }
        ?>
        </b></caption>
        <tr id="header_row">
            <th>STT</th>
            <th>Mã sinh viên</th>
            <th>Sinh viên</th>
        </tr>

        <?php
            require "phan_trang.php";
            if (isset($_GET['ma_lop'])) {
                $ma_lop = $_GET['ma_lop'];
                $sql_danh_sach_lop = "SELECT ma_lop, msv, ho_dem, ten FROM sinh_vien WHERE ma_lop = '$ma_lop' LIMIT $limit OFFSET $offset";
            
            
                $result_danh_sach_lop = $conn->query($sql_danh_sach_lop);

                if ($result_danh_sach_lop->num_rows > 0) {
                    $stt = $offset + 1;
                    while($row = $result_danh_sach_lop->fetch_assoc()) {
                        $ma_lop = $row["ma_lop"];
                        $msv = $row["msv"];
                        $ho_dem = $row["ho_dem"];
                        $ten = $row["ten"];
                        echo '<tr id="row">';
                        echo '<td>' . $stt++ . '</td>';
                        echo '<td>' . $msv . '</td>';
                        echo '<td>' . $ho_dem . ' ' . $ten . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo "0 results";
                }
            }
        ?>
        
    </table>
    </form>  

</div>

<?php
    $sql_trang = "SELECT COUNT(*) AS total FROM lop";
    $result_trang = $conn->query($sql_trang);
    require "so_trang.php";
?>
          
    </div>
    
    <?php
        require "../home_admin/footer.php";
    ?>
</body>
</html>

