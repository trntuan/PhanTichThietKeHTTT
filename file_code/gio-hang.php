<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhóm 5</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Ubuntu:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/main.css"/>
    <link rel="icon" type="image/x-icon" href="./assets/images/logo/logo_2.png">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />
</head>
<body>
<?php
    $err ="";
    $none = "";
    include("./block/connection.php");
    include("./block/global.php");
    session_start();
    $Gia = 0;
    if(isset($_SESSION["gioHang"]))
    {
        $gioHang = $_SESSION["gioHang"];
        for($i = 0; $i < count($gioHang); $i++)
        {
            $Gia = $Gia + $gioHang[$i]["Gia"];
        }
    }
    $phiGH = 30000;
    if(isset($Gia))
    {
        $tong = $Gia + $phiGH;
    }
    if(isset($_POST["btnIncr"]))
    {
        $IDSP = $_POST["IDSP"];
        $gioHang = $_SESSION["gioHang"];

        for($i = 0; $i < count($gioHang); $i++)
        {
            $arr = $gioHang[$i];

            if($IDSP == $gioHang[$i]['IDSP'])
            {   
                $gioHang[$i]['Gia'] = $gioHang[$i]['Gia'] + $gioHang[$i]['Gia']/$gioHang[$i]['sl'];
                $gioHang[$i]['sl']++;
            }
        }
            $_SESSION["gioHang"] = $gioHang;
    }
    if(isset($_POST["btnDecr"]))
    {
        $IDSP = $_POST["IDSP"];
        $gioHang = $_SESSION["gioHang"];

        for($i = 0; $i < count($gioHang); $i++)
        {
            $arr = $gioHang[$i];

            if($IDSP == $gioHang[$i]['IDSP'])
            {   
                $gioHang[$i]['Gia'] = $gioHang[$i]['Gia'] - $gioHang[$i]['Gia']/$gioHang[$i]['sl'];
                $gioHang[$i]['sl']--;
            }
        }
            $_SESSION["gioHang"] = $gioHang;
    }

    if(isset($_POST["delete"]))
    {
        $IDSP = $_POST["IDSP"];
        $gioHang = $_SESSION["gioHang"];
        for($i = 0; $i < count($gioHang); $i++)
        {
            if($IDSP == $gioHang[$i]['IDSP'])
            {   
                array_splice($gioHang, $i, 1);
            }
        }
            $_SESSION["gioHang"] = $gioHang;
    }
    
    if(isset($_POST["dathang"]))
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $id = "HD".date("ymdHis");
        $ten_kh = $_POST["ten_kh"];
        $gt = $_POST["gt"];
        $sodt = $_POST["sdt"];
        $diachi = $_POST["diachi"];
        $tgdat = date('Y-m-d H:i:s');
        if($ten_kh=="" || $sodt=="" || $diachi=="" )
        {
            $err = "<p style='font-size: 16px; font-weight: bold; color: red; margin-top: 15px; padding: 0 11px;'> Vui lòng nhập đủ thông tin ... </p>";
        }
        else {$err = "";
            
        $query = "INSERT INTO `don_hang`(`ma_donhang`, `ten_kh`, `gioi_tinh`, `dia_chi`, `so_dt`, `tg_dat`, `tinh_trang_tt`, `tinh_trang_Giaohang`, `tong_tien`) VALUES ('$id','$ten_kh','$gt','$diachi','$sodt','$tgdat','0','0', '$tong')";

        $resultDonHang = mysqli_query($conn, $query);
        $kiemTra = true;
        $gioHang = $_SESSION["gioHang"];
        for($i = 0; $i < count($gioHang); $i++)
        {
            $arr = $gioHang[$i];
            $query = "INSERT INTO `chi_tiet_don_hang`(`san_pham`, `so_luong`, `don_hang`) VALUES ('$arr[IDSP]','$arr[sl]','$id')";
            $result = mysqli_query($conn, $query);
            if(!$result)
            {
                $kiemTra = false;
                break;
            }
        }
        if($resultDonHang && $kiemTra!= false)
        {
            $_SESSION["gioHang"] = [];
            $none ="active";
        }
        
    }
    }
    session_write_close();
    
    
    include("./block/header.php");
    $phiGH = 30000;
    if(isset($Gia))
    {
        $tong = $Gia + $phiGH;
    }
    
?>

