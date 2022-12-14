
<?php
function adminContent()
{   
    include("../../block/connection.php");
    if(isset($_GET["mahd"]))
    {
        $maHD = $_GET["mahd"];
        echo '<div class="container">
        <h3 class="admin-product--title size-title">Chi tiết hóa đơn</h3>';
        $query = "SELECT hoadon.IdHoaDon,diachi.DiaChi, khachhang.TenKH,khachhang.GioiTinh,khachhang.Sdt, khachhang.idKH,hoadon.TrangThai,hoadon.NgayDat,hoadon.TongTien
        FROM hoadon JOIN khachhang on khachhang.idKH = hoadon.IdKhachHang JOIN  diachi on diachi.IDKhachHang = khachhang.idKH  WHERE  IdHoaDon = '$maHD'" ;
        $result = mysqli_query($conn, $query);
        if($result)
        {     
            if(mysqli_num_rows($result) != 0)
            {
                $row = mysqli_fetch_array($result);
                echo '<div class="detial-info">
                    <div class="info-customer">
                        <p class="customer-name"> <b>Họ và tên: </b>'.$row['TenKH'].' </p>';
                        echo '<p class="customer-gt"> <b>Giới tính: </b>'; echo $row['GioiTinh'];
                        echo '</p>
                        <p class="customer-phone"><b>Số điện thoại: </b>'.$row['Sdt'].'</p>
                        <p class="customer-address"><b>Địa chỉ: </b>'.$row['DiaChi'].'</p>
                    </div>
                    <div class="info-receipt">
                        <p class="receipt-id"><b>Mã hóa đơn: </b>HD000 '.$row['IdHoaDon'].'</p>
                        <p class="receipt-date"><b>Thời gian: </b>'.$row['NgayDat'].'</p>
                    </div>
                </div>';
            }

            echo '<div class="detail-content">';
                echo '
                <table>
                    <tr>
                        <td>STT</td>
                        <td>Sản phẩm</td>
                        <td>Số lượng</td>
                        <td>Giá</td>
                    </tr>';
            $query = "SELECT sanpham.Ten,sanpham.Gia,cthoadon.SoLuong FROM cthoadon JOIN sanpham on cthoadon.MaSP = sanpham.IDSP WHERE cthoadon.IdHoaDon = '$maHD'";

            $result = mysqli_query($conn, $query);
            if($result)
            {
                $sott = 1;
                $tongTien = 0;
                if(mysqli_num_rows($result) != 0)
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $tongTien = $tongTien + ($row['SoLuong']*$row['Gia']);
                        echo "<tr>";
                        echo "<td>".$sott++."</td>";
                        echo "<td>".$row['Ten']."</td>";
                        echo "<td>".$row['SoLuong']."</td>";
                        echo "<td> <span class='money'>".$row['SoLuong']*$row['Gia']." </span> VNĐ</td>";
                        
                        echo "</tr>";
                    }
                }
            }    
                echo "<tr>
                    <td rowspan='3'></td>
                    <td rowspan='3'></td>
                    <td>Tổng tiền</td>
                    <td><span class='money'>".$tongTien."</span> VNĐ</td>
                </tr>";
                echo "<tr>
                    <td>Phí ship</td>
                    <td><span class='money'>30000</span> VNĐ</td>
                </tr>";
                $canTT = $tongTien+30000;
                echo "<tr style='font-weight: bold;'>
                    <td>Cần thanh toán</td>
                    <td><span class='money'>".$canTT."</span> VNĐ</td>
                </tr>";
            echo'</table>
                ';
            echo '</div>';

            echo "<div class='detail-comand'>";
                echo '<a href="./in-hoa-don.php?mahd='.$maHD.'" target="_blank" class="detail-comand--btn">In hóa đơn</a>
                <a href="./index.php" class="detail-comand--btn">Trở về</a>';
            echo "</div>";
        }

        echo '</div>';
    }
}
include("../../block/connection.php");
include("../../block/global.php");
include("../../block/vanchuyen.php");


?>