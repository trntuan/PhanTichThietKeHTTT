<?php
include("../../block/connection.php");
if (isset($_POST["submit"])){
    $dm=$_POST['dmSP'];
    $tenSP=$_POST['tenSP'];
    $giaSP=$_POST['giaSP'];
    $motaSP= $_POST['motaSP'];
    if (($dm=="MUT") || ($dm=="THA") || ($dm=="TRA")) {
        $dm_SP=substr($dm,0,2);
    }
    else {
        if ($dm=="SUB") $dm_SP="SB";
        else if ($dm=="SID") $dm_SP="SD";
        else if ($dm=="TRC") $dm_SP="TC";
    }
    $idSP="";//tạo mã rỗng
    $sql = "SELECT MAX(ma_sp) FROM `san_pham` WHERE danh_muc='$dm'";
    $result=mysqli_query($conn, $sql);
    if ($result){
        if (mysqli_num_rows($result)==1){
            while ($row=mysqli_fetch_array($result)){
                $id_SP=$row['MAX(ma_sp)'];
                if ($id_SP!=""){
                $id_num=substr($id_SP,-1);//lấy phần tử cuối 
                $id_text=substr($id_SP,0,2);//lấy 2 phần tử đầu
                $idNum=substr($id_SP,2,1);//lấy phần tử còn lại
                $id_num=(int)$id_num+1;
                if ($id_num>9){
                    $id_num=0;
                    $idNum=(int)$idNum+1;
                } else if ($id_num<=9){
                    $id_num=$id_num;
                    $idNum=$idNum;
                }
                $id_text.=(string)$idNum;
                $id_text.=(string)$id_num;
                $idSP=$id_text;
                }
                if ($id_SP==""){
                    $idSP.=$dm_SP;
                    $idSP.="01";
                    echo $idSP;
                }
                
            }
        }
    }
    // thêm sản phẩm mới
    $anh=$_FILES['res']['name'];
    $target_dir = "../../assets/Images/";
    $anh_update= $_FILES['res']['tmp_name'];
    $target_file = $target_dir.basename($_FILES["res"]["name"]);
    if ($anh_update!=""){
        move_uploaded_file($anh_update, $target_file);
        $sql="INSERT INTO `san_pham`(`ma_sp`, `ten_sp`, `gia`, `mo_ta`, `danh_muc`, `hinh_anh`) 
        VALUES ('$idSP','$tenSP','$giaSP','$motaSP','$dm','$anh')";
        }
    else {
        $sql="INSERT INTO `san_pham`(`ma_sp`, `ten_sp`, `gia`, `mo_ta`, `danh_muc`, `hinh_anh`) 
        VALUES ('$idSP','$tenSP','$giaSP','$motaSP','$dm','blue_tea_logo.webp')";
    }
    $result=mysqli_query($conn,$sql);
            if ($result) 
            {
                header("Location:../../admin/san-pham/index.php");
                $notiProduct="Thêm sản phẩm mới thành công";
                session_start();
                $_SESSION["noti-product"]=$notiProduct;
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
    echo "<div class='product-content--link' align='left' style='margin-bottom: 30px'>";
    echo "<h1 class='admin-product--title'>THÊM SẢN PHẨM MỚI</h1>
    <a href='../../admin/san-pham/index.php' class='product-link--edit'>
    <i class='fa-solid fa-arrow-left'></i><span> Quay lại</span>
    </a>
    </div>";
?>
<form method='post' action="" enctype="multipart/form-data" class="product-update--form"> 
<div class="product-form--content">
<div class="product-update--img">
    <img src="../../assets/Images/blue_tea_logo.webp" alt="" id="img">
    <input type="file" name="res" title="" value="<?php
        if (isset($hinhAnh)) echo $hinhAnh; else echo "";
    ?>" id="updateImg">
    <label for="updateImg" class="product-update--label">Chọn ảnh</label>
</div>
    <table class="product-update--table">
    <tr style="display:none">
        <td>
            Mã sản phẩm: 
        </td>
        <td colspan="3">
        <input type='text' name='idSP' value="<?php
            if (isset($idSP)) echo $idSP; else echo "";
        ?>" class="product-update--input">
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
                include("../../block/connection.php");
                    $sqlSelect= "SELECT ma_dm, ten_dm FROM danh_muc";
                    $resultSelect = mysqli_query($conn, $sqlSelect);
                    if (mysqli_num_rows($resultSelect)<>0){
                        while ($rowSelect=mysqli_fetch_assoc($resultSelect)){
                            $idDM=$rowSelect["ma_dm"];
                            $tenDM=$rowSelect["ten_dm"];
                            if (isset($_POST["dmSP"])){
                            if ( $dm== $tenDM){
                                echo "<option value=".$idDM." selected>".$idDM." - ".$tenDM."</option>";                                                                
                            }
                            else echo "<option value=".$idDM.">".$idDM." - ".$tenDM."</option>";
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
        <input type="number" name="giaSP" value="<?php
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