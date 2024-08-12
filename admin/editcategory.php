<?php include("./parts/header.php")?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="form-detail" style="width: 80%;">
            <?php 
             include "../config.php";
             $id=$_GET['id'];
             $sql="select * from danhmuc where id_cate = $id";
             $data = $conn->query($sql); 
             $row = $data ->fetch(PDO::FETCH_ASSOC);;
             if(empty($row)) {
                echo "Giá trị id: $id không tồn tại. Vui lòng kiểm tra lại.";
                die;
            }
            ?>
            <!-- Page Heading -->
            <!-- <h1 class="h3 mb-4 text-gray-800">Sửa danh mục</h1> -->
            <form class="form-categories" method="post">
            <h2>Update Danh Mục</h2>
                <div class="field">
                    <label for="">Name Categories </label>
                    <input type="text" name="name" value="<?php echo $row['name_cate'] ?>">
                    <input type="hidden" name="id" value="<?php echo $row['id_cate'] ?>">
                </div> 
                <div class="field">
                    <label for="">Mô tả </label>
                    <input type="text" name="mota" value="<?php echo $row['mo_ta'] ?>">
                </div> 
                <div class="field">
                    <input type="submit" id="field" name="submit" value="Edit">
                </div>
            </form> 
            <?php 
            if(isset($_POST['submit'])){
                $name = $_POST['name'];
                $mota = $_POST['mota'];
                $id=$_POST['id'];
                if($name!="" && $mota != ""){
                    $sql="update danhmuc set name_cate ='$name' , mo_ta ='$mota' where id_cate = $id";
                    $data = $conn->query($sql);
                    echo '<meta http-equiv="refresh" content="0;url=category.php">';
                }else{echo "Vui lòng nhập danh mục";}
            }
            
            ?>  
            </div>          
        </div>
        <!-- /.container-fluid -->            
<?php include("parts/footer.php")?>