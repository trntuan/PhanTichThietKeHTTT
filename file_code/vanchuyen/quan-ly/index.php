<?php

function adminContent()
{
    echo "<div class='container'>";
    echo "<div class='admin-menu'>";
    echo "<a class='admin-menu--item' href='../../vanchuyen/hoa-don-can'>
    <i class='fa fa-receipt'></i>
    <p>Hóa đơn đã sẵn sàng nhận</p>
    </a>";
    echo "<a class='admin-menu--item' href='../../vanchuyen/hoa-don-nhan'>
    <i class='fa fa-receipt'></i>
    <p>Hóa đơn đang nhận</p>
    </a>";
    
    
   
    echo "</div>";
    echo "</div>";
}
include("../../block/connection.php");
include("../../block/global.php");
include("../../block/vanchuyen.php");


?>
