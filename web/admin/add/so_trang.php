<div class="phan_trang">
    <?php

    $row_trang = $result_trang->fetch_assoc();
    $num_rows = $row_trang['total']; // Tổng số bản ghi trong bảng hoc_phan

    $total_pages = ceil($num_rows / $limit);  // Tổng số trang

    // Hiển thị phân trang
    if ($total_pages > 1) {
        if ($current_page > 1) {
            echo '<a href="?page=' . ($current_page - 1) . '">Trang trước</a>';
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $current_page) {
                echo '<a class="active">' . $i . '</a>';
            } else {
                echo '<a href="?page=' . $i . '">' . $i . '</a>';
            }
        }

        if ($current_page < $total_pages) {
            echo '<a href="?page=' . ($current_page + 1) . '">Trang sau</a>';
        }
    }
    ?>
</div>
