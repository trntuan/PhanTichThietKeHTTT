<?php
include("../../block/connection.php");
if (isset($_POST["submit"])){
    $maDM=$_POST['maDM'];
    $tenDM=$_POST['tenDM'];    
    // thêm sản phẩm mới
    $sql="INSERT INTO danh_muc(ma_dm, ten_dm) 
        VALUES ('$maDM','$tenDM')";
    $result=mysqli_query($conn,$sql);
            if ($result) 
            {
                header("Location:../../admin/danh-muc/index.php");
                $notiProduct="Thêm danh mục mới thành công";
                session_start();
                $_SESSION["noti-category"]=$notiCategory;
                session_write_close();
            }
            else 
            {
                echo 'không thể thêm sản phẩm mới';
            }
    }
?>
<?php
include("../../block/admin-block.php");
function adminContent(){
    echo "<div class='container'>";
    echo "<div class='category-content--link' align='left' style='margin-bottom: 30px'>";
    echo "<h1 class='admin-category--title'>THÊM DANH MỤC MỚI</h1>
    <a href='../../admin/danh-muc/index.php' class='category-link--edit'>
    <i class='fa-solid fa-arrow-left'></i><span> Quay lại</span>
    </a>
    </div>";
?>
<form method='post' action="" enctype="multipart/form-data" class="category-update--form"> 
<div class="category-form--content">
    <table class="category-update--table">
    <tr>
        <td>
            Mã danh mục: 
        </td>
        <td colspan="3">
        <input type='text' name='maDM' value="<?php
            if (isset($maDM)) echo $maDM; else echo "";?>" class="category-update--input">
        </td>
    </tr>
    <tr>
        <td>
            Tên danh mục: 
        </td>
        <td colspan="3">
        <input type='text' name='tenDM' value="<?php
            if (isset($tenDM)) echo $tenDM; else echo "";?>" class="category-update--input">
        </td>
    </tr>
    </table>
</div>
    <input type="submit"  name="submit" value="Thêm sản phẩm mới" class="btn-update">
</form>
<?php
    echo "</div>";
}
?>
<script>
    const btnUpdateImg = document.querySelector("#updateImg");
    btnUpdateImg.addEventListener("change", function(){
        const img= document.querySelector("#img");
        img.src=window.URL.createObjectURL(btnUpdateImg.files[0]);
    });
</script>