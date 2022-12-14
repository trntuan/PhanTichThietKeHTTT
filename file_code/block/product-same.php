<?php

function product_same($dm, $conn){
    echo '<div class="product-hot">
            <p class="product-hot-title">Sản phẩm liên quan</p>';
                $query = "SELECT IDSP,Ten,Gia,TenLoai,hinh FROM `sanpham` JOIN LoaiSP on sanpham.LoaiSP = LoaiSP.MaLoai WHERE `MaLoai` = '$dm'  ORDER BY RAND () LIMIT 1, 4";
                $result =  mysqli_query($conn, $query);
                if(!$result)
                echo "Không xem được";
                else {
                    if(mysqli_num_rows($result) != 0)
                    {
                        echo '<div class="product">';
                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<a class='product-item' href='./chi-tiet-san-pham.php?id=$row[IDSP]'>";
                            $src = "./assets/images/item/$row[hinh]";
                                echo "<div class='product-img'>
                                <img src='".$src."'>
                                    </div>";
                                echo "<div class='product-content'>
                                    <p class='product-dm'>$row[TenLoai]</p>
                                    <p class='product-name'>$row[Ten]</p>
                                    <p class='product-price'><span class='money'>$row[Gia]</span>VNĐ</p>
                                </div>";
                            echo "</a>";
                        }
                        echo "</div>";  
                    }
                }
        echo '</div>';
}

?>

