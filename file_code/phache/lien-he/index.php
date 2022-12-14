<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
    function adminContent() {
        echo '
            <div class="container_contact">
                <h3 class="heading_contact">THÔNG TIN LIÊN HỆ</h3>
                <div style="margin: 20px 0 0 20px">
                    <input type="text" name="" placeholder="Nhập từ khóa" id="myInput" style="width: 60%; height: 40px; border: 2px solid #769FCD;border-radius: 10px; outline: none; font-size: 1.1em">
                </div>
        ';
        echo '
        <div class="content_contact">
            <table class="content-table_contact">
                <thead class="header_table">
                <tr class="header_table--tr">
                    <th class="contact_header">Mã liên hệ</th>
                    <th class="contact_header">Họ tên</th>
                    <th class="contact_header">Email</th>
                    <th class="contact_header">Số điện thoại</th>
                    <th class="contact_header">Nội dung</th>
                    <th class="contact_header">Chức năng</th>
                </tr>
                </thead>
                <tbody id="myTable" class="table_information">
        ';
        require_once('../../db_helper/DB_Helper.php');
        $DB = new DB_helper();
        $rowPerPage = 5;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $offset = ($page - 1) * $rowPerPage;
        $query_contact = "SELECT * FROM `lien_he`";
        $result_contact = $DB->get_list($query_contact);
        $numRow = count($result_contact);

        $query_contact = "SELECT * FROM `lien_he` LIMIT $offset, $rowPerPage";
        $result_contact = $DB->get_list($query_contact);
        $maxPage = ceil($numRow / $rowPerPage);

        foreach ($result_contact as $contact) {
            echo '
                <tr class="table_information--tr"> 
                    <td class="contact_content-item">'.$contact['ma_lienhe'].'</td>
                    <td class="contact_content-item">'.$contact['ho_ten'].'</td>
                    <td class="contact_content-item">'.$contact['email'].'</td>
                    <td class="contact_content-item">'.$contact['so_dt'].'</td>
                    <td class="contact_content-item">'.$contact['noi_dung'].'</td>
                    <td class="contact_content-item" align="center">
                        <a href="../../admin/lien-he/detail.php?id='.$contact['ma_lienhe'].'">
                        <i class="fa-sharp fa-solid fa-file-lines" title="Xem chi tiết"></i> 
                        </a>
                    </td>
                </tr>
            ';
            
        }
        echo '
                </tbody>
                </table>
            </div>
        ';
        echo '
            <div class="pagination">
        ';
                $firstPage = 1;
                echo "<a href=".$_SERVER ['PHP_SELF']."?page=".$firstPage.">&laquo;</a>"; 
                $prePage = $page - 1;
                if($prePage === 0)
                    $prePage = $maxPage;
                echo "<a href=".$_SERVER ['PHP_SELF']."?page=".$prePage.">&lsaquo;</a>";

                for($i = 1; $i <= $maxPage; $i++ ){
                    $class  = ( $page == $i ) ? "active" : "";
                    echo "<a href=".$_SERVER ['PHP_SELF']."?page=".$i." class=".$class."> ".$i." </a>";
                }
                
                $nextPage = $page + 1;
                if($nextPage == $maxPage+1)
                    $nextPage = 1;
                echo "<a href=".$_SERVER ['PHP_SELF']."?page=".$nextPage.">&rsaquo; </a>"; 
                $lastPage = $maxPage;
                echo "<a href=".$_SERVER ['PHP_SELF']."?page=".$lastPage.">&raquo;</a>";
        echo '</div>
            </div>
        ';
    }
    include("../../block/admin-block.php");
?>

<script>
    $(document).ready(function(){
        $("#myInput").on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>