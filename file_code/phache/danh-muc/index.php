<?php
session_start();
if (isset($_SESSION["noti-category"]))
{

    echo "<div class='noti-show'>
    <p class='update-noti--text'><span>".$_SESSION["noti-category"]."</span>
    <i class='fa fa-close update--noti noti--close'></i>
    </p>
    </div>";
    unset($_SESSION["noti-category"]);
}
session_write_close();
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
if (isset($_GET["ok"])){
    $id= $_GET['id'];
    include("../../block/connection.php");
    $sql= "DELETE FROM danh_muc WHERE ma_dm='$id'";
    $result=mysqli_query($conn,$sql);
                        }
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
        $query="SELECT * FROM `loaisp` ";
        $result = mysqli_query($conn, $query);
        $numRow = mysqli_num_rows($result);

        $maxPage = ceil($numRow / $rowsPerPage); 
        $query = "SELECT * FROM `loaisp` LIMIT $offset, $rowsPerPage";
        $result =  mysqli_query($conn, $query);
    if (!$result){
        echo "Không có danh mục nào";
    }
    else {
        if (!mysqli_num_rows($result)==0){
            echo "<div class='category-content--link' align='left' style='margin-bottom: 30px'>";
            echo "<h1 class='admin-category--title'>THÔNG TIN DANH MỤC</h1>
            <a href='../../admin/danh-muc/create.php' style=' border: 1px solid #0C713D;
            background-color: #0C713D;'>Thêm danh mục</a>
        </div>";
            echo "<table align='center' class='admin-category--table' >";
            echo "<tr >
                    <th>STT</th>
                    <th>Mã danh mục</th>
                    <th>Tên danh mục</th>
                    <th>Chức năng</th>
                </tr>";
                // $temp=$_GET['page']*$rowsPerPage;
                // if($temp<=$rowsPerPage) $dem=0;
                // else $dem=$temp-$rowsPerPage;
                $dem=0;
                while ($rows=mysqli_fetch_array($result)){
                    $dem++;
                    $id=$rows["MaLoai"];
                    echo "<tr>";
                    echo "<td>".$dem."</td>";
                    echo "<td><span class='id_dm'>DD0{$rows['MaLoai']}</span></td>";
                    echo "<td>{$rows['TenLoai']}</td>";
                    echo "<td align='center'><a href='../../admin/danh-muc/edit.php?id=".$id."'>
                        <i class='fa fa-edit' title='Chỉnh sửa'></i> 
                    </a> |
                        <i class='fa fa-trash admin-delete' style='color: red' title='Xóa' ></i> 
                    </td>";
                    echo "</tr>";
                }
                echo "</table>";
                // $re = mysqli_query($conn, 'select * from san_pham');
                // $numRows = mysqli_num_rows($re);
                // $maxPage = floor($numRows/$rowsPerPage) + 1;
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
}
include("../../block/admin-block.php");
?>
<script>
        const btnDelete = document.querySelectorAll(".admin-delete");
        const container = document.querySelector(".container");
        function addModal(){
            const template =`<form action="" method="get" >
            <div class="modal modal-hidden" align='center'>
            <input type="hidden" class="id-category" name="id"> 
            
            <i class="fa fa-close modal-content--close"></i>
                <div class="modal-content">
                    <div class="modal-content--text">Bạn có muốn xóa danh mục này không?</div>
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
            const idProduct = document.querySelectorAll(".id_dm");
            e.preventDefault();
            var id = idProduct[index].textContent;
            console.log(id);
            addModal();
            const modal = document.querySelector(".modal");
            const idProductDel = document.querySelector(".id-category");
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