<?php

function adminContent()
{
    echo "<div class='container'>";
    echo "<div class='admin-menu'>";
    echo "<a class='admin-menu--item' href='../../phache/hoa-don-can'>
    <i class='fa fa-receipt'></i>
    <p>Hóa đơn đang đặt</p>
    </a>";
    echo "<a class='admin-menu--item' href='../../phache/hoa-don-nhan'>
    <i class='fa fa-receipt'></i>
    <p>Hóa đơn đang pha chế</p>
    </a>";
    
    
   
    echo "</div>";
    echo "</div>";
}
include("../../block/connection.php");
include("../../block/global.php");
include("../../block/phache.php");


?>
