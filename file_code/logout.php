<?php 
session_start();
$_SESSION['id_user']= null;
// unset($_SESSION["gioHang"]);
// if(isset($_SESSION["gioHang"]))
// for ($i = 0; $i < count($_SESSION["gioHang"]); $i++) {
// $gioHang[$i]["Gia"] = 0;
// }
session_destroy();  
header('Location:dangnhap.php');

?>