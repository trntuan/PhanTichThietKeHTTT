<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhóm 5</title>
    <link rel="stylesheet" href="./assets/css/main.css"/>
    <link rel="icon" type="image/x-icon" href="./assets/images/logo/logo_2.png">
    <style>
        ul{
            list-style-position: inside;
        }
        ul li{
            padding: 5px 0;
        }
    </style>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />
</head>
<body>
    <?php
        include("./block/connection.php");
        include("./block/global.php");
        include("./block/header.php");
        echo "<div class='container'>";
        if (isset($_GET["timKiem"])){
            $search=$_GET["search"];
            $rowPerPage = 12;
                if(!isset($_GET['page']))
                    {
                        $_GET['page'] = 1;
                    }
            $offset = ($_GET['page']-1)* $rowPerPage;
            if (!empty($search)){
                $query= "SELECT IDSP,Ten,Gia,TenLoai,hinh FROM `sanpham` JOIN LoaiSP on sanpham.LoaiSP = LoaiSP.MaLoai
                WHERE Ten LIKE '%$search%'";
                $resultSearch =  mysqli_query($conn, $query);
                $numRowSearch=mysqli_num_rows($resultSearch);
                $maxPage = ceil($numRowSearch / $rowPerPage); 

              
                $resultSearch =  mysqli_query($conn, $query);
                if ($resultSearch){
                    if ($numRowSearch> 0 && $search!=""){
                        echo "<p style='font-size: 18px; padding: 0 0px 20px;  border-bottom: 1px solid lightgray;'>Tìm thấy ";
                        echo "<span style='font-weight: bold'>$numRowSearch</span>";
                        echo " kết quả với từ khóa ";
                        echo "<span style='font-weight: bold'>$search</span>";
                        echo "</p>";
                        if (!mysqli_num_rows($resultSearch)==0){
                            echo '<div class="product">';
                            while($row = mysqli_fetch_assoc($resultSearch))
                            {
                        echo "<a class='product-item' href='./chi-tiet-san-pham.php?id=$row[IDSP]'>";
                        $src = "./assets/images/item/$row[hinh]";
                            echo "<div class='product-img'>
                            <img src='".$src."'>
                                </div>";
                            echo "<div class='product-content'>
                            <p class='product-dm'>$row[TenLoai]</p>
                                <p class='product-name'>$row[Ten]</p>
                                <p class='product-price'> <span class='money'>$row[Gia]</span>VNĐ</p>
                            </div>";
                        echo "</a>";
                    }
                    echo "</div>";
                    echo "<div class='phanTrang'>";
                            $firstPage = 1;
                            echo "<a class='link-btn' href=".$_SERVER ['PHP_SELF']."?search=".$search."&timKiem="."?page=".$firstPage.">";
                            echo "<img src='./assets/images/angle-double-left-solid.png' alt=''>";
                            echo "</a>"; 
                            $prePage = $_GET['page'] - 1;
                            if($prePage === 0)
                            {
                                $prePage = $maxPage;
                            }
                            echo "<a class='link-btn' href=".$_SERVER ['PHP_SELF']."?search=".$search."&timKiem="."?page=".$prePage.">";
                            echo "<img src='./assets/images/angle-left-solid.png' alt=''>";
                            echo "</a>";
                            for($i = 1; $i <= $maxPage; $i++ ){
                                if($i == $_GET['page'])
                                echo '<b> '.$i.' </b>';
                                else echo "<a class='link-text' href=".$_SERVER ['PHP_SELF']."?search=".$search."&timKiem="."&page=".$i."> ".$i." </a>";
                            }
                            $nextPage = $_GET['page'] + 1;
                            if($nextPage == $maxPage+1)
                            {

                                $nextPage = 1;
                            }
                            echo "<a class='link-btn' href=".$_SERVER ['PHP_SELF']."?search=".$search."&timKiem="."&page=".$nextPage.">";
                            echo "<img src='./assets/images/angle-right-solid.png' alt=''>";
                            echo "</a>"; 
                            $lastPage = $maxPage;
                            echo "<a class='link-btn' href=".$_SERVER ['PHP_SELF']."?search=".$search."&timKiem="."&page=".$lastPage.">";
                            echo "<img src='./assets/images/angle-double-right-solid.png' alt=''>";
                            echo "</a>";  
                            echo "</div>";
                        }
                    }
                    else {
                        echo "<p style='font-size: 18px; padding: 0 0px 20px; border-bottom: 1px solid lightgray;'>Không tìm thấy kết quả với từ khóa '<span style='font-weight: bold'>$search</span>'</p>";
                        echo "<ul style='margin-top: 10px;list-style-type: disc; padding: 0 20px'><span style='font-weight: bold'>Hãy thử lại bằng cách</span>
                            <li> Kiểm tra lỗi chính tả của từ khóa đã nhập.</li>
                            <li> Thử lại bằng từ khóa khác.</li>
                            <li> Thử lại bằng những từ khóa tổng quát hơn.</li>
                            <li> Thử lại bằng những từ khóa ngắn gọn hơn.</li>
                            </ul>
                        ";

                    }
                }
                else {
                    echo "Không xem được";
                }
            }
        }
        product_hot($conn);
    echo "</div>";
    ?>
    <?php
        include("./block/footer.php");
    ?>
</body>
</html>