<header>
<?php
if(!isset($_SESSION)) { 
    session_start(); 
    
} 
?>
    <?php if(isset( $_SESSION["id_user"])) 
     { $id_users = $_SESSION["id_user"]; 
        $query= "SELECT khachhang.idKH, khachhang.TenKH,khachhang.anh,khachhang.HoKH,khachhang.Sdt FROM khachhang WHERE khachhang.idKH = '$id_users'";
     $result = mysqli_query($conn, $query);
     $numRow = mysqli_num_rows($result);
     while ($rows=mysqli_fetch_array($result)){
        $anh = $rows['anh'];
     }
     }

    ?>
    <div class="header-container">
        <div class="header-info">
            <div class="header-info--name">
                <a href="./index.php">công ty TNHH Sản Xuất Thương Mại Phúc Long</a>
            </div>
            <div class="header-info--contact">
                <div class="header-info--gmail">
                    <i class="fa fa-envelope"></i>
                    <a href="#">nhom5cntt3@gmail.com</a>
                </div>
                <div class="header-info--tel">
                    <i class="fa fa-phone"></i>
                    <a href="#">0945.323.666</a>
                </div>
            </div>
        </div>
        <div class="header-content">
            <div class="header-content--mobile">
                <i class="fa fa-bars"></i>
            </div>
            <div class="header-content--logo">
                <img src="./assets/images/logo/logo_3.png" alt="" width="100" height="100">
            </div>
            <div class="header-content--method">
                <div class="header-method--hotline">
                    <i class="fa fa-phone"></i>
                    <div class="header-method--text">
                        <strong>Hotline: 0912.077.322</strong>
                        <br>Tư vấn 24/7 miễn phí
                    </div>
                </div>
                <div class="header-method--hotline">
                    <i class="fa fa-phone"></i>
                    <div class="header-method--text">
                        <strong>Hotline: 0945.323.666</strong>
                        <br>Tư vấn 24/7 miễn phí
                    </div>
                </div>
                <div class="header-method--ship">
                    <i class="fas fa-truck-fast"></i>
                    <div class="header-method--text">
                        <strong>Giao hàng toàn quốc</strong>
                        <br>Ship COD tận nhà
                    </div>
                </div>
            </div>
            <div class="header-group_by">  
                    <?php
                   
                    if (isset($_SESSION["id_user"])) {
                        echo ' <div class="header-content--product">';
                     echo  '<a href="./gio-hang.php" class="header-product--text">';
                     echo ' GIỎ HÀNG / '; 
                     if (isset($_SESSION["gioHang"])) {
                        $Gia = 0;
                        $gioHang = $_SESSION["gioHang"];
                        for ($i = 0; $i < count($gioHang); $i++) {
                            $Gia = $Gia + $gioHang[$i]["Gia"];
                        };
                        echo "<span class='money'>$Gia</span> đ";
                       
                    } else
                        echo "0";
                    echo ' <i class="fas fa-bag-shopping"></i>';
                     echo   '</a></div>';
                    } else                 
                    ?>                           
                    
                    <?php     
                    if (isset($_SESSION["id_user"])) {
                        echo  '<a href="./thongtin.php" ><img style="width: 35px;height: 35px;border-radius: 50%;margin-left: 5px; " src="./assets/images/team/'.$anh.'"> </a>';      
                    } else{ 
                        echo ' <div class="header-content--product">';  
                        echo  '<a href="./dangnhap.php" class="header-product--text">Đăng nhập</a>';
                        echo '<strong> / </strong>';
                        echo ' <a href="./dangky.php" class="header-product--text">Đăng ký</a>';
                        echo   '</div>';
                    }        
                    ?>
          
            <div >
               
                    <?php
                  
                    if (isset($_SESSION["id_user"])) {
                        ?>
                       <button onclick="document.getElementById('id01').style.display='block'" name="logout" type="submit" class="logout-btn admin-logout-btn" title="Đăng xuất tài khoản">
                          <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                    <?php } 
                    ?>
              

            </div>
            </div>
           
 
        </div>
        <div class="header-menu">
            <div class="header-menu--list">
                <div class="header-menu--item">
                    <a href="./index.php" class="header-menu--link">Trang chủ</a>
                </div>
                <div class="header-menu--item">
                    <a href="./gioi-thieu.php" class="header-menu--link">Giới thiệu</a>
                </div>
               
                <div class="header-menu--item">
                    <a href="./san-pham.php" class="header-menu--link">Sản phẩm</a>
                </div>
              
                <div class="header-menu--item">
                    <a href="./gio-hang.php" class="header-menu--link">Đặt hàng</a>
                </div>
                
            </div>
            <form action="./tim-kiem.php" method="get">
                <div class="header-menu--search">
                    <input type="text" name="search" id="" placeholder="Bạn cần tìm gì?..." value="<?php if (isset($_GET["search"]))
                        echo $_GET["search"];
                    else
                        echo "" ?>">
                    <button type="submit" name="timKiem"><i class="fas fa-magnifying-glass"></i></button>
                </div>
            </form>
            <div class="header-menu--close">
                <i class="fa fa-times"></i>
            </div>
        </div>
    </div>
</header>
<script>
    const btnOpen = document.querySelector(".header-content--mobile");
    const btnClose = document.querySelector(".header-menu--close");
    const headerMenu = document.querySelector(".header-menu");
    const menuList = document.querySelector(".header-menu--list")
    btnOpen.addEventListener("click", function () {
        headerMenu.style = "transform: translate(0%)";
    });
    btnClose.addEventListener("click", function () {
        headerMenu.style = "transform: translate(-100%)";
    });
    const listMenuItem = document.querySelectorAll(".header-menu--link");
    console.log(listMenuItem);
    [...listMenuItem].forEach(item => item.addEventListener("click", function (e) {
        [...listMenuItem].forEach(item => item.classList.remove("is-active"));
        e.target.classList.add("is-active");
    }));


</script>

<style>
.modal {
  display: none; 
  position: fixed; 
  z-index: 100; 

}
.cancelbtn, .deletebtn {
  float: left;
  width: 40%;
  text-align: center;
  color: #000;
}
.logbtn{
    display: flex;
    justify-content: space-between;
}
.cancelbtn {
  background-color: #ccc;
  color: black;
}

.deletebtn {
  background-color: #f44336;
}
 </style>

<div id="id01" class="modal">
  <form class="modal-content" action="/action_page.php">
      <h1> Đăng xuất ?</h1>
        <div class="logbtn">
        <a href=""  type="button" class="cancelbtn">no </a>
        <a href="logout.php" type="button" class="deletebtn">yes</a></div>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>