<?php
    function adminContent() {
        $id = $_GET['id'];
        if (isset($id)) {
            require_once('../../db_helper/DB_Helper.php');
            $DB = new DB_helper();
            $queryDetail = "SELECT * FROM `lien_he` WHERE ma_lienhe = '$id'";
            $resultDetail = $DB->get_row($queryDetail);
            //var_dump($resultDetail);
            echo '
            <div class="" style="margin: 20px 100px 0 25px ">
                <div class="product-content--link" align="right">
                <h2 style="width: 220px; height: 51px; line-height: 51px;font-size: 1.5em; font-weight: 700; background:#B9D7EA; border-radius: 10px">CHI TIẾT LIÊN HỆ</h2>
                    <a href="../../admin/lien-he/index.php" class="product-link--edit">
                    <i class="fa-solid fa-arrow-left"></i><span> Quay lại</span>
                    </a>
                </div>
                
                <div class="admin-product--detail" style="margin-top: 20px; border: none;">
                    <div class="product-detail--content">
                        <div class="product-detail--id">
                            <span style="color: #0C713D; font-weight: bold">Mã liên hệ:</span> <span class="product--id">'.$resultDetail['ma_lienhe'].'</span></div>
                        <div class="product-detail--name">
                            <span style="color: #0C713D; font-weight: bold">Họ tên: </span>'.$resultDetail['ho_ten'].'</div>
                        <div class="product-detail--price">
                            <span style="color: #0C713D; font-weight: bold">Email: </span> 
                            <span>'.$resultDetail['email'].'</span>
                        </div>
                        <div class="product-detail--type">
                            <span style="color: #0C713D; font-weight: bold">Số điện thoại: </span>'.$resultDetail['so_dt'].'</div>
                        <div class="product-detail--desc">
                            <span style="color: #0C713D; font-weight: bold">Nội dung: </span>'.$resultDetail['noi_dung'].'</div>
                    </div>
                </div>
            </div>
                ';
            
        }
        else {
            echo 'Không có liên hệ';
        }
    }
    include("../../block/admin-block.php");
?>