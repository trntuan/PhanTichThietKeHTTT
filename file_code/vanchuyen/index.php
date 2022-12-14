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
    $err="";
        if(isset($_POST["submit"]))
        {
            $tk = $_POST["name"];
            $mk = $_POST["pass"];

            if(($tk === "admin" || $tk === "huy@gmail.com")  && $mk == "12345")
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
        session_start();
        if(isset($_SESSION["hasAcc"]))
        {
            if($_SESSION["hasAcc"] == true)
            {
                header("location: ./quan-ly");
            }
        }
        
        session_write_close();
    ?>
    <div class="login-body">
        <div class="login">
            <h3 class="login-title">Đăng nhập GIAO HÀNG</h3>
            <div class="login-content">
                <form action="" method="post">
                    <div class="login-group">
                        <label class="login-label" aria-autocomplete="none">Nhập địa chỉ email</label>
                        <input type="text" name="name" class="login-input" value="<?php
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