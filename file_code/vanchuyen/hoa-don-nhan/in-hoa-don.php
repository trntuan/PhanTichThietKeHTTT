<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In Hóa đơn - Phúc Long</title>
    <link rel="stylesheet" href="../../assets/css/main.css">
</head>
<body onload="window.print();">
    <?php
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
                            <p class="customer-name"> <b>Họ và tên: </b>'.$row['TenKH'].'</p>';
                            echo '<p class="customer-gt"> <b>Giới tính: </b>';
                            if($row['gioi_tinh']==0) echo 'Nữ'; else echo 'Nam';
                            echo '</p>
                            <p class="customer-phone"><b>Số điện thoại: </b>'.$row['Sdt'].'</p>
                            <p class="customer-address"><b>Địa chỉ: </b>'.$row['DiaChi'].'</p>
                        </div>
                        <div class="info-receipt">
                            <p class="receipt-id"><b>Mã hóa đơn: </b> '.$row['IdHoaDon'].'</p>
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
                $query = "SELECT san_pham.ten_sp, san_pham.gia, chi_tiet_don_hang.so_luong FROM `chi_tiet_don_hang` INNER JOIN `san_pham` ON chi_tiet_don_hang.san_pham = san_pham.ma_sp INNER JOIN don_hang on don_hang.ma_donhang = chi_tiet_don_hang.don_hang WHERE chi_tiet_don_hang.don_hang = '$maHD'";
    
                $result = mysqli_query($conn, $query);
                if($result)
                {
                    $sott = 1;
                    $tongTien = 0;
                    if(mysqli_num_rows($result) != 0)
                    {
                        while($row = mysqli_fetch_array($result))
                        {
                            $tongTien = $tongTien + ($row['so_luong']*$row['gia']);
                            echo "<tr>";
                            echo "<td>".$sott++."</td>";
                            echo "<td>".$row['ten_sp']."</td>";
                            echo "<td>".$row['so_luong']."</td>";
                            echo "<td> <span class='money'>".$row['so_luong']*$row['gia']." </span> VNĐ</td>";
                            
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

            }
    
            echo '</div>';
        }
    ?>
</body>
</html>