<?php
    // session_start();
    if(!isset($_SESSION["gioHang"]) || count($_SESSION["gioHang"])==0)
    {
        include("./block/not-cart.php");
    }
    else {
        $gioHang = $_SESSION["gioHang"];
        echo "<div class='container'>
            <div class='cart'>
                <h2 class='cart-title'>Có ".count($gioHang)." sản phẩm trong giỏ hàng</h2>
                <div class='cart-group'>";

        for($i = 0; $i < count($gioHang); $i++)
        {
            $arr = $gioHang[$i];
            $query= "SELECT * FROM `sanpham` JOIN LoaiSP on sanpham.LoaiSP = LoaiSP.MaLoai WHERE `IDSP` = '$arr[IDSP]'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result);
            $src = "./assets/images/item/$row[hinh]";
            if($arr["sl"] == 1)
            {
                $dis = "disabled";
            }
            else $dis = "";
            echo " <div class='cart-item'>
                        <div class='cart-item--img'>
                            <img src='".$src."' alt=''>
                        </div>
                        <div class='cart-item-info'>
                            <a href='./chi-tiet-san-pham.php?id=$row[IDSP]' class='cart-item--name'>".$row['Ten']."</a>
                            <p class='cart-item--dm'> <b>Danh mục: </b>".$row['TenLoai']."</p>
                        </div>
                        <div class='cart-item--amount'>
                            <form action='' method='post'>
                                <div class='cart-item--sl'>
                                    <button class='detail-btn btn-decr'  $dis type='submit' name='btnDecr'>-</button>
                                    <input type='number' class='input-count' readonly value='$arr[sl]' name='amount'>
                                    <input type='text' style='display:none;' value='$arr[IDSP]' name='IDSP'>
                                    <button class='detail-btn btn-incr' type='submit' name='btnIncr'>+</button>
                                </div>
                                <p class='cart-item--price'> <span class='money'>$arr[Gia]</span> VNĐ</p>
                                <button class='btn-del' name='delete'>
                                    <i class='fa-solid fa-trash-can'></i>
                                    <span>Xóa</span>
                                </button>
                            </form>
                        </div>
                    </div> ";
        }
        echo"   </div>
        <form action='' method='post'>
            <div class='form-order'>

                    <div class='form-order--group'>
                        <div class='form-order-address'>";
                        ob_start();
 
                        if(isset($_SESSION['id_user']))
                        $id = $_SESSION['id_user'];
        $querys= "SELECT * FROM khachhang JOIN taikhoankh on khachhang.idKH = taikhoankh.IdKH JOIN diachi on diachi.IDKhachHang = khachhang.idKH WHERE khachhang.idKH = $id ";
            $resultss = mysqli_query($conn, $querys);
            if(mysqli_num_rows($result)!= 0){
                while($rows = mysqli_fetch_array($resultss))
                    {
                        
                echo "<div style='font-weight: 700;'> <p class='cart-info-desc'>Địa chỉ giao hàng: ".$rows['DiaChi']."</p></div>" ;    
                echo "<div style='color: red;'> <p class='cart-info-desc'>* mặt định sử dụng địa chỉ của bạn</p></div>" ;   
                echo "<div style='color: red;'> <p class='cart-info-desc'>* nếu bạn muốn thay đổi, vui lòng thay đổi địa chỉ ở phần chỉnh sửa thông tin cá nhân</p></div>" ;   
                    
            } 
                }  ob_end_flush();
                     echo"                  
                       </div>
                    </div>
                    $err
                </div>

                <div class='cart-info'>
                    <h3 class='cart-info-title'>
                        <i class='fa-solid fa-bag-shopping'></i>
                        <span>Thông tin đơn hàng</span>
                    </h3>
                    <div class='cart-info--content'>
                        <div class='cart-info-item'>
                            <p class='cart-info-desc'>
                                Tổng tiền
                            </p>
                            <p class='cart-info-price'>
                                <span class='money'>".$Gia."</span>
                                 <span> VNĐ</span>
                            </p>
                        </div>
                        <div class='cart-info-item'>
                            <p class='cart-info-desc'>
                                Phí Giao hàng dự kiến
                            </p>
                            <p class='cart-info-price'>
                                <span class='money'>". $phiGH."</span>
                                 <span> VNĐ</span>
                            </p>
                        </div>
                        <div class='cart-info-item'>
                            <p class='cart-info-desc'>
                                <b>Cần thanh toán</b>
                            </p>
                            <p class='cart-info-price bold'>
                                <span class='money'>".$tong."</span>
                                 <span> VNĐ</span>
                            </p>
                        </div>
                    </div>
                    <div class='cart-info--order'>
                        <div class='cart-info--btn'>
                            <button type='submit' name='dathang'>Hoàn tất đặt hàng</button>
                        </div>
                        <p class='cart-info-detail'>Bằng cách đặt hàng, bạn đồng ý với<br>
                        Điều khoản sử dụng của Phúc Long</p>
                    </div>
                </div>
                </div>
            </form>
        </div>";
    }
?>
<?php


    
?>
<div class="container">
<?php 
    product_hot($conn);
?>
</div>
<?php
    include("./block/footer.php");
?>

<div class="noti-suscess <?php echo $none; ?>">
    <i class="fa-sharp fa-solid fa-check icon-checked"></i>
    <p class="noti-suscess-text">Đặt hàng thành công</p>
    <i class="fa-solid fa-x icon-close"></i>
</div>
</body>
<script>
    const notiSucsess = document.querySelector(".noti-suscess.active")
    if(notiSucsess){
        setTimeout(()=>{
            notiSucsess.classList.remove("active");
        }, 3000)
        
        const iconClose = document.querySelector(".icon-close")
        iconClose.addEventListener("click", ()=>{
            notiSucsess.classList.remove("active");
        })
    }
</script>
</html>

