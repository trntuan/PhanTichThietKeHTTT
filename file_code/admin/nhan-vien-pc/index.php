<?php
//thông báo xóa nhân viên
session_start();
if (isset($_SESSION["err"]))
{

    echo "<div class='noti-show'>
    <p class='update-noti--text'><span>".$_SESSION["err"]."</span>
    <i class='fa fa-close update--noti noti--close'></i>
    </p>
    </div>";
    unset($_SESSION["err"]);
}
session_write_close();
?>
<?php
//thông báo thêm nhân viên mới
session_start();
if (isset($_SESSION["noti-people"]))
{

    echo "<div class='noti-show'>
    <p class='update-noti--text'><span>".$_SESSION["noti-people"]."</span>
    <i class='fa fa-close update--noti noti--close'></i>
    </p>
    </div>";
    unset($_SESSION["noti-people"]);
}
session_write_close();
include("../../block/admin-block.php");
function adminContent(){
    echo "<div class='container'>";
    echo "<div class='product-content--link' align='left' style='margin-bottom: 30px'>";
    echo "<h1 class='admin-product--title'>DANH SÁCH NHÂN VIÊN</h1>
    <a href='../../admin/nhan-vien-pc/create.php' class='product-link--edit'>Thêm nhân viên mới</a>
</div>";
include("../../block/connection.php");
    $rowsPerPage=5;
    if ( ! isset($_GET['page']))
        $_GET['page'] = 1;
    $offset =($_GET['page']-1)*$rowsPerPage;
    $query = "SELECT * FROM nhanvien WHERE IdChuVu ='3'";
    $result = mysqli_query($conn, $query);
    $numRow = mysqli_num_rows($result);

    $maxPage = ceil($numRow / $rowsPerPage); 
    $query = "SELECT * FROM nhanvien WHERE IdChuVu ='3' LIMIT $offset, $rowsPerPage";
    $result = mysqli_query($conn, $query);
    if (!$result){
        echo "<p sstyle='color: red; font-weight: bold'>Không có dữ liệu</p>";
    }
    else {
        if (!mysqli_num_rows($result)==0){
            echo "<div class='people'>";
            while ($row=mysqli_fetch_array($result)){
                echo "<div class='people-item'>";
                echo "<a href='../../admin/nhan-vien-pc/edit.php?id=".$row['IdNV']."'>";
                if ($row['anh']==null) echo "<img src='../../assets/images/personal.png' class='people-img'>";
                else echo "<img src='../../assets/images/team/".$row['anh']."' class='people-img'>";
                echo "<div class='people-content'>";
                echo "<p class='people-name'> <span>Tên nhân viên:</span> ".$row['HoNV']. " " .$row['TenNV']."</p>";
                echo "<p class='people-gender'><span>Giới tính: </span> ".$row['GioTinh']. "</p>";
                echo "<p class='people-tel'><span>Số điện thoại:</span> ".$row['Sdt']."</p>";
                echo "<p class='people-address'><span>Ngày sinh : </span>".$row['NgaySinh']."</p>";
                echo "</div>";
                echo "</a>";
                echo "</div>";
            }
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
?>
<script>
    window.addEventListener("click",function(e){
    if (e.target.matches(".noti--close")){
        document.querySelector(".noti-show").style="z-index: 0; transition: all .25s linear";
    }
})
</script>