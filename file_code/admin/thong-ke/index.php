<?php

function adminContent()
{
   
    echo "<div class='container'>";
    echo "<div class='product-content--link' align='left' style='margin-bottom: 30px'>";
    echo "<h1 class='admin-product--title'>Thống kê theo thời gian</h1>
    <a href='../index.php' class='product-link--edit'>
    <i class='fa-solid fa-arrow-left'></i><span> Quay lại</span>
    </a>
</div>";

    echo "<div class='admin-menu'>";
    ?>
   <p> Thống kê đơn hàng theo : <span id='text-date'> </span> </p>
   <p>
        <select class="select-date">
            <option value="7ngay">7 Ngày qua</option>
            <option value="28ngay">28 Ngày qua</option>
            <option value="90ngay">90 Ngày qua</option>
            <option value="365ngay">365 Ngày qua</option>
        </select>
   </p>
    <?php
    echo '<div id="time" style="height: 250px; width:900px"></div>';

    echo "</div>";
    echo "</div>";
}
include("../../block/connection.php");
include("../../block/global.php");
include("../../block/admin-block.php");


?>
