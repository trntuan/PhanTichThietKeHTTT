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
// {
    // $idNV=$_POST['idNV'];  
    // $hoNV=$_POST['hoNV'];
    // $tenNV=$_POST['tenNV'];
    // $gioitinh=$_POST['gioitinh'];
    // $sdt= $_POST['sdt'];
    // $diachi=$_POST['diachi'];
    // $anh=$_FILES['res']['name'];
    // $target_dir = "../../assets/Images/";
   
 
    // if ($anh_update!=""){
    //     move_uploaded_file($anh_update, $target_file);
    //     if ($gioitinh=="Nữ")
    //     {
    //         $sql="INSERT INTO `nhan_vien`( `ho_nv`, `ten_nv`, `gioi_tinh`, `sdt`, `dia_chi`, `hinh_anh`) 
    //         VALUES ('$hoNV','$tenNV','0','$sdt','$diachi','$anh')";
    //     }
    //     else if ($gioitinh=="Nam"){
    //         $sql="INSERT INTO `nhan_vien`( `ho_nv`, `ten_nv`, `gioi_tinh`, `sdt`, `dia_chi`, `hinh_anh`) 
    //         VALUES ('$hoNV','$tenNV','1','$sdt','$diachi','$anh')";

    //     }
    //     }
    // else {
    //     if ($gioitinh=="Nữ")
    //     {
    //         $sql="INSERT INTO `nhan_vien`( `ho_nv`, `ten_nv`, `gioi_tinh`, `sdt`, `dia_chi`) 
    //         VALUES ('$hoNV','$tenNV','0','$sdt','$diachi')";
    //     }
    //     else if ($gioitinh=="Nam"){
    //         $sql="INSERT INTO `nhan_vien`( `ho_nv`, `ten_nv`, `gioi_tinh`, `sdt`, `dia_chi`) 
    //         VALUES ('$hoNV','$tenNV','1','$sdt','$diachi')";

    //     }
    // }
    // $result=mysqli_query($conn,$sql);
    //         if ($result) 
    //         {
    //             header("Location:../../admin/nhan-vien/index.php");
    //             $notiPeople="Thêm nhân viên mới thành công";
    //             session_start();
    //             $_SESSION["noti-people"]=$notiPeople;
    //             session_write_close();
    //         }
    //         else 
    //         {
    //             echo 'không thể thêm';
    //         }
    // }
      session_start();
    include("./block/connection.php");
    include("./block/global.php");
    include("./block/header.php");
    $err="";
        if(isset($_POST["submit"]))
        {
            $tk = $_POST["name"];
            $mk = $_POST["pass"];

            if(($tk === "admin" || $tk === "admin@gmail.com")  && $mk == "123")
            {
                header("location: ./quan-ly");
                session_start();
                    $_SESSION["hasAcc"] = true;
                session_write_close();
            }
            else {
                $err="Đăng nhập không thành công, vui lòng nhập lại tài khoản hoặc mật khẩu";
            }
        }
       
        
        
        session_write_close();
    ?>
    <div class="login-body">
        <div class="login">
            <h3 class="login-title">Đăng ký</h3>
            <div class="login-content">
                <form action="" method="post">
                <div class="login-group">
                        <label class="login-label" aria-autocomplete="none">Nhập tên người dùng *</label>
                        <input type="text" name="name" class="login-input" value="<?php
                        if (isset($tk)) echo $tk; else echo "";
                        ?>">
                    </div>
                    <div class="login-group">
                        <label class="login-label" aria-autocomplete="none">Nhập email đăng nhập *</label>
                        <input type="text" name="name" class="login-input" value="<?php
                        if (isset($tk)) echo $tk; else echo "";
                        ?>">
                    </div>
                    <div class="login-group">
                        <label class="login-label">Mật khẩu *</label>
                        <input type="password" name="pass" class="login-input" value="<?php
                        if (isset($mk)) echo $mk; else echo "";
                        ?>">
                    </div>
                    <div class="login-group">
                        <label class="login-label">Nhập lại mật khẩu *</label>
                        <input type="password" name="pass" class="login-input" value="<?php
                        if (isset($mk)) echo $mk; else echo "";
                        ?>">
                    </div>
                    <div class='form-order--group'>
                        <div class='form-order-radius'>
                            <label for='nam'>
                                <input type='radio' value ='1' checked name='gt' id='nam'>
                                <span>Anh</span>
                            </label>
                        </div>
                        <div class='form-order-radius'>
                            <label for='nu'>
                                <input type='radio' value ='0' name='gt' id='nu'>
                                <span>Chị</span>
                            </label>
                        </div>
                    </div>
                    <div class="login-group" style="color: red; font-weight: bold">
                        <?php if (isset($err)) echo $err; else echo "" ?>
                    </div>
                    <button type="submit" name="submit" class="login-btn">Đăng ký</button>
                </form>
                
            </div>
        </div>
    </div>
    <?php
        include("./block/footer.php");
    ?>
    <script src="./assets/js/main.js"></script>
</body>
</html>