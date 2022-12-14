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
session_start();
    include("./block/connection.php");
    include("./block/global.php");
    $id = $_GET['id'];
    $query= "SELECT IDSP,Ten,Gia,TenLoai,hinh,MoTa,MaLoai FROM `sanpham` JOIN LoaiSP on sanpham.LoaiSP = LoaiSP.MaLoai 
    WHERE IDSP = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    if(isset($_POST["addCard"]))
    {
        if(!isset($_SESSION["id_user"])) header("location:./dangnhap.php");
        else {
            
            $sl = $_POST["amount"];
            $Gia = $sl * $row["Gia"];
            $arr = ["IDSP" => $row["IDSP"], "sl" => $sl, "Gia" => $Gia];
            if(isset($_SESSION["gioHang"]))
            {
                $gioHang = $_SESSION["gioHang"];
                $checkCard = false;
                for($i = 0; $i < count($gioHang); $i++)
                {
                    if($gioHang[$i]["IDSP"] == $arr["IDSP"])
                    {
                        $checkCard = true;
                        $gioHang[$i]["sl"] = $gioHang[$i]["sl"] + $arr["sl"];
                        $gioHang[$i]["Gia"] = $gioHang[$i]["Gia"] + $arr["Gia"];
                    }
                }
                if($checkCard == false)
                {
                    array_push($gioHang, $arr);
                }
                $_SESSION["gioHang"] = $gioHang;
            }
            else {
                $gioHang = [$arr];
                $_SESSION["gioHang"] = $gioHang;
            }        
            session_write_close();
        }
       
    }
    if(isset($_POST["buyNow"]))
    {
        if(!isset($_SESSION["id_user"])) header("location:./dangnhap.php");
        else {
            session_start();
            $sl = $_POST["amount"];
            $Gia = $sl * $row["Gia"];
            $arr = ["IDSP" => $row["IDSP"], "sl" => $sl, "Gia" => $Gia];
            if(isset($_SESSION["gioHang"]))
            {
                $gioHang = $_SESSION["gioHang"];
                $checkCard = false;
                for($i = 0; $i < count($gioHang); $i++)
                {
                    if($gioHang[$i]["IDSP"] == $arr["IDSP"])
                    {
                        $checkCard = true;
                        $gioHang[$i]["sl"] = $gioHang[$i]["sl"] + $arr["sl"];
                        $gioHang[$i]["Gia"] = $gioHang[$i]["Gia"] + $arr["Gia"];
                    }
                }
                if($checkCard == false)
                {
                    array_push($gioHang, $arr);
                }
                $_SESSION["gioHang"] = $gioHang;
            }
            else {
                $gioHang = [$arr];
                $_SESSION["gioHang"] = $gioHang;
            }        
            session_write_close();
            header("location: ./gio-hang.php");
        }
       
    }        
    ?>
    <?php
      
        include("./block/header.php");
        $src = "./assets/images/item/$row[hinh]";
    ?>
    <div class="container">
    <form action="" method="post">
        <div class="product-detail">
            <div class="detail-img">
                <img src="<?php echo $src;?>" alt="">
                <p class='product-dm'><?php echo $row["TenLoai"];?></p>
            </div>
            <div class="detail-info">
                <p class="detail-name"> <?php echo $row["Ten"];?></p>
                <p class="detail-price"> <b>Giá: </b> <?php echo $row['Gia']."";?> VNĐ</p>
                <p class="detail-dm"> <b>Danh mục: </b> <?php echo $row["TenLoai"];?></p>
                <p class="detail-desc"> <b>Mô tả: </b> <?php echo $row["MoTa"];?></p>
                <div class="detail-count">
                    <p style="font-size: 20px; font-weight: bold;">Chọn số lượng:</p>
                    <div class="detail-count-content">
                        <button class="detail-btn btn-decr" type="button">-</button>
                        <input type="number" class="input-count only" value="1" name="amount">
                        <button class="detail-btn btn-incr" type="button">+</button>
                    </div>
                </div>
                
                    <div class="buy">
                        <button class="btn-add" type="submit" name="addCard">
                            THÊM VÀO GIỎ HÀNG
                        </button>
                        <button class="btn-buy" type="submit" name="buyNow">
                            MUA NGAY
                        </button>
                    </div>
                
                <div class="commit">
                    <h3 class="commit-title">
                        Phúc Long
                    </h3>
                    <div class="commit-content">
                        <div class="commit-item">
                            <div class="commit-img">
                                <img src="./assets/images/exchange-500x500.png" alt="">
                            </div>
                            <p class="commit-desc">Đổi ngay nếu Giao sai hàng</p>
                        </div>
                        <div class="commit-item">
                            <div class="commit-img">
                                <img src="./assets/images/like-500x500.png" alt="">
                            </div>
                            <p class="commit-desc">Đảm bảo chất lượng</p>
                        </div>
                        <div class="commit-item">
                            <div class="commit-img">
                                <img src="./assets/images/express-delivery-500x500.png" alt="">
                            </div>
                            <p class="commit-desc">Miễn phí vận chuyển</p>
                        </div>
                    </div>
                </div>
                <div class="detail-contact">
                    <p>
                    <i class="fa-solid fa-phone"></i>
                    <b>0369454037</b>
                    <span>Gọi tư vấn (8:00 - 22:00)</span>
                    </p>
                </div>
            </div>
        </div>
        <?php include("./block/product-same.php");
            product_same($row['MaLoai'], $conn)
        ?>
        </form>
    </div>
    <?php
        include("./block/footer.php");
    ?>
</body>
<script src="./assets/js/main.js"></script>
</html>