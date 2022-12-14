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
    ob_start();
      session_start();
    include("./block/connection.php");
    include("./block/global.php");
    include("./block/header.php");
    if(isset($_SESSION['id_user']))
    $id = $_SESSION['id_user'];
    
    $queryDM = "SELECT * FROM khachhang JOIN taikhoankh on khachhang.idKH = taikhoankh.IdKH JOIN diachi on diachi.IDKhachHang = khachhang.idKH WHERE khachhang.idKH = $id ";
    $result = mysqli_query($conn, $queryDM);

    if(mysqli_num_rows($result)!= 0){
        while($row = mysqli_fetch_array($result))
            {
             
                echo "<div class='profile-name'> </br> </div>";

                echo " <div class='profile'>
                <div class='profile-name'>THÔNG TIN CÁ NHÂN</div>
      
                <div class='profile-text'><img src='./assets/images/team/".$row['anh']."'  class='info-img'></div>
                <div class='profile-text'>Họ tên: ".$row['HoKH']." ".$row['TenKH']."</div>
                <div class='profile-text'>Giới tính: ".$row['GioiTinh']."</div>
                <div class='profile-text'>email đăng nhập: ".$row['Email']."</div>
                <div class='profile-text'>Số điện thoại:</span> ".$row['Sdt']."</div>
                <i class='fas fa-thumbtack'></i>
                <strong class='profile-address'>Địa chỉ: </span>".$row['DiaChi']."</strong>
    
              
                <div class='profile-button'>
                    <button  class='btn-info btn-blue'><a href=href='./thongtinedit.php?id=".$row['idKH']."'>chỉ sửa</a></button>
                </div>
    
            </div>";
            }
           
     }

   
    ?>
    
    <?php
        include("./block/footer.php");
        ob_end_flush();
    ?>
    
    <script src="./assets/js/main.js"></script>
  
</body>
</html>