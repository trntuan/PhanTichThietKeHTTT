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
//xóa nhiều sản phẩm
$self=$_SERVER ['PHP_SELF'];
if (isset($_POST["delete"])){
    if (count($_POST["checkbox"]) > 0){
        $arrayDel= $_POST['checkbox'];
        foreach ($arrayDel as $idDel){
            $query="DELETE FROM san_pham WHERE 1 AND san_pham.ma_sp='$idDel'";
            $result=mysqli_query($conn, $query);
    if ($result){
        header("Location:".$self."");
        $noti="Xóa sản phẩm thành công";
        session_start();
        $_SESSION["noti"]=$noti;
        session_write_close();
    }
    else {
        
    }
        }
    }
}
//xóa 1 sản phẩm
$self=$_SERVER ['PHP_SELF'];
if (isset($_GET["ok"])){
    $id= $_GET['id'];
    include("../../block/connection.php");
    $sql= "DELETE FROM `san_pham` WHERE ma_sp='$id'";
    $result=mysqli_query($conn,$sql);
    if ($result){
        header("Location:".$self."");
        $noti="Xóa sản phẩm thành công";
        session_start();
        $_SESSION["noti"]=$noti;
        session_write_close();
    }
}
?>
<?php
    include("../../block/admin-block.php");
    function adminContent(){
        echo '<div class="container">';
    include("../../block/connection.php");
    if (isset($_GET["timKiem"])){
        $search=$_GET["search"];
        $rowPerPage = 6;
            if(!isset($_GET['page']))
                {
                    $_GET['page'] = 1;
                }
        $offset = ($_GET['page']-1)* $rowPerPage;
        if (!empty($search)){
            $query= "SELECT ma_sp,ten_sp,ten_dm,gia,hinh_anh FROM `san_pham` 
            inner join danh_muc on san_pham.danh_muc = danh_muc.ma_dm
            WHERE ten_sp LIKE '%$search%'";
            $resultSearch =  mysqli_query($conn, $query);
            $numRowSearch=mysqli_num_rows($resultSearch);
            $maxPage = ceil($numRowSearch / $rowPerPage); 

            $query = "SELECT ma_sp,ten_sp,ten_dm,gia,hinh_anh FROM `san_pham` 
            inner join danh_muc on san_pham.danh_muc = danh_muc.ma_dm
            WHERE ten_sp LIKE '%$search%'
            LIMIT $offset, $rowPerPage";
            $resultSearch =  mysqli_query($conn, $query);

            if (!$resultSearch){
                echo "Không có sản phẩm nào";
            }
            else {
                
                if (!mysqli_num_rows($resultSearch)==0 && $search!=""){
                    echo "<div class='product-content--link' align='left' style='margin-bottom: 30px'>";
                    echo "<h1 class='admin-product--title'>THÔNG TIN CỦA SẢN PHẨM</h1>
                    <a href='../../admin/san-pham/create.php' class='product-link--edit'>Thêm sản phẩm mới</a>
                    </div>";
?>
    <form action="./admin/san-pham/tim-kiem.php" method="get" style="margin-bottom: 30px">
                <div class="header-menu--search">
                    <input type="text" name="search" id="" placeholder="Bạn cần tìm gì?..." value="<?php if (isset($_GET["search"]))
                        echo $_GET["search"];
                    else
                        echo "" ?>">
                    <button type="submit" name="timKiem" class="btn-search"><span>Tìm kiếm</span></button>
                </div>
            </form>
<?php
            echo "
            <form method='post' action=''>
            <input name='delete' type='submit' value='Xóa' class='admin-product--delete absolute'></input>";
            echo "<p style='margin-bottom: 20px'>Tìm thấy <span style='font-weight: bold'>$numRowSearch</span>
            kết quả khớp với từ khóa <span style='font-weight:bold'>$search</span></p>";
            echo "<table align='center' class='admin-product--table' id='tableProduct'>";
            echo "<tr >
                    <th><input type='checkbox' class='check-all' /></th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Đơn giá</th>
                    <th>Danh mục</th>
                    <th>Chức năng</th>
                </tr>";
                $dem=0;
                while ($rows=mysqli_fetch_array($resultSearch)){
                    $dem++;
                    $id=$rows["ma_sp"];
                    echo "<tr>";
                    echo "<td>
                    
                    <input type='checkbox' name='checkbox[]' class='check-delete' value='".$rows['ma_sp']."'>
                    </form>
                    </td>";
                    echo "<td><span class='id_sp'>{$rows['ma_sp']}</span></td>";
                    echo "<td>{$rows['ten_sp']}</td>";
                    echo "<td>
                    <img src='../../assets/images/{$rows['hinh_anh']}' class='admin-product--img'>
                    </td>";
                    echo "<td>
                    <span class='money'>{$rows['gia'] }</span>
                    <span>VNĐ</span></td>";
                    echo "<td>{$rows['ten_dm']}</td>";
                    echo "<td align='center'><a href='../../admin/san-pham/edit.php?id=".$id."'>
                        <i class='fa fa-edit' title='Chỉnh sửa'></i> 
                    </a> |
                    <a href='../../admin/san-pham/detail.php?id=".$id."'>
                    <i class='fa-sharp fa-solid fa-file-lines' title='Xem chi tiết'></i> 
                    </a> | 
                    
                        <i class='fa fa-trash admin-delete' style='color: red' title='Xóa' ></i> 
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
            else {
                echo "<p style='font-size: 18px; padding: 0 0px 20px; border-bottom: 1px solid lightgray;'>Không tìm thấy kết quả với từ khóa '<span style='font-weight: bold'>$search</span>'</p>";
                echo "<ul style='margin-top: 10px;list-style-type: disc; padding: 0 20px'><span style='font-weight: bold'>Hãy thử lại bằng cách</span>
                    <li> Kiểm tra lỗi chính tả của từ khóa đã nhập.</li>
                    <li> Thử lại bằng từ khóa khác.</li>
                    <li> Thử lại bằng những từ khóa tổng quát hơn.</li>
                    <li> Thử lại bằng những từ khóa ngắn gọn hơn.</li>
                    </ul>
                ";
                echo "<a href='../../admin/san-pham/index.php' class='product-content--link'>Quay lại danh sách sản phẩm</a>";
        }
    }
    echo "</div>";
}
        }
    }
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