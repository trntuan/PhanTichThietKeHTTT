<script>
                    const btnDelete = document.querySelectorAll(".admin-delete");
                    const container = document.querySelector(".container");
                    function addModal(){
                        const template =`<form action="" method="post" >
                        <div class="modal modal-hidden" align='center'>
                        <input type="hidden" class="id-product" name="id"> 
                        <button type="button" name="reset">
                        <i class="fa fa-close modal-content--close"></i></button>
                            <div class="modal-content">
                                <div class="modal-content--text">Bạn có muốn xóa sản phẩm này?</div>
                                <div class="modal-content--link">
                                    <button type="button" name="reset" class='modal-content--close'>Hủy</button>
                                    <button type="submit" name='ok' class='modal-content--delete'>Xóa</button>
                                </div>
                            </div>
                        </div>
                        </form>`;
                    container.insertAdjacentHTML("beforeend", template);
                    }
                    btnDelete.forEach((item, index) => item.addEventListener("click", function(e){
                        const idProduct = document.querySelectorAll(".id_sp");
                        e.preventDefault();
                        var id = idProduct[index].textContent;
                        console.log(id);
                        addModal();
                        const modal = document.querySelector(".modal");
                        const idProductDel = document.querySelector(".id-product");
                        idProductDel.value=id;
                        console.log(idProductDel.value);
                        modal.classList.remove("modal-hidden");
                        modal.classList.add("modal-show");
                        const btnClose = document.querySelectorAll(".modal-content--close");
                        btnClose.forEach((item) => item.addEventListener("click", function(){
                            modal.classList.remove("modal-show");
                            modal.classList.add("modal-hidden");
                        }))
                    }));
                </script>
                    <?php
                        if (isset($_POST["ok"])){
                            $id= $_POST['id'];
                            include("../../block/connection.php");
                            $sql= "DELETE FROM `san_pham` WHERE ma_sp='$id'";
                            $result=mysqli_query($conn,$sql);
                            if ($result){
                                // header("Refresh:0");
                                
                            }
                        }
                        else {
                            $id="";
                        }
                        ?>