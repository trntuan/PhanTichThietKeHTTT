<?php
include("../../block/connection.php");
if (isset($_GET["ok"])){
    $id_NV= $_GET['id_NV'];
    echo "$id_NV";
    $sql= "DELETE FROM `nhan_vien` WHERE ma_nv='$id_NV'";
    $result=mysqli_query($conn,$sql);
    if ($result){
        header("Location: ../../admin/nhan-vien/index.php");
        $err="Xóa dữ liệu thành công";
        session_start();
        $_SESSION["err"]=$err;
        session_write_close();
}
    else 
    {
        header("Location: ../../admin/nhan-vien/index.php");
        $err="Xóa dữ liệu không thành công";
        session_start();
        $_SESSION["err"]=$err;
        session_write_close();
    }
}
?>
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
            $sql="Update `nhan_vien` set ho_nv='$hoNV',ten_nv='$tenNV',gioi_tinh=0,sdt='$sdt',dia_chi='$diachi',hinh_anh='$anh' where ma_nv='".$idNV."'";
        }
        else if ($gioitinh=="Nam"){
            $sql="Update `nhan_vien` set ho_nv='$hoNV',ten_nv='$tenNV',gioi_tinh=1,sdt='$sdt',dia_chi='$diachi',hinh_anh='$anh' where ma_nv='".$idNV."'";

        }
        }
    else {
        if ($gioitinh=="Nữ")
        {
            $sql="Update `nhan_vien` set ho_nv='$hoNV',ten_nv='$tenNV',gioi_tinh=0,sdt='$sdt',dia_chi='$diachi' where ma_nv='".$idNV."'";
        }
        else if ($gioitinh=="Nam"){
            $sql="Update `nhan_vien` set ho_nv='$hoNV',ten_nv='$tenNV',gioi_tinh=1,sdt='$sdt',dia_chi='$diachi' where ma_nv='".$idNV."'";

        }
    }
    $result=mysqli_query($conn,$sql);
            if ($result) 
            {
                header("Location:../../admin/nhan-vien/index.php");
                $notiPeople="Cập nhật thành công";
                session_start();
                $_SESSION["noti-people"]=$notiPeople;
                session_write_close();
            }
            else 
            {
                echo 'not updated';
            }
    }
?>
<?php
include("../../block/admin-block.php");
function adminContent(){
    echo "<div class='container'>";
    include("../../block/connection.php");
    $id=$_GET['id'];
    $query = "SELECT * FROM nhan_vien WHERE ma_nv='$id'";
    $result = mysqli_query($conn, $query);
    if (!$result){
        echo "<p sstyle='color: red; font-weight: bold'>Không có dữ liệu</p>";
    }
    else {
        while ($row=mysqli_fetch_array($result)){
            $idNV=$row['ma_nv'];
            $hoNV=$row['ho_nv'];
            $tenNV=$row['ten_nv'];
            $gioitinh=$row['gioi_tinh'];
            $sdt= $row['sdt'];
            $diachi=$row['dia_chi'];
            if ($row['hinh_anh']==null) $hinhAnh="personal.png";
            else $hinhAnh=$row['hinh_anh'];
        }
    }
    echo "<div class='product-content--link' align='left' style='margin-bottom: 30px'>";
            echo "<h1 class='admin-product--title'>CẬP NHẬT THÔNG TIN NHÂN VIÊN</h1>
            <a href='../../admin/nhan-vien/index.php' class='product-link--edit'>
            <i class='fa-solid fa-arrow-left'></i><span> Quay lại</span>
            </a>
        </div>";
?>

<form method='post' action="" enctype="multipart/form-data" class="product-update--form"> 
<div class="product-form--content">
<div class="product-update--img">
    <img src="../../assets/Images/<?php if (!isset($_FILES["res"])) echo $hinhAnh; 
    ?>" alt="" id="img">
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
    <a href='#modal' class='product-link--delete admin-delete' style="padding: 7px 20px">Xóa</a>
    <input type="submit"  name="submit" value="Lưu thông tin" class="btn-update" style="margin-top: 0; margin:0">
</div>
</form>
<?php
    echo "</div>";
}
?>
<script>
    const btnDelete = document.querySelectorAll(".admin-delete");
        const container = document.querySelector(".container");
        function addModal(){
            const template =`<form action="" method="get" id="modal">
            <div class="modal modal-hidden" align='center'> 
            
            <input type="hidden" class="id-product" name="id_NV">
            <i class="fa fa-close modal-content--close"></i>
                <div class="modal-content">
                    <div class="modal-content--text">Bạn có muốn xóa nhân viên này?</div>
                    <div class="modal-content--link">
                        <a href="" class='modal-content--close'>Hủy</a>
                        <input name="ok" type="submit" class='modal-content--delete' value="Xóa"></input>
                    </div>
                </div>
            </div>
            </form>`;
        container.insertAdjacentHTML("beforeend", template);
        }
        btnDelete.forEach((item, index) => item.addEventListener("click", function(e){
            e.preventDefault();
            addModal();
            const idProduct = document.querySelector(".id-people");
            const idSP= document.querySelector(".id-product");
            idSP.value = idProduct.value;
            const modal = document.querySelector(".modal");
            modal.classList.remove("modal-hidden");
            modal.classList.add("modal-show");
            const btnClose = document.querySelectorAll(".modal-content--close");
            btnClose.forEach((item) => item.addEventListener("click", function(){
                modal.classList.remove("modal-show");
                modal.classList.add("modal-hidden");
            }))
        }));
    const btnUpdateImg = document.querySelector("#updateImg");
    btnUpdateImg.addEventListener("change", function(){
        const img= document.querySelector("#img");
        console.log(window.URL.createObjectURL(btnUpdateImg.files[0]));
        img.src=window.URL.createObjectURL(btnUpdateImg.files[0]);
    });
</script>