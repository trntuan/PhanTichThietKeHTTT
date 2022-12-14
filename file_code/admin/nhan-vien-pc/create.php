<?php
include("../../block/connection.php");
if(isset($_POST['submit']))
{
    $idNV=$_POST['idNV'];  
    $hoNV=$_POST['hoNV'];
    $tenNV=$_POST['tenNV'];
    $gioitinh=$_POST['gioitinh'];
    $sdt= $_POST['sdt'];
    $diachi=$_POST['diachi'];
    $anh=$_FILES['res']['name'];
    $target_dir = "../../assets/Images/";
    $anh_update= $_FILES['res']['tmp_name'];
    $target_file = $target_dir.basename($_FILES["res"]["name"]);
    if ($anh_update!=""){
        move_uploaded_file($anh_update, $target_file);
        if ($gioitinh=="Nữ")
        {
            $sql="INSERT INTO `nhan_vien`( `ho_nv`, `ten_nv`, `gioi_tinh`, `sdt`, `dia_chi`, `hinh_anh`) 
            VALUES ('$hoNV','$tenNV','0','$sdt','$diachi','$anh')";
        }
        else if ($gioitinh=="Nam"){
            $sql="INSERT INTO `nhan_vien`( `ho_nv`, `ten_nv`, `gioi_tinh`, `sdt`, `dia_chi`, `hinh_anh`) 
            VALUES ('$hoNV','$tenNV','1','$sdt','$diachi','$anh')";

        }
        }
    else {
        if ($gioitinh=="Nữ")
        {
            $sql="INSERT INTO `nhan_vien`( `ho_nv`, `ten_nv`, `gioi_tinh`, `sdt`, `dia_chi`) 
            VALUES ('$hoNV','$tenNV','0','$sdt','$diachi')";
        }
        else if ($gioitinh=="Nam"){
            $sql="INSERT INTO `nhan_vien`( `ho_nv`, `ten_nv`, `gioi_tinh`, `sdt`, `dia_chi`) 
            VALUES ('$hoNV','$tenNV','1','$sdt','$diachi')";

        }
    }
    $result=mysqli_query($conn,$sql);
            if ($result) 
            {
                header("Location:../../admin/nhan-vien/index.php");
                $notiPeople="Thêm nhân viên mới thành công";
                session_start();
                $_SESSION["noti-people"]=$notiPeople;
                session_write_close();
            }
            else 
            {
                echo 'không thể thêm';
            }
    }
include("../../block/admin-block.php");
function adminContent(){
    echo "<div class='container'>";
    echo "<div class='product-content--link' align='left' style='margin-bottom: 30px'>";
            echo "<h1 class='admin-product--title'>THÊM NHÂN VIÊN MỚI</h1>
            <a href='../../admin/nhan-vien/index.php' class='product-link--edit'>
            <i class='fa-solid fa-arrow-left'></i><span> Quay lại</span>
            </a>
        </div>";
?>
<form method='post' action="" enctype="multipart/form-data" class="product-update--form"> 
<div class="product-form--content">
<div class="product-update--img">
    <img src="../../assets/Images/personal.png" alt="" id="img">
    <input type="file" name="res" title="" value="<?php
        if (isset($hinhAnh)) echo $hinhAnh; else echo "";
    ?>" id="updateImg">
    <label for="updateImg" class="product-update--label">Chọn ảnh</label>
</div>
    <table class="product-update--table">
    <tr style="display:none">
        <td colspan="3">
        <input type='hidden' name='idNV' value=<?php
            if (isset($idNV)) echo $idNV; else echo "";
        ?> readonly class="product-update--input id-people">
        </td>
    </tr>
    <tr>
        <td>
            Họ nhân viên: 
        </td>
        <td colspan="3">
        <input type='text' name='hoNV' value="<?php
            if (isset($hoNV)) echo $hoNV; else echo "";?>" class="product-update--input">
        </td>
    </tr>
    <tr>
        <td>Tên nhân viên: </td>
        <td colspan="3">
        <input type='text' name='tenNV' value="<?php
            if (isset($tenNV)) echo $tenNV; else echo "";?>" class="product-update--input">
        </td>
        </td>
    </tr>
    <tr>
    <td>
        Giới tính: 
    </td>
    <td colspan="3">
        <input type="text" name="gioitinh" value="<?php
            if ((isset($gioitinh)) && $gioitinh==1) echo "Nam"; 
            else if ((isset($gioitinh)) && $gioitinh==0) echo "Nữ";
        ?>" class="product-update--input" >
    </td>
    </tr>
    <tr>
    <td>Số điện thoại: </td>
    <td >
    <input type="text" name="sdt" value="<?php
            if (isset($sdt)) echo $sdt; else echo "0";
        ?>" class="product-update--input" >
    </td>
    </tr>
    <tr>
    <td>Địa chỉ: </td>
    <td >
    <input type="text" name="diachi" value="<?php
            if (isset($diachi)) echo $diachi; else echo "";
        ?>" class="product-update--input" >
    </td>
    </tr>
    </table>
</div>
<div class='product-link' align='center'>
    <input type="submit"  name="submit" value="Thêm nhân viên" class="btn-update" style="margin-top: 0; margin:0">
</div>
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