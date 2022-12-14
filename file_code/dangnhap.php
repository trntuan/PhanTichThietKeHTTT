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
    $err="";
        if(isset($_POST["submit"]))
        {
            $tk = $_POST["email"];
            $mk = $_POST["pass"];
        $queryDM = "SELECT IdKH  FROM taikhoankh WHERE Email = '$tk' and password = '$mk' ";
        $result = mysqli_query($conn, $queryDM);

        if(mysqli_num_rows($result)!= 0){
            while($row = mysqli_fetch_array($result))
                {
                  
                    $_SESSION['id_user'] = $row["IdKH"];
                    header("location:./index.php");
                }
         }
        else {
                $err="Đăng nhập không thành công, vui lòng nhập lại tài khoản hoặc mật khẩu";
            }
        }
   
     
        
      
    ?>
    <div class="login-body">
        <div class="login">
            <h3 class="login-title">Đăng nhập</h3>
            <div class="login-content">
                <form action="" method="post" id="form-contact">
                    <div class="login-group">
                        <label class="login-label" aria-autocomplete="none">email đăng nhập</label>
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
                    <a style="color:#05a;" href="./laymk.php">lấy lại mật khẩu</a>
                </div>
            </div>
        </div>
    </div>
    <?php
        include("./block/footer.php");
        ob_end_flush();
    ?>
    
    <script src="./assets/js/main.js"></script>
  
</body>
</html>