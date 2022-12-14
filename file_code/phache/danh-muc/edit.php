<?php
include("../../block/connection.php");
if (isset($_POST["submit"])){
    $id_dm=$_POST["id_DM"];
    $ten_dm=$_POST["ten_DM"];
    // // include("../../block/connection.php");
    $sql="UPDATE `danh_muc` SET `ten_dm`='$ten_dm' WHERE ma_dm='$id_dm'";
    $result=mysqli_query($conn, $sql);
    if ($result){
        header("Location:../../admin/danh-muc");
        session_start();
        $_SESSION["noti"]="Cập nhật thành công";
        session_write_close();
    }
    else echo "ko";
} 
include("../../block/admin-block.php");
function adminContent(){
    $idDM=$_GET['id'];
    include("../../block/connection.php");
    $sql="SELECT * FROM danh_muc WHERE ma_dm='$idDM'";
    $result=mysqli_query($conn, $sql);
    if (!$result){
        echo "không thành công";
    }
    else {
        if (mysqli_num_rows($result)<>0){
            while ($row=mysqli_fetch_array($result)){
                $id_DM=$row['ma_dm'];
                $ten_DM=$row['ten_dm'];
            }
        }
    }
    echo "<div class='container'>";
    echo "<div class='category-content--link' align='left' style='margin-bottom: 30px'>";
            echo "<h1 class='admin-category--title'>CẬP NHẬT DANH MỤC</h1>
            
        </div>";
?>
<form action="" method="post">

    <table>
        <tr style="display: none">
            <td>MÃ</td>
            <td>
                <input type="text" name="id_DM" value="<?php
                if (isset($id_DM)) echo $id_DM; else echo ""?>" >
            </td>
        </tr>
        <tr>
            <td><h3>Tên danh mục: </h3></td>
            <td>
                <input type="text" name="ten_DM" class="btn-ten" value="<?php 
                if (isset($ten_DM)) echo $ten_DM; else echo ""?>">
            </td>
        </tr>
    </table>
    <input type="submit" value="Lưu thông tin" name="submit" class="btn-update">
    <a href='../../admin/danh-muc/index.php'>
        <i class='fa-solid fa-arrow-left'></i><span> Quay lại</span></a> 
</form>
<?php
    echo "</div>";
}
?>