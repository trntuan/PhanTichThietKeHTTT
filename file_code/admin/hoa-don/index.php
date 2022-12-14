<?php
 include("../../block/connection.php");
if(isset($_POST["tt"]))
{
    if(isset($_POST["ma_hd"]))
    {
        $dsHD = $_POST["ma_hd"];
        
        foreach ($dsHD as $value) {
            $query = "UPDATE `don_hang` SET `tinh_trang_tt`='1' WHERE don_hang.ma_donhang = '$value'";
            $result = mysqli_query($conn, $query);
        }
    }
}
if(isset($_POST["gh"]))
{
    if(isset($_POST["ma_hd"]))
    {
        $dsHD = $_POST["ma_hd"];
        
        foreach ($dsHD as $value) {
            $query = "UPDATE `don_hang` SET `tinh_trang_giaohang`='1' WHERE don_hang.ma_donhang = '$value'";
            $result = mysqli_query($conn, $query);
        }
    }
}
function adminContent()
{
    include("../../block/connection.php");
    
    echo '<div class="container hd" >
        <form action="" method="post">
            <h3 class="admin-product--title size-title">Đơn hàng</h3>
            <div class="receipt-comand">
                <div class="receipt-comand--title">Tất cả đơn hàng</div>
                <div class="comand--btn">
               
                </div>
            </div>
            <div class="table-overflow">
            <table class="receipt-table" >
                <tr class="receipt-title">
                    <td><input type="checkbox" class="check-all" /></td>
                    <td>Mã Đơn</td>
                    <td>Khách hàng</td>
                    <td>Ngày đặt</td>
                    <td>Trạng thái</td>
                    <td>Tổng tiền</td>
                    <td></td>
                </tr>
                ';
                if(!isset($_GET['page']))
                {
                    $_GET['page'] = 1;
                }
                $rowPerPage = 8;
                $offset = ($_GET['page']-1)* $rowPerPage;
                $query = "SELECT hoadon.IdHoaDon, khachhang.TenKH,khachhang.HoKH,hoadon.TrangThai,hoadon.TongTien,hoadon.NgayDat, cthoadon.SoLuong,sanpham.Gia FROM hoadon JOIN khachhang on khachhang.idKH = hoadon.IdKhachHang JOIN cthoadon on hoadon.IdHoaDon = cthoadon.IdHoaDon JOIN sanpham on sanpham.IDSP = cthoadon.MaSP WHERE hoadon.TrangThai ='5' OR hoadon.TrangThai ='6'   GROUP by hoadon.IdHoaDon ";
                $result = mysqli_query($conn, $query);
                $numRow = mysqli_num_rows($result);
                $maxPage = ceil($numRow / $rowPerPage); 
                $query = "SELECT hoadon.IdHoaDon, khachhang.TenKH,khachhang.HoKH,hoadon.TrangThai,hoadon.TongTien,hoadon.NgayDat, cthoadon.SoLuong,sanpham.Gia FROM hoadon JOIN khachhang on khachhang.idKH = hoadon.IdKhachHang JOIN cthoadon on hoadon.IdHoaDon = cthoadon.IdHoaDon JOIN sanpham on sanpham.IDSP = cthoadon.MaSP  WHERE hoadon.TrangThai ='5' OR hoadon.TrangThai ='6'  GROUP by hoadon.IdHoaDon LIMIT $offset, $rowPerPage";
                $result =  mysqli_query($conn, $query);
                if($result){
                    if(mysqli_num_rows($result) != 0)
                    {
                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<tr>";
                            echo  '<td><input type="checkbox" class="check-hd" name="ma_hd[]" value="'.$row["IdHoaDon"].'"></td>';
                            echo "<td>$row[IdHoaDon]</td>";
                            echo "<td>".$row['HoKH']." ".$row['TenKH']."</td>";
                            echo "<td>$row[NgayDat]</td>";
                            echo "<td>";
                            if($row["TrangThai"] == 5)
                                echo '<span class="paid">Đã thanh toán</span>';
                            else echo '<span class="un-paid">Giao Thất bại</span>';
                            echo "</td>";
                            // echo "<td>";
                            // if($row["TrangThai"] == 4)
                            //     echo '<span class="paid">Đã giao hàng</span>';
                            // else echo '<span class="un-ship">Chưa giao hàng</span>';
                            // echo "</td>";
                            echo "<td> <span class='money'>".$row['TongTien']." </span> VNĐ</td>";
                            echo "<td><a href='./chi-tiet-hoa-don.php?mahd=".$row["IdHoaDon"]."' class='receipt-link'>Xem chi tiết</a></td>";
                            echo "</tr>";
                        }
                    }      
                    echo "</div>";
                }  
                echo '
            </table>';
            if($maxPage != 1)
                {
                    echo "<div class='phanTrang'>";
                    if($maxPage > 4)
                    {
                        $firstPage = 1;
                        echo "<a class='link-btn' href=".$_SERVER ['PHP_SELF']."?page=".$firstPage.">";
                        echo "<img src='./assets/images/angle-double-left-solid.png' alt=''>";
                        echo "</a>"; 
                        $prePage = $_GET['page'] - 1;
                        if($prePage === 0)
                        {
                            $prePage = $maxPage;
                        }
                        echo "<a class='link-btn' href=".$_SERVER ['PHP_SELF']."?page=".$prePage.">";
                        echo "<img src='./assets/images/angle-left-solid.png' alt=''>";
                        echo "</a>";
                    }
                    if($maxPage > 4)
                    {
                        if($_GET['page'] == 1)
                        {
                            $i = $_GET['page'];
                            echo '<b> '.$i.' </b>';
                            echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?page=".++$i."> ".$i." </a>";
                            echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?page=".++$i."> ".$i." </a>";
                            echo "<span class='page-dot'>...</span>";
                            echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?page=".$maxPage."> ".$maxPage." </a>";
                        }
                        else {
                            if($_GET['page'] == $maxPage)
                            {
                                echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?page=1>1</a>";
                                $i = $_GET['page']-3;
                                echo "<span class='page-dot'>...</span>";
                                echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?page=".++$i."> ".$i." </a>";
                                echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?page=".++$i."> ".$i." </a>";
                                echo '<b> '.$maxPage.' </b>';
                            }
                            else {
                                if($_GET['page'] > 2)
                                {
                                    echo "<span class='page-dot'>...</span>";
                                }
                                for($i = $_GET['page']-1; $i <= $_GET['page']+1; $i++ ){
                                    
                                    if($i == $_GET['page'])
                                    echo '<b> '.$i.' </b>';
                                    else echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?page=".$i."> ".$i." </a>";
                                }
                                if($_GET['page'] < $maxPage - 1)
                                {
                                    echo "<span class='page-dot'>...</span>";
                                }
                            }
                        }
                    }
                    else {
                        for($i = 1; $i <= $maxPage; $i++ ){
                            if($i == $_GET['page'])
                            echo '<b> '.$i.' </b>';
                            else echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?page=".$i."> ".$i." </a>";
                        }
                    }
                    
                    if($maxPage > 4)
                    {
                        $nextPage = $_GET['page'] + 1;
                        if($nextPage == $maxPage+1)
                        {

                            $nextPage = 1;
                        }
                        echo "<a class='link-btn' href=".$_SERVER ['PHP_SELF']."?page=".$nextPage.">";
                        echo "<img src='./assets/images/angle-right-solid.png' alt=''>";
                        echo "</a>"; 
                        $lastPage = $maxPage;
                        echo "<a class='link-btn' href=".$_SERVER ['PHP_SELF']."?page=".$lastPage.">";
                        echo "<img src='./assets/images/angle-double-right-solid.png' alt=''>";
                        echo "</a>";  
                    }
                }
                echo'
            </div>
        </form>
    </div>';
}
include("../../block/connection.php");
include("../../block/global.php");
include("../../block/admin-block.php");


?>
<!-- 
<button type="submit" name="tt">Xác nhận thanh toán</button>
                    <button type="submit" name="gh">Xác nhận giao hàng</button> -->