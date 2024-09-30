<!DOCTYPE html>
<html>
<title>Nhập khoa</title>
<style>
.menu ul a #khoa{
    background-color: #0F6CBF;
    color: #FFFFFF;

}

.update{
    margin-left: 900px;
    margin-top: 20px;
    border-radius: 5px;
    border: 1px solid grey;
    background-color: #4CB0EA;  
    color: #FFFFFF;
    height: 30px;
    width: 100px;
    cursor: pointer;
}
 
</style>
<body>
    <div class="container">
        <?php
            require "../home_admin/header.php";
        ?>
        <div class="menu_add">
            <li>
            <?php
                require "../home_admin/menu.php";
            ?> </li>
<form method="post" action="">
    <table>
        <caption class="note"><b>Danh sách khoa</b></caption>
        <tr id="header_row">
            <th>STT</th>
            <th>Mã khoa</th>
            <th>Tên khoa</th>
            <th>Tác vụ</th>
        </tr>

        <?php
            $sql_khoa = "SELECT ma_khoa, ten_khoa FROM khoa";
            $result_khoa = $conn->query($sql_khoa);

            if ($result_khoa->num_rows > 0) {
                $stt = 1;
                while($row = $result_khoa->fetch_assoc()) {
                    $ma_khoa = $row["ma_khoa"];
                    echo '<tr id="row">';
                    echo '<td>' . $stt++ . '</td>';
                    echo '<td>' . $ma_khoa . '</td>';
                    echo '<td><p class="my">' . $row["ten_khoa"]  . '</p><input class="myDIV" id="ten_khoa" name="ten_khoa_moi[' . $ma_khoa . ']" type="text" style="width: 925px;"></td>';
                    echo '<td id="task"><a href="/web/admin/add/create_khoa.php"><i class="fa-solid fa-plus"></i></a><i class="fa-solid fa-pen" onclick="myFunction(this)"></i><a href="delete.php?ma_khoa=' . $ma_khoa . '"><i class="fa-solid fa-trash"></i></a></td>';
                    
                    echo '</tr>';
                }
            } else {
                echo "0 results";
            }
        ?>
        <?php

            if (!empty($_POST['ma_khoa_moi']) || !empty($_POST['ten_khoa_moi'])) {

                // Cập nhật tên khoa
                foreach ($_POST['ten_khoa_moi'] as $ma_khoa => $ten_khoa_moi) {
                    if ($ten_khoa_moi !== '') {
                        $sql_ten_khoa = "UPDATE khoa SET ten_khoa = '$ten_khoa_moi' WHERE ma_khoa = '$ma_khoa'";
                        if (!$conn->query($sql_ten_khoa)) {
                            echo "Lỗi cập nhật tên khoa: " . $conn->error . "<br>";
                        }
                    }
                }
            }
        ?>
    </table>
    <button type="submit" class = "update">Cập nhật</button>
</form>

</div>
        <div class = "space"></div>
        <script>
            function myFunction(button) {
                var row = button.parentElement.parentElement;
        
                var paragraphs = row.querySelectorAll(".my");
                var inputs = row.querySelectorAll(".myDIV");
        
                for (var i = 0; i < paragraphs.length; i++) {
                    if (paragraphs[i].style.display === "none") {
                        paragraphs[i].style.display = "block";
                        inputs[i].style.display = "none";
                    } else {
                        paragraphs[i].style.display = "none";
                        inputs[i].style.display = "block";
                    }
                }
                
            }
        </script>
    
    </div>
    </form>  
    <?php
        require "../home_admin/footer.php";
    ?>
</body>
</html>

