<div class="container">
    <div class="categorySlider">
    <div class="category">
        <h1>Danh mục sản phẩm</h1>
        
            <div class="select-box" >
                <div class="options-container active" style="background-color: #0C713D">
    <?php
        require_once('./db_helper/DB_Helper.php');
        $DB = new DB_helper();
        $query = 'SELECT * FROM `loaisp`';
        $categoryList = $DB->get_list($query);

        foreach ($categoryList as $category) {
            echo '
                    <div class="option" style="background-color: #0C713D">
                            <input type="radio" class="radio" id="'.$category['MaLoai'].'" name="category"/>
                            <label for="'.$category['MaLoai'].'"><a href="./san-pham.php?dm='.$category['MaLoai'].'&loc=">'.$category['TenLoai'].'</a></label>
                            
                    </div>
            ';
        }
    ?>
            </div>
            <div class="selected" style="background-color: #0C713D">
                Chọn danh mục
            </div>
        </div>
        
    </div>
        <div class="content-slider">
            <div class="img-slider">
                <div class="slide active-slider">
                    <img src="./assets/images/slide/p1.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="./assets/images/slide/p2.png" alt="">
                </div>
                <div class="slide">
                    <img src="./assets/images/slide/p3.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="./assets/images/slide/p5.jpg" alt="">
                </div>
                <div class="navigation">
                    <div class="btn active-slider"></div>
                    <div class="btn"></div>
                    <div class="btn"></div>
                    <div class="btn"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="./assets/js/category.js"></script>
    <script src="./assets/js/slider.js"></script>
</div>
