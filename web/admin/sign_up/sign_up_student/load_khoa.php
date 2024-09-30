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
