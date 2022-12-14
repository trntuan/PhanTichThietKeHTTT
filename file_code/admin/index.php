<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhóm 5</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="icon" type="image/x-icon" href="./assets/images/logo/logo_2.png">
</head>
<body>
    <?php
      include("../block/connection.php");
    $err="";
    session_start();
    if(isset($_POST["submit"]))
    {  
        $tk = $_POST["email"];
        $mk = $_POST["pass"];
        $queryDM = "SELECT taikhoannv.IdNV
        FROM taikhoannv JOIN nhanvien on nhanvien.IdNV = taikhoannv.IdNV WHERE Email  = '$tk' AND password = '$mk' AND nhanvien.IdChuVu = '1'";
        $result = mysqli_query($conn, $queryDM);
        if((mysqli_num_rows($result)!= 0))
        {
            while($row = mysqli_fetch_array($result))
            {
                $_SESSION['id_admin'] = $row["IdNV"];
                header("location:./quan-ly");
    
            }
        }
        else {
            $err="Đăng nhập không thành công, vui lòng nhập lại tài khoản hoặc mật khẩu";
        }
    }
    if(isset($_SESSION['id_admin']))
    {
        if($_SESSION['id_admin'] !== -1)
        {
            header("location:./quan-ly");
        }
    }
        session_write_close();
    ?>
    <div class="login-body">
        <div class="login">
            <h3 class="login-title">Đăng nhập ADMIN</h3>
            <div class="login-content">
                <form action="" method="post">
                    <div class="login-group">
                        <label class="login-label" aria-autocomplete="none">Nhập địa chỉ email</label>
                        <input type="email" name="email" class="login-input" value="<?php
                        if (isset($tk)) echo $tk; else echo "";
                        ?>">
                    </div>
                    <div class="login-group">
                        <label class="login-label">Mật khẩu</label>
                        <input type="password" name="pass" class="login-input" value="<?php
                        if (isset($mk)) echo $mk; else echo "";
                        ?>">
                    </div>
                    <div class="login-group" style="color: red; font-weight: bold">
                        <?php if (isset($err)) echo $err; else echo "" ?>
                    </div>
                    <button type="submit" name="submit" class="login-btn">Đăng nhập</button>
                </form>
                <div class="login-back">
                    <a href="../">Quay lại với Phúc Long</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>