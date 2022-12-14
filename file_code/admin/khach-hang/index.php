<?php
//thông báo cập nhật sản phẩm
session_start();
if (isset($_SESSION["noti-product"]))
{

    echo "<div class='noti-show'>
    <p class='update-noti--text'><span>".$_SESSION["noti-product"]."</span>
    <i class='fa fa-close update--noti noti--close'></i>
    </p>
    </div>";
    unset($_SESSION["noti-product"]);
}
session_write_close();
//thông báo xóa
session_start();
if (isset($_SESSION["noti"]))
{
    
    echo "<div class='noti-show'>
    <p class='update-noti--text'><span>".$_SESSION["noti"]."</span>
    <i class='fa fa-close update--noti noti--close'></i>
    </p>
    </div>";
    unset($_SESSION["noti"]);
}
session_write_close();
include("../../block/connection.php");
include("../../block/global.php");

function adminContent()
{
    echo '<div class="container">';
    include("../../block/connection.php");
    $rowsPerPage = 6;
        if(!isset($_GET['page']))
        {
            $_GET['page'] = 1;
        }
        $offset = ($_GET['page']-1)* $rowsPerPage;
        $query= "SELECT khachhang.idKH, khachhang.TenKH,khachhang.anh,khachhang.HoKH,khachhang.Sdt FROM khachhang";
        $result = mysqli_query($conn, $query);
        $numRow = mysqli_num_rows($result);

        $maxPage = ceil($numRow / $rowsPerPage); 
        $query = "SELECT khachhang.idKH, khachhang.TenKH,khachhang.anh,khachhang.HoKH,khachhang.Sdt FROM khachhang LIMIT $offset, $rowsPerPage";
        $result =  mysqli_query($conn, $query);
    if (!$result){
        echo "Không có sản phẩm nào";
    }
    else {
        if (!mysqli_num_rows($result)==0){
            echo "<div class='product-content--link' align='left' style='margin-bottom: 30px'>";
            echo "<h1 class='admin-product--title'>THÔNG TIN KHÁCH HÀNG</h1>
            
            </div>";
?>
    <form action="./admin/san-pham/tim-kiem.php" method="get" style="margin-bottom: 30px">
                <div class="header-menu--search">
                    <input type="text" name="search" id="" placeholder="Nhập tên khách bạn muốn tìm..." value="<?php if (isset($_GET["search"]))
                        echo $_GET["search"];
                    else
                        echo "" ?>">
                    <button type="submit" name="timKiem" class="btn-search"><span>Tìm kiếm</span></button>
                </div>
            </form>
<?php
           
            echo "<table align='center' class='admin-product--table' id='tableProduct'>";
            echo "<tr >
    
                    <th>Mã Khách Hàng</th>
                    <th>Tên Khách hàng</th>
                    <th>Ảnh</th>
                    <th>SĐT</th>
                    <th>Chi tiết</th>
                </tr>";
                $dem=0;
                while ($rows=mysqli_fetch_array($result)){
                  
                    echo "<tr>";
         
                    echo "<td><span class='id_sp'>KH00{$rows['idKH']}</span></td>";
                    echo "<td>".$rows['HoKH']." ".$rows['TenKH']."</td>";
                    echo "<td>
                    <img src='../../assets/images/team/".$rows['anh']."' class='admin-product--img'>
                    </td>";
                    
                    echo "<td>{$rows['Sdt']}</td>";
                    echo "<td align='center'>
                    <a href='../../admin/san-pham/detail.php?id=".$rows['idKH']."'>
                    <i class='fa-sharp fa-solid fa-file-lines' title='Xem chi tiết'></i> 
                    </a>  
                    </td>";
                    echo "</tr>";
                }
                echo "</table>";
                if($maxPage != 1)
                {
                    echo "<div class='phanTrang'>";
                    if($maxPage > 4)
                    {
                        $firstPage = 1;
                        echo "<a class='link-btn' href=".$_SERVER ['PHP_SELF']."?page=".$firstPage.">";
                        echo "<img src='../../assets/images/angle-double-left-solid.png' alt=''>";
                        echo "</a>"; 
                        $prePage = $_GET['page'] - 1;
                        if($prePage === 0)
                        {
                            $prePage = $maxPage;
                        }
                        echo "<a class='link-btn' href=".$_SERVER ['PHP_SELF']."?page=".$prePage.">";
                        echo "<img src='../../assets/images/angle-left-solid.png' alt=''>";
                        echo "</a>";
                    }
                    if($maxPage > 4)
                    {
                        if($_GET['page'] == 1)
                        {
                            $i = $_GET['page'];
                            echo '<b> '.$i.' </b>';
                            echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?page=".++$i."> ".$i." </a>";
                            echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?page=".++$i."> ".$i." </a>";
                            echo "<span class='page-dot'>...</span>";
                            echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?page=".$maxPage."> ".$maxPage." </a>";
                        }
                        else {
                            if($_GET['page'] == $maxPage)
                            {
                                echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?page=1>1</a>";
                                $i = $_GET['page']-3;
                                echo "<span class='page-dot'>...</span>";
                                echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?page=".++$i."> ".$i." </a>";
                                echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?page=".++$i."> ".$i." </a>";
                                echo '<b> '.$maxPage.' </b>';
                            }
                            else {
                                if($_GET['page'] > 2)
                                {
                                    echo "<span class='page-dot'>...</span>";
                                }
                                for($i = $_GET['page']-1; $i <= $_GET['page']+1; $i++ ){
                                    
                                    if($i == $_GET['page'])
                                    echo '<b> '.$i.' </b>';
                                    else echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?page=".$i."> ".$i." </a>";
                                }
                                if($_GET['page'] < $maxPage - 1)
                                {
                                    echo "<span class='page-dot'>...</span>";
                                }
                            }
                        }
                    }
                    else {
                        for($i = 1; $i <= $maxPage; $i++ ){
                            if($i == $_GET['page'])
                            echo '<b> '.$i.' </b>';
                            else echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?page=".$i."> ".$i." </a>";
                        }
                    }
                    
                    if($maxPage > 4)
                    {
                        $nextPage = $_GET['page'] + 1;
                        if($nextPage == $maxPage+1)
                        {
                            $nextPage = 1;
                        }
                        echo "<a class='link-btn' href=".$_SERVER ['PHP_SELF']."?page=".$nextPage.">";
                        echo "<img src='../../assets/images/angle-right-solid.png' alt=''>";
                        echo "</a>"; 
                        $lastPage = $maxPage;
                        echo "<a class='link-btn' href=".$_SERVER ['PHP_SELF']."?page=".$lastPage.">";
                        echo "<img src='../../assets/images/angle-double-right-solid.png' alt=''>";
                        echo "</a>";  
                    }
                        
                    echo "</div>";
                }  
        }
    }
    echo "</div>";
}
include("../../block/admin-block.php");
?>

