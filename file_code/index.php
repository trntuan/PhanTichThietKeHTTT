<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhóm 5</title>
    <link rel="stylesheet" href="./assets/css/main.css" />
    <link rel="icon" type="image/x-icon" href="./assets/images/logo/logo_2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    
</head>

<body>
    <?php
    session_start();
        include("./block/connection.php");
        include("./block/global.php");
        include("./block/header.php");
        include("./block/category_slider.php");
    ?>
    <?php
        $queryDM = "SELECT TenLoai,MaLoai FROM `loaisp`";
        $result = mysqli_query($conn, $queryDM);

        if($result)
        {
            if(mysqli_num_rows($result)!= 0){
                while($row = mysqli_fetch_array($result))
                    {
                        echo "<div class='container'>
                        <h3 class='product-header'>".$row["TenLoai"]."</h3>";
                         getSanPham($conn, $row["MaLoai"]); 
                        echo "</div>";
                    }
            }
        }
    ?>
    


    <?php
        include("./block/footer.php");
    ?>
    <script src="./assets/js/main.js"></script>
</body>

</html>