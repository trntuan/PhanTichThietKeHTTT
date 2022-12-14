<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhóm 5</title>
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="icon" type="image/x-icon" href="./assets/images/logo/logo_3.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="../../assets/js/ckeditor/ckeditor.js"></script>
</head>

<body>
<?php
     include("connection.php");
        session_start();
            if($_SESSION['id_pc'] ==-1)
            {
                header("location: ../");
            }
          
        session_write_close();

        if(isset($_POST["logout"]))
        {
            session_start();
            $_SESSION['id_pc'] = -1;
            header("location: ../");
            session_write_close();
        }
        if(isset($_SESSION['id_pc']))
        {
            $id = $_SESSION['id_pc'];
        $queryacc = "SELECT * FROM `nhanvien` WHERE IdNV = '$id'";
        $queryacc = mysqli_query($conn, $queryacc);
        if((mysqli_num_rows($queryacc)!= 0))
        {
            while($rowacc = mysqli_fetch_array($queryacc))
            {
                $anh = $rowacc["anh"];
    
            }
        }
        }
    ?>
    <div class="admin">
        <div class="admin-sidebar active">

            <ul class="admin-sidebar-list">
                <li class="admin-sidebar-item">
                    <a href="../quan-ly">
                        <img src="../../assets/images/tachometer-alt-solid.png" alt="" class="admin-sidebar-icon">
                        <span class="admin-sidebar-desc">Trang chủ</span>
                    </a>
                </li>
                <li class="admin-sidebar-item">
                    <a href="../hoa-don-can">
                        <img src="../../assets/images/receipt-solid.png" alt="" class="admin-sidebar-icon">
                        <span class="admin-sidebar-desc">Hóa đơn đang đặt</span>
                    </a>
                </li>
                <li class="admin-sidebar-item">
                    <a href="../hoa-don-nhan">
                        <img src="../../assets/images/receipt-solid.png" alt="" class="admin-sidebar-icon">
                        <span class="admin-sidebar-desc">Hóa đơn đang pha chế</span>
                    </a>
                </li>
                
            </ul>
        </div>
        <div class="admin-main">
            <!-- PC, Tablet -->
            <div class="admin-header">
                <div class="flex">
                    <form action="" method="post">
                        <button name="logout" type="submit" class="admin-logout-btn" title="Đăng xuất tài khoản">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                    <a href="" class="admin-sidebar-logo">
                        <img src="../../assets/images/logo/logo_3.png" alt="" class="admin-sidebar-img">
                        <span>Phúc Long</span>
                    </a>
                    <div class="admin-sidebar--toggle">
                        <i class="fa fa-bars"></i>
                    </div>
                </div>
                <div class="admin-avatar">
                <img src="<?php echo "../../assets/images/team/".$anh ?>" alt="" class="admin-avatar-img">
                    <form action="" method="post">
                        <button name="logout" type="submit" class="admin-logout-btn" title="Đăng xuất tài khoản">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="admin-content isactive">
                <?php
                    adminContent();
                ?>
            </div>
        </div>
    </div>
    <script src="../../assets/js/admin.js"></script>
    <script src="../../assets/js/main.js"></script>

</body>

</html>