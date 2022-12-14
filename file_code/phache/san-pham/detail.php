<?php
include("../../block/connection.php");
include("../../block/global.php");
$err;
if (isset($_GET["ok"])){
    $idSP= $_GET['idSP'];
    echo "$idSP";
    $sql= "DELETE FROM `san_pham` WHERE ma_sp='$idSP'";
    $result=mysqli_query($conn,$sql);
    if ($result){
        header("Location: ../../admin/san-pham/index.php");
        $err="Xóa dữ liệu thành công";
        session_start();
        $_SESSION["err"]=$err;
        session_write_close();
}
    else 
    {
        header("Location: ../../admin/san-pham/index.php");
        $err="Xóa dữ liệu không thành công";
        session_start();
        $_SESSION["err"]=$err;
        session_write_close();
    }
}
function adminContent()
{
    echo '<div class="container">';
    echo "<div class='product-content--link' align='left' style='margin-bottom: 30px'>";
    echo "<h1 class='admin-product--title'>THÔNG TIN SẢN PHẨM</h1>
    <a href='../../admin/san-pham/index.php' class='product-link--edit'>
    <i class='fa-solid fa-arrow-left'></i><span> Quay lại</span>
    </a>
</div>";
    include("../../block/connection.php");
                    $id=$_GET["id"];
                    if (isset($id)){
                        $sql ="SELECT `ma_sp`, `ten_sp`, `gia`, `mo_ta`, `ten_dm`, `hinh_anh` FROM `san_pham`
                        INNER JOIN danh_muc ON san_pham.danh_muc = danh_muc.ma_dm WHERE ma_sp='$id'";
                        $result=mysqli_query($conn, $sql);
                        if (!$result){
                            echo "Không thành công";
                        }
                        else {
                            while ($row=mysqli_fetch_array($result)){
                                echo "<div class='admin-product--detail'>
                                <div class='product-detail--img'>
                                    <img src='../../assets/images/{$row['hinh_anh']}' alt='' title='Ảnh sản phẩm {$row['ten_sp']}'>
                                </div>
                                <div class='product-detail--content'>
                                    <div class='product-detail--id'>
                                        <span style='color: #0C713D; font-weight: bold'>Mã sản phẩm:</span> <span class='product--id'>{$row['ma_sp']}</span></div>
                                    <div class='product-detail--name'>
                                        <span style='color: #0C713D; font-weight: bold'>Tên sản phẩm: </span> {$row['ten_sp']}</div>
                                    <div class='product-detail--price'>
                                        <span style='color: #0C713D; font-weight: bold'>Giá: </span> 
                                        <span class='money'>{$row['gia']}</span> VNĐ
                                        </div>
                                    <div class='product-detail--type'>
                                        <span style='color: #0C713D; font-weight: bold'>Danh mục: </span>{$row['ten_dm']}</div>
                                    <div class='product-detail--desc'>
                                        <span style='color: #0C713D; font-weight: bold'>Mô tả: </span> {$row['mo_ta']}</div>
                                </div>
                            </div>";
                            }
                        }
                    echo "<div class='product-link' align='center'>
                    <a href='../../admin/san-pham/edit.php?id={$id}' class='product-link--edit'>Chỉnh sửa</a>
                    <a href='#modal' class='product-link--delete admin-delete'>Xóa</a>
                </div>";
                }
                else {
                    echo "Sản phẩm không tồn tại";
                }
                echo"</div>";
        }
    
include("../../block/admin-block.php");


?>
<script>
        const btnDelete = document.querySelectorAll(".admin-delete");
                    const container = document.querySelector(".container");
                    function addModal(){
                        const template =`<form action="" method="get" id="modal">
                        <div class="modal modal-hidden" align='center'> 
                        
                        <input type="hidden" class="id-product" name="idSP">
                        <i class="fa fa-close modal-content--close"></i>
                            <div class="modal-content">
                                <div class="modal-content--text">Bạn có muốn xóa sản phẩm này?</div>
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
                        const idProduct = document.querySelector(".product--id");
                        const idSP= document.querySelector(".id-product");
                        idSP.value = idProduct.textContent;
                        console.log(idSP.textContent);
                        const modal = document.querySelector(".modal");
                        modal.classList.remove("modal-hidden");
                        modal.classList.add("modal-show");
                        const btnClose = document.querySelectorAll(".modal-content--close");
                        btnClose.forEach((item) => item.addEventListener("click", function(){
                            modal.classList.remove("modal-show");
                            modal.classList.add("modal-hidden");
                        }))
                    }));
    </script>