<script>
        const checkAllDel = document.querySelector(".check-all")
        if(checkAllDel)
        {
            checkAllDel.addEventListener("click", ()=>{
            checkboxes = document.querySelectorAll('.check-delete');
            checkboxes.forEach((item)=>{
                item.checked = checkAllDel.checked;
        })
        })
}
        const btnDelete = document.querySelectorAll(".admin-delete");
        const container = document.querySelector(".container");
        function addModal(){
            const template =`<form action="" method="get" >
            <div class="modal modal-hidden" align='center'>
            <input type="hidden" class="id-product" name="id"> 
            
            <i class="fa fa-close modal-content--close"></i>
                <div class="modal-content">
                    <div class="modal-content--text">Bạn có muốn xóa sản phẩm này?</div>
                    <div class="modal-content--link">
                        <input type="submit" name="reset" class='modal-content--close' value="Hủy"></input>
                        <input name="ok" type="submit" class='modal-content--delete' value="Xóa"></input>
                    </div>
                </div>
            </div>
            </form>`;
        container.insertAdjacentHTML("beforeend", template);
        }
        btnDelete.forEach((item, index) => item.addEventListener("click", function(e){
            const idProduct = document.querySelectorAll(".id_sp");
            e.preventDefault();
            var id = idProduct[index].textContent;
            console.log(id);
            addModal();
            const modal = document.querySelector(".modal");
            const idProductDel = document.querySelector(".id-product");
            idProductDel.value=id;
            console.log(idProductDel.value);
            modal.classList.remove("modal-hidden");
            modal.classList.add("modal-show");
            const btnClose = document.querySelectorAll(".modal-content--close");
            btnClose.forEach((item) => item.addEventListener("click", function(){
                modal.classList.remove("modal-show");
                modal.classList.add("modal-hidden");
            }))
        }));
        window.addEventListener("click",function(e){
    if (e.target.matches(".noti--close")){
        document.querySelector(".noti-show").style="z-index: 0; transition: all .25s linear";
    }

})
    </script>