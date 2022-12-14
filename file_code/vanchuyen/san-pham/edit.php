<?php
include("../../block/connection.php");
    if(isset($_POST['submit']))
    {
        $idSP=$_POST['idSP'];   
        $tenSP=$_POST['tenSP'];
        $dmSP=$_POST['dmSP'];
        $giaSP=$_POST['giaSP'];
        $motaSP=$_POST["motaSP"];
        $anh=$_FILES['res']['name'];
        $target_dir = "../../assets/Images/";
        $anh_update= $_FILES['res']['tmp_name'];
        $target_file = $target_dir.basename($_FILES["res"]["name"]);
        if ($anh_update!=""){
            move_uploaded_file($anh_update, $target_file);
            $sql="Update `san_pham` set ten_sp='$tenSP',gia='$giaSP',danh_muc='$dmSP',mo_ta='$motaSP',hinh_anh='$anh' where ma_sp='".$idSP."'";
            }
        else {
            $sql="Update `san_pham` set ten_sp='$tenSP',gia='$giaSP',danh_muc='$dmSP',mo_ta='$motaSP' where ma_sp='".$idSP."'";
        }
        $result=mysqli_query($conn,$sql);
                if ($result) 
                {
                    header("Location:../../admin/san-pham/index.php");
                    $noti="Cập nhật thành công";
                    session_start();
                    $_SESSION["noti"]=$noti;
                    session_write_close();
                }
                else 
                {
                    echo 'not updated';
                }
        }
?>
<?php
include("../../block/global.php");
include("../../block/admin-block.php");
function adminContent(){
    echo '<div class="container">';
    include("../../block/connection.php");
    $id=$_GET['id'];
    $sql ="SELECT `ma_sp`, `ten_sp`, `gia`, `mo_ta`, `ten_dm`, `hinh_anh` FROM `san_pham`
        INNER JOIN danh_muc ON san_pham.danh_muc = danh_muc.ma_dm WHERE ma_sp='$id'";
    $result = mysqli_query($conn, $sql);
    if (!$result){
        echo "Không thành công";
    }
    else {
        while ($row=mysqli_fetch_array($result)){
            $idSP=$id;
            $tenSP=$row['ten_sp'];
            $dm=$row['ten_dm'];
            $mota=$row['mo_ta'];
            $hinhAnh=$row['hinh_anh'];
            $gia=$row['gia'];
        }
    }
    echo "<div class='product-content--link' align='left' style='margin-bottom: 30px'>";
            echo "<h1 class='admin-product--title'>CẬP NHẬT THÔNG TIN SẢN PHẨM</h1>
            <a href='../../admin/san-pham/index.php' class='product-link--edit'>
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
    <tr>
        <td>
            Mã sản phẩm: 
        </td>
        <td colspan="3">
        <input type='text' name='idSP' value=<?php
            if (isset($idSP)) echo $idSP; else echo "";
        ?> readonly class="product-update--input">
        </td>
    </tr>
    <tr>
        <td>
            Tên sản phẩm: 
        </td>
        <td colspan="3">
        <input type='text' name='tenSP' value="<?php
            if (isset($tenSP)) echo $tenSP; else echo "";?>" class="product-update--input">
        </td>
    </tr>
    <tr>
        <td>Danh mục sản phẩm: </td>
        <td colspan="3">
            <select name="dmSP" id="" class="product-update-input">
                <option value="">-Chọn danh mục-</option>
                <?php
                    $sqlSelect= "SELECT ma_dm, ten_dm FROM danh_muc";
                    $resultSelect = mysqli_query($conn, $sqlSelect);
                    if (mysqli_num_rows($resultSelect)<>0){
                        while ($rowSelect=mysqli_fetch_assoc($resultSelect)){
                            $idDM=$rowSelect["ma_dm"];
                            $tenDM=$rowSelect["ten_dm"];
                            if ( $dm== $tenDM){
                                echo "<option value=".$idDM." selected>".$idDM." - ".$tenDM."</option>";                                                                
                            }
                            else echo "<option value=".$idDM.">".$idDM." - ".$tenDM."</option>";
                        }
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
    <td>
        Giá sản phẩm: 
    </td>
    <td colspan="3">
        <input type="text" name="giaSP" value="<?php
            if (isset($gia)) echo $gia; else echo "";
        ?>" class="product-update--input" style="width: 80%"> (VNĐ)
    </td>
    </tr>
    <tr>
    <td>Mô tả sản phẩm: </td>
    <td >
        <textarea name="motaSP" id="" cols="30" rows="10" style="border: 1px solid #0C713D"><?php
            if (isset($mota)) echo $mota; else echo "";
        ?></textarea>
    </td>
    </tr>
    </table>
</div>
    <input type="submit"  name="submit" value="Lưu thông tin" class="btn-update">
</form>

<?php

                echo"</div>";                
}
?>
<script>
    const btnUpdateImg = document.querySelector("#updateImg");
    btnUpdateImg.addEventListener("change", function(){
        const img= document.querySelector("#img");
        console.log(window.URL.createObjectURL(btnUpdateImg.files[0]));
        img.src=window.URL.createObjectURL(btnUpdateImg.files[0]);
    });
</script>