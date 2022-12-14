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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="../../assets/js/ckeditor/ckeditor.js"></script>
</head>

<body>
    <?php
     include("connection.php");
        session_start();
            if($_SESSION['id_admin'] ==-1)
            {
                header("location: ../");
            }
          
        session_write_close();

        if(isset($_POST["logout"]))
        {
            session_start();
            $_SESSION['id_admin'] = -1;
            header("location: ../");
            session_write_close();
        }
        if(isset($_SESSION['id_admin']))
        {
            $id = $_SESSION['id_admin'];
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
                    <a href="../nhan-vien-pc">
                        <img src="../../assets/images/user-solid.png" alt="" class="admin-sidebar-icon">
                        <span class="admin-sidebar-desc">Nhân Viên pha chế</span>
                    </a>
                </li>
                <li class="admin-sidebar-item">
                    <a href="../nhan-vien-vc">
                        <img src="../../assets/images/user-solid.png" alt="" class="admin-sidebar-icon">
                        <span class="admin-sidebar-desc">Nhân viên vận chuyển</span>
                    </a>
                </li>
                <li class="admin-sidebar-item">
                    <a href="../khach-hang">
                        <img src="../../assets/images/user-solid.png" alt="" class="admin-sidebar-icon">
                        <span class="admin-sidebar-desc">Khách hàng</span>
                    </a>
                </li>
                <li class="admin-sidebar-item">
                    <a href="../danh-muc">
                        <img src="../../assets/images/list-solid.png" alt="" class="admin-sidebar-icon">
                        <span class="admin-sidebar-desc">Danh Mục</span>
                    </a>
                </li>
                <li class="admin-sidebar-item">
                    <a href="../san-pham">
                        <img src="../../assets/images/coffee-solid.png" alt="" class="admin-sidebar-icon">
                        <span class="admin-sidebar-desc">Sản phẩm</span>
                    </a>
                </li>
                <li class="admin-sidebar-item">
                    <a href="../hoa-don">
                        <img src="../../assets/images/receipt-solid.png" alt="" class="admin-sidebar-icon">
                        <span class="admin-sidebar-desc">Hóa đơn</span>
                    </a>
                </li>
                <li class="admin-sidebar-item">
                    <a href="../thong-ke/index.php">
                        <img src="../../assets/images/file-contract-solid.png" alt="" class="admin-sidebar-icon">
                        <span class="admin-sidebar-desc">Thống kê</span>
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>


<script tyle="text/javascript">
    $(document).ready(function(){
    thongke();
    var char = new Morris.Area({
 
    element: 'time',
    // lineColors: ['#819c79','fc8710','#ff6541','#A4ADD3','#766B56'],
    xkey: 'date',

    ykeys: ['date','order','sales'],

    labels: ['tổng hàng','Đơn','Doanh thu']
    });
    $('.select-date').change(function(){
        var thoigian = $(this).val();
              if(thoigian=='365ngay'){
            var text = '365 ngày qua';
        }else if(thoigian=='28ngay'){
            var text = '28 ngày qua';
        }else if(thoigian=='90ngay'){
            var text = '90 ngày qua';
        }else{
            var text = '7 ngày qua';
        }
        $.ajax({
            url:"./thong_ke.php",
            method:"POST",
            dataType:"JSON",
            data:{thoigian:thoigian},
            success:function(data)
            {
                char.setData(data);
                $('#text-date').text(text);
            }
        })
    })


    function thongke(){
        var text = '7 ngày qua';
        $('#text-date').text(text);
            $.ajax({
                url:"./thong_ke.php",
                method:"POST",
                dataType:"JSON",
                success:function(data)
                {
                    char.setData(data);
                    $('#text-date').text(text);
                }
            });
        }
});
    </script>
</body>
</